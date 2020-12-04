<?php
// +---------------------------------------------------------------------+
// | NiuCloud | [ WE CAN DO IT JUST NiuCloud ]                |
// +---------------------------------------------------------------------+
// | Copy right 2019-2029 www.niucloud.com                          |
// +---------------------------------------------------------------------+
// | Author | NiuCloud <niucloud@outlook.com>                       |
// +---------------------------------------------------------------------+
// | Repository | https://github.com/niucloud/framework.git          |
// +---------------------------------------------------------------------+

namespace app\model\system;

use app\model\BaseModel;
use think\Exception;
use app\model\web\Config;

class H5 extends BaseModel
{
    public function refresh()
    {
        try {
            $h5_template_path = 'public/h5'; // h5模板文件目录
            $h5_path          = 'h5'; // h5端生成目录
            if (!is_dir($h5_template_path) || count(scandir($h5_template_path)) <= 2) {
                return $this->error('', '未查找到h5模板');
            }

            if (is_dir($h5_path)) {
                // 先将之前的文件删除
                if (count(scandir($h5_path)) > 2) deleteDir($h5_path);
            } else {
                // 创建H5目录
                mkdir($h5_path, intval('0777', 8), true);
            }
            $this->copyFile($h5_template_path, $h5_path);
            file_put_contents($h5_path . '/refresh.log', time());
            return $this->success();
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage() . $e->getLine());
        }
    }

    private function copyFile($source_path, $to_path = '')
    {
        $files = scandir($source_path);
        foreach ($files as $path) {
            if ($path != '.' && $path != '..') {
                $temp_path = $source_path . '/' . $path;
                if (is_dir($temp_path)) {
                    mkdir($to_path . '/' . $path, intval('0777', 8), true);
                    $this->copyFile($temp_path, $to_path . '/' . $path);
                } else {
                    if (file_exists($temp_path)) {
                        if (preg_match("/(index.)(\w{8})(.js)$/", $temp_path)) {
                            $content = file_get_contents($temp_path);
                            $content = $this->paramReplace($content);
                            file_put_contents($to_path . '/' . $path, $content);
                        } else {
                            copy($temp_path, $to_path . '/' . $path);
                        }
                    }
                }
            }
        }
    }

    /**
     * 参数替换
     * @param $site_id
     * @param $string
     * @return null|string|string[]
     */
    private function paramReplace($string)
    {
        $api_model  = new Api();
        $api_config = $api_model->getApiConfig();
        $api_config = $api_config['data'];

        $web_config_model = new Config();
        $web_config = $web_config_model ->getMapConfig();
        $web_config = $web_config['data']['value'];

        $socket_url = (strstr(ROOT_URL, 'https://') === false ? str_replace('http', 'ws', ROOT_URL) : str_replace('https', 'wss', ROOT_URL)) . '/wss';

        $patterns     = [
            '/\{\{\$baseUrl\}\}/',
            '/\{\{\$imgDomain\}\}/',
            '/\{\{\$h5Domain\}\}/',
            '/\{\{\$mpKey\}\}/',
            '/\{\{\$apiSecurity\}\}/',
            '/\{\{\$publicKey\}\}/',
            '/\{\{\$webSocket\}\}/'
        ];
        $replacements = [
            ROOT_URL,
            ROOT_URL,
            ROOT_URL . '/h5',
            $web_config['tencent_map_key'] ?? '',
            $api_config['is_use'] ?? 0,
            $api_config['value']['public_key'] ?? '',
            $socket_url
        ];
        $string       = preg_replace($patterns, $replacements, $string);
        return $string;
    }

}