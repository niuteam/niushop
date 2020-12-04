<?php

namespace extend\database;

use think\facade\Db;

class Database
{
    /**
     * 文件指针
     * @var resource
     */
    private $fp;

    /**
     * 备份文件信息 part - 卷号，name - 文件名
     * @var array
     */
    private $file;

    /**
     * 当前打开文件大小
     * @var integer
     */
    private $size = 0;

    /**
     * 备份配置
     * @var integer
     */
    private $config;

    /**
     * 数据库备份构造方法
     * @param array $file 备份或还原的文件信息
     * @param array $config 备份配置信息
     * @param string $type 执行类型，export - 备份数据， import - 还原数据
     */
    public function __construct($file = [], $config = [], $type = 'export')
    {
        $this->file = $file;
        $this->config = $config;
    }

    /**
     * 查询所有表
     */
    public function getTableList()
    {
        $table_list = Db::query("SHOW TABLE STATUS");
        return success([ 'list' => $table_list ]);
    }

    /**
     * 修复表
     */
    public function repair($tables)
    {
        if ($tables) {
            Db::startTrans();
            try {
                if (is_array($tables)) {
                    $tables = implode('`,`', $tables);
                    Db::query("REPAIR TABLE `{$tables}`");
                } else {
                    Db::query("REPAIR TABLE `{$tables}`");
                }
                Db::commit();
                return success([], "数据表修复完成");
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return error([], "数据表修复失败");
            }
        } else {
            return error([], "请指定要修复的表");
        }
    }

    /**
     * 打开一个卷，用于写入数据
     * @param integer $size 写入数据的大小
     */
    private function open($size)
    {
        if ($this->fp) {
            $this->size += $size;
            if ($this->size > $this->config[ 'part' ]) {
                $this->config[ 'compress' ] ? @gzclose($this->fp) : @fclose($this->fp);
                $this->fp = null;
                $this->file[ 'part' ]++;
                session('backup_file', $this->file);
                $this->create();
            }
        } else {
            $backuppath = $this->config[ 'path' ];
            $filename = "{$backuppath}{$this->file['name']}-{$this->file['part']}.sql";
            if ($this->config[ 'compress' ]) {
                $filename = "{$filename}.gz";
                $this->fp = @gzopen($filename, "a{$this->config['level']}");
            } else {
                $this->fp = @fopen($filename, 'a');
            }
            $this->size = filesize($filename) + $size;
        }
    }

    /**
     * 写入初始数据
     * @return boolean true - 写入成功，false - 写入失败
     */
    public function create()
    {
        $config = config('database');

        $sql = "-- -----------------------------\n";
        $sql .= "-- Niucloud MySQL Data Transfer \n";
        $sql .= "-- author niuteam \n";
        $sql .= "-- \n";
        $sql .= "-- Host     : " . $config[ 'connections' ][ 'mysql' ][ 'hostname' ] . "\n";
        $sql .= "-- Port     : " . $config[ 'connections' ][ 'mysql' ][ 'hostport' ] . "\n";
        $sql .= "-- Database : " . $config[ 'connections' ][ 'mysql' ][ 'database' ] . "\n";
        $sql .= "-- \n";
        $sql .= "-- Part : #{$this->file['part']}\n";
        $sql .= "-- Date : " . date("Y-m-d H:i:s") . "\n";
        $sql .= "-- -----------------------------\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";
        return $this->write($sql);
    }

    /**
     * 写入SQL语句
     * @param string $sql 要写入的SQL语句
     * @return boolean     true - 写入成功，false - 写入失败！
     */
    private function write($sql)
    {
        $size = strlen($sql);

        //由于压缩原因，无法计算出压缩后的长度，这里假设压缩率为50%，
        //一般情况压缩率都会高于50%；
        $size = $this->config[ 'compress' ] ? $size / 2 : $size;

        $this->open($size);
        return $this->config[ 'compress' ] ? @gzwrite($this->fp, $sql) : @fwrite($this->fp, $sql);
    }

    /**
     * 备份表结构
     * @param string $table 表名
     * @param integer $start 起始行数
     * @return boolean        false - 备份失败
     */
    public function backup($table, $start)
    {
        //备份表结构
        if (0 == $start) {
            $result = Db::query("SHOW CREATE TABLE `{$table}`");
            $sql = "\n";
            $sql .= "-- -----------------------------\n";
            $sql .= "-- Table structure for `{$table}`\n";
            $sql .= "-- -----------------------------\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $sql .= trim($result[ 0 ][ 'Create Table' ]) . ";\n\n";
            if (false === $this->write($sql)) {
                return false;
            }
        }

        //数据总数
        $result = Db::query("SELECT COUNT(*) AS count FROM `{$table}`");
        $count = $result[ '0' ][ 'count' ];

        //备份表数据
        if ($count) {
            //写入数据注释
            if (0 == $start) {
                $sql = "-- -----------------------------\n";
                $sql .= "-- Records of `{$table}`\n";
                $sql .= "-- -----------------------------\n";
                $this->write($sql);
            }

            //备份数据记录
            $result = Db::query("SELECT * FROM `{$table}`");
            foreach ($result as $row) {
                $row = array_map(
                    function($item) {
                        if (is_json($item)) {
                            return json_encode(json_decode($item, true), JSON_UNESCAPED_UNICODE);
                        } else {
                            return $item;
                        }
                    },
                    $row
                );
                $sql = "INSERT INTO `{$table}` VALUES ('" . implode("', '", $row) . "');\n";
                if (false === $this->write($sql)) {
                    return false;
                }
            }
        }

        //备份下一表
        return 0;
    }

    /**
     * 还原表数据
     * @param unknown $start
     */
    public function import($start)
    {
        //还原数据
        if ($this->config[ 'compress' ]) {
            $gz = gzopen($this->file[ 1 ], 'r');
            $size = 0;
        } else {
            $size = filesize($this->file[ 1 ]);
            $gz = fopen($this->file[ 1 ], 'r');
        }

        $sql = '';
        if ($start) {
            $this->config[ 'compress' ] ? gzseek($gz, $start) : fseek($gz, $start);
        }

        for ($i = 0; $i < 1000; $i++) {
            $sql .= $this->config[ 'compress' ] ? gzgets($gz) : fgets($gz);
            if (preg_match('/.*;$/', trim($sql))) {
                // Log::write('恢复sql'.$sql);
                if (false !== Db::execute($sql)) {
                    $start += strlen($sql);
                } else {
                    return false;
                }
                $sql = '';
            } elseif ($this->config[ 'compress' ] ? gzeof($gz) : feof($gz)) {
                return 0;
            }
        }
        return array ( $start, $size );
    }


    /**
     * 析构方法，用于关闭文件资源
     */
    public function __destruct()
    {
        $this->config[ 'compress' ] ? @gzclose($this->fp) : @fclose($this->fp);
    }
}