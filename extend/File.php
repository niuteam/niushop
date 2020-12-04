<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */
namespace extend;

/**
 * 文件处理
 * @author Administrator
 *
 */

class File
{
    /**
     * 判断 文件/目录 是否可写（取代系统自带的 is_writeable 函数）
     *
     * @param string $file 文件/目录
     * @return boolean
     */
    public function is_write($file)
    {
        if (is_dir($file)) {
            $dir = $file;
            if ($fp = @fopen("$dir/test.txt", 'w')) {
                @fclose($fp);
                @unlink("$dir/test.txt");
                $writeable = true;
            } else {
                $writeable = false;
            }
        } else {
            if ($fp = @fopen($file, 'a+')) {
                @fclose($fp);
                $writeable = true;
            } else {
                $writeable = false;
            }
        }
    
        return $writeable;
    }
    /**
     * 文件尺寸大小
     * @param unknown $dir
     * @return number
     */
    public function get_dir_size($dir_path)
    {
        $size = 0;
        if (is_dir($dir_path)) {
            $handle = opendir($dir_path);
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..') {
                    if (is_dir("{$dir_path}/{$entry}")) {
                        $size += get_dir_size("{$dir_path}/{$entry}");
                    } else {
                        $size += filesize("{$dir_path}/{$entry}");
                    }
                }
            }
            closedir($handle);
        }
        return $size;
    }
    /**
     * 文件尺寸大小换算
     * @param unknown $size
     * @return string
     */
    public function size_conversion($size_num)
    {
    
        switch ($size_num) {
            case $size_num >= 1073741824:
                $size_str = round($size_num / 1073741824 * 100) / 100 . ' GB';
                break;
            case $size_num >= 1048576:
                $size_str = round($size_num / 1048576 * 100) / 100 . ' MB';
                break;
            case $size_num >= 1024:
                $size_str = round($size_num / 1024 * 100) / 100 . ' KB';
                break;
            default:
                $size_str = $size_num . ' Bytes';
                break;
        }
    
        return $size_str;
    }
    
    /**
     * 删除指定目录下的文件和文件夹
     * @param unknown $dirpath
     * @return boolean
     */
    public function del_dir($dirpath)
    {
        $dh = opendir($dirpath);
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                $fullpath = $dirpath . "/" . $file;
                if (!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    $this->del_dir($fullpath);
                    rmdir($fullpath);
                }
            }
        }
        closedir($dh);
        $isEmpty = true;
        $dh = opendir($dirpath);
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                $isEmpty = false;
                break;
            }
        }
        return $isEmpty;
    }
    /**
     * 文件强制下载
     * @param unknown $dir
     */
    public function dir_readfile($dir)
    {
    
        if (file_exists($dir)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($dir));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($dir));
            ob_clean();
            flush();
            readfile($dir);
        }
    }
    /**
     * 压缩文件夹
     * @param unknown $dir
     * @param unknown $zipfile
     */
    public function zip_dir($dir, $zipfile, $newdir = '')
    {
    
        $zip = new ZipArchive();
        if ($zip->open($zipfile, ZipArchive::CREATE) === TRUE) {
            add_file_toZip($dir, $zip, $newdir); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
    
            $zip->close(); //关闭处理的zip文件
        }
    }
    
    /**
     * 读取文件单文件压缩 zipdir方法调用
     * @param unknown $dir
     * @param unknown $zip
     */
    public function add_file_toZip($dir, $zip, $newdir = '')
    {
        $handler = opendir($dir); //打开当前文件夹由$dir指定
        $filename = readdir($handler);
    
        while (($filename = readdir($handler)) !== false) {
    
            if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..'，不要对他们进行操作
                if (is_dir($dir . '/' . $filename)) {// 如果读取的某个对象是文件夹，则递归
                    $this->add_file_toZip($dir . "/" . $filename, $zip, $newdir);
                } else { //将文件加入zip对象
    
                    $new_dir_sep = substr($dir, strpos($dir, $newdir));
                    $zip->addFile($dir . "/" . $filename, $new_dir_sep . '/' . $filename);
                }
            }
        }
        @closedir($dir);
    }
    
    /**
     * 将读取到的目录以数组的形式展现出来
     * @return array
     * opendir() 函数打开一个目录句柄，可由 closedir()，readdir() 和 rewinddir() 使用。
     * is_dir() 函数检查指定的文件是否是目录。
     * readdir() 函数返回由 opendir() 打开的目录句柄中的条目。
     * @param array $files 所有的文件条目的存放数组
     * @param string $file 返回的文件条目
     * @param string $dir 文件的路径
     * @param resource $handle 打开的文件目录句柄
     */
    public function dir_scan($dir)
    {
        //定义一个数组
        $files = array();
        //检测是否存在文件
        if (is_dir($dir)) {
            //打开目录
            if ($handle = opendir($dir)) {
                //返回当前文件的条目
                while (($file = readdir($handle)) !== false) {
                    //去除特殊目录
                    if ($file != "." && $file != "..") {
                        //判断子目录是否还存在子目录
                        if (is_dir($dir . "/" . $file)) {
                            //递归调用本函数，再次获取目录
                            $files[ $file ] = dir_scan($dir . "/" . $file);
                        } else {
                            //获取目录数组
                            $files[] = $file;
                        }
                    }
                }
                //关闭文件夹
                closedir($handle);
                //返回文件夹数组
                return $files;
            }
        }
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
    
    /**
     * 文件夹文件拷贝
     *
     * @param string $src 来源文件夹
     * @param string $dst 目的地文件夹
     * @return bool
     */
    public function dir_copy($src = '', $dst = '')
    {
        if (empty($src) || empty($dst)) {
            return false;
        }
        $dir = opendir($src);
        $this->dir_mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->dir_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    
        return true;
    }   
	
}