<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\system;

use think\facade\Db;
use app\model\BaseModel;

/**
 * 数据库操作
 */
class Database extends BaseModel
{

    public $backup_path = __UPLOAD__ . '/dbsql';

    /***********************************************************SQL开始*********************************************************/

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
                return $this->success(1);
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return $this->error('', "DABASE_REPAIR_FAIL");
            }
        } else {
            return $this->error('', "DABASE_REPAIR_FAIL");
        }
    }

    /**
     * 优化表
     */
    public function optimize($tables)
    {
        if ($tables) {
            if (is_array($tables)) {
                $tables = implode('`,`', $tables);
                $list   = Db::query("OPTIMIZE TABLE `{$tables}`");
                if ($list) {

                    return $this->success(1);
                } else {
                    return $this->error('', "DATABASE_OPTIMIZE_FAIL");
                }
            } else {
                $list = Db::query("OPTIMIZE TABLE `{$tables}`");
                if ($list) {
                    return $this->success(1);
                } else {
                    return $this->error('', "DATABASE_OPTIMIZE_FAIL");
                }
            }
        } else {
            return $this->error('', "REQUEST_DATABASE_TABLE");
        }
    }

    private function sql_execute($sql, $is_debug)
    {
        if (trim($sql) != '') {
            $sql       = str_replace("\r\n", "\n", $sql);
            $sql       = str_replace("\r", "\n", $sql);
            $sql_array = explode(";\n", $sql);
            if (!$is_debug) {
                Db::startTrans();
            }
            try {
                foreach ($sql_array as $item) {
                    if ($is_debug) {
                        Db::startTrans();
                    }
                    $querySql = trim($item);
                    if ($querySql != '') {
                        @Db::execute($querySql . ";");
                        if ($is_debug) {
                            Db::rollback();
                        }
                    }
                }
                if (!$is_debug) {
                    Db::commit();
                }
                return $this->success(1);
            } catch (\Exception $e) {
                Db::rollback();
                return $this->error($e->getMessage());
            }
        } else {
            return $this->error('');
        }
    }

    /**
     * 执行sql
     */
    public function sqlQuery($sql)
    {
        $result = $this->sql_execute($sql, false);
        return $result;
    }

    public function yujjia($sql)
    {
        Db::startTrans();
        try {
            Db::query($sql);
            Db::rollback();
            return "1";
        } catch (\Exception $e) {
            Db::rollback();
            return $this->error($e->getMessage());
        }

    }

    /**
     * 查询所有表
     */
    public function getDatabaseList()
    {
        $databaseList = Db::query("SHOW TABLE STATUS");
        return $databaseList;
    }

    /**备份数据库语句
     * @return string
     */
    public function backupSql($tables, $id, $start)
    {

    }

    public function getTableSchemas($table)
    {
        $mysql                    = "DROP TABLE IF EXISTS `$table`;\r\n";
        $temp_create_table_result = Db::query("show create table `$table`");
        $create_table             = $temp_create_table_result[0]['Create Table'];
        $mysql                    .= $create_table . ";\r\n";
        return $mysql;
    }

    public function getTableInsertSql($tablename, $start, $size)
    {
        $data   = '';
        $tmp    = '';
        $sql    = "SELECT * FROM `{$tablename}` LIMIT {$start}, {$size}";
        $result = Db::query($sql);
        if (!empty($result)) {
            foreach ($result as $row) {
                $tmp .= '(';
                foreach ($row as $k => $v) {
                    $value = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $v);
                    $tmp   .= "'" . $value . "',";
                }
                $tmp = rtrim($tmp, ',');
                $tmp .= "),\n";
            }
            $tmp   = rtrim($tmp, ",\n");
            $data  .= "INSERT INTO `{$tablename}` VALUES \n{$tmp};\n";
            $datas = array(
                'data'   => $data,
                'result' => $result,
            );
            return $datas;
        } else {
            return false;
        }
    }


    /**
     * 格式化字节大小
     *
     * @param number $size
     *            字节数
     * @param string $delimiter
     *            数字和单位分隔符
     * @return string 格式化后的带单位的大小
     * @author
     *
     */
    public function format_bytes($size, $delimiter = '')
    {
        $units = array(
            'B',
            'KB',
            'MB',
            'GB',
            'TB',
            'PB'
        );
        for ($i = 0; $size >= 1024 && $i < 5; $i++)
            $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }

    /**
     * 多维数组排序
     */
    public function my_array_multisort($data, $sort_order_field, $sort_order = SORT_DESC, $sort_type = SORT_NUMERIC)
    {
        foreach ($data as $val) {
            $key_arrays[] = $val[$sort_order_field];
        }
        array_multisort($key_arrays, $sort_order, $sort_type, $data);
        return $data;
    }


    /***********************************************************SQL结束*********************************************************/

}