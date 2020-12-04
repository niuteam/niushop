<?php

namespace extend;

/**
 * 文件比对管理类
 * @author Administrator
 *
 */
class FileManage
{
    public $map = [];
    public $dir = [];

    public function mapCompare($map_old_path, $map_new_path)
    {
        $map_old = include_once $map_old_path;
        $map_new = include_once $map_new_path;
        $upgrade_map = [];

        //比对
        foreach ($map_new as $k => $v) {
            $check_path = isset($map_old[ $k ]) ? $map_old[ $k ] : '';
            if ($check_path != $v) {
                $upgrade_map[ $k ] = $v;
            }
        }
        return $upgrade_map;
    }

    /**
     * 创建文件夹
     *
     * @param string $path 文件夹路径
     * @param int $mode 访问权限
     * @param bool $recursive 是否递归创建
     * @return bool
     */
    public function dir_mkdir($path = '', $mode = 0777, $recursive = true)
    {
        clearstatcache();
        if (!is_dir($path)) {
            mkdir($path, $mode, $recursive);
            return chmod($path, $mode);
        }

        return true;
    }

    public function getDir($path)
    {
        if (is_dir($path)) {
            $dir = scandir($path);
            foreach ($dir as $value) {
                $sub_path = $path . '/' . $value;
                if ($value == '.' || $value == '..') {
                    continue;
                } else if (is_dir($sub_path)) {
                    $this->getDir($sub_path);
                } else {
                    $this->dir[] = $path . '/' . $value;
                }
            }
        }
    }


    /**
     * 生成更新文件地图
     * @param $path
     * @return array
     */
    public function getFileMap($path)
    {

        $this->getDir($path);
        $array = [];
        if (!empty($this->dir)) {
            foreach ($this->dir as $k => $v) {
                $file = file_get_contents($v);
                $file_md5 = md5($file);
                $v = str_replace($path . '/', '', $v);
                $array[ $v ] = $file_md5;
            }
        }
        return $array;
    }

    /**
     * 解压文件
     * @param $filename
     * @param $path
     * @return array|string
     */
    public function unzip($filename, $path)
    {
        if (!file_exists($filename)) {
            return [ "code" => -1, "message" => '文件不存在' ];
        }
        //将文件名和路径转成windows系统默认的gb2312编码，否则将会读取不到
        $filename = iconv("utf-8", "gb2312", $filename);
        $path = iconv("utf-8", "gb2312", $path);
        //打开压缩包
        $resource = zip_open($filename);
        $i = 1;
        //遍历读取压缩包里面的一个个文件
        while ($dir_resource = zip_read($resource)) {
            //如果能打开则继续
            if (zip_entry_open($resource, $dir_resource)) {
                //获取当前项目的名称,即压缩包里面当前对应的文件名
                $file_name = $path . zip_entry_name($dir_resource);
                //以最后一个“/”分割,再用字符串截取出路径部分
                $file_path = substr($file_name, 0, strrpos($file_name, "/"));
                //如果路径不存在，则创建一个目录，true表示可以创建多级目录
                if (!is_dir($file_path)) {
                    mkdir($file_path, 0777, true);
                }
                //如果不是目录，则写入文件
                if (!is_dir($file_name)) {
                    //读取这个文件
                    $file_size = zip_entry_filesize($dir_resource);
                    //最大读取6M，如果文件过大，跳过解压，继续下一个
                    if ($file_size < ( 1024 * 1024 * 50 )) {
                        $file_content = zip_entry_read($dir_resource, $file_size);
                        file_put_contents($file_name, $file_content);
                    } else {
                        return "<p> " . $i++ . " 此文件已被跳过，原因：文件过大， -> " . iconv("gb2312", "utf-8", $file_name) . " </p>";
                    }
                }
                //关闭当前
                zip_entry_close($dir_resource);
            }
        }
        //关闭压缩包
        zip_close($resource);
        return [ "code" => 0, "message" => '解压完毕' ];
    }

    /**
     * 数组写入文件
     * @param $array
     * @param $path
     * @return mixed
     */
    public function arrayWrite($array, $path)
    {
        $str = '';
        foreach ($array as $k => $v) {
            if (empty($str)) {
                $str = "'$k' => '" . $v . "'" . ',';
            } else {
                $str = $str . "\n" . "'$k' => '" . $v . "'" . ',';
            }

        }
        $str = '<?php' . "\n" . ' return [' . "\n" . $str . "\n" . ']; ' . "\n" . '?>';
        $str = charsetToUTF8($str);
        file_put_contents($path, $str);
        return $path;
    }
}