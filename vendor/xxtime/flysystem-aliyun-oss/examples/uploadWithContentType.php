<?php
/**
 * 指定上传文件的Content-Type
 * 此设置可以不指定文件路径后缀
 */

use League\Flysystem\Filesystem;
use Xxtime\Flysystem\Aliyun\OssAdapter;
use finfo;

class uploadWithContentType
{

    public function demo()
    {

        $fileContent = file_get_contents('/path/to/file.jpg');

        // 配置
        $adapter = new OssAdapter([
            'accessId'       => "xxx",
            'accessSecret'   => "xxx",
            'bucket'         => "xxx",
            'endpoint'       => "xxx",
            'timeout'        => 3600,
            'connectTimeout' => 10,
        ]);
        $filesystem = new Filesystem($adapter);

        // 设置属性
        // 如设置了Content-Type，则可以不指定路径的后缀 (即$filePath可以不包含.jpg等后缀名)
        $fInfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fInfo->buffer($fileContent);
        $config = [
            "Content-Type" => $mimeType
        ];
        $filePath = "uploadPathTest/" . time();

        // 上传
        if (!$filesystem->write($filePath, $fileContent, $config)) {
            exit("failed to upload");
        }

        // 获取信息
        $raw = $adapter->supports->getFlashData();
        var_dump($raw);

    }

}
