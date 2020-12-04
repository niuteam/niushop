<?php
namespace extend;

use Intervention\Image\ImageManagerStatic as Image;

class Poster
{
    
    private $poster;
    private $width;
    private $height;
    
    public function __construct($width, $height){
        $this->width = $width;
        $this->height = $height;
        $this->poster = imagecreatetruecolor($width, $height);
    }
    
    /**
     * 设置背景色
     * @param unknown $red
     * @param unknown $green
     * @param unknown $blue
     */
    public function setBackground($red, $green, $blue){
        $color = $this->createColor($red, $green, $blue);
        imagefilledrectangle($this->poster, 0, 0, $this->width, $this->height, $color);
    }
    
    /**
     * 创建颜色
     * @param unknown $red
     * @param unknown $green
     * @param unknown $blue
     * @return number
     */
    private function createColor($red, $green, $blue){
        $color = imagecolorallocate($this->poster, $red, $green, $blue);
        return $color;
    }
    
    /**
     * 创建透明色
     * @param unknown $red
     * @param unknown $green
     * @param unknown $blue
     * @param unknown $alpha 0不透明  127完全透明
     */
    public function createAlphaColor($red, $green, $blue, $alpha){
        $color = imagecolorallocatealpha($this->poster, $red, $green, $blue, $alpha);
        return $color;
    }
    
    /**
     * 将图片写入海报
     * @param unknown $image_path
     * @param unknown $x
     * @param unknown $y
     * @param unknown $width
     * @param unknown $height
     */
    public function imageCopy($image_path, $x, $y, $width, $height, int $radius = 0){
        $image = $this->getImageResources($image_path);
        if ($radius > 0) $image = $this->radius($image_path, $radius);
        imagecopyresampled($this->poster, $image['image'], $x, $y, 0, 0, $width, $height, $image['width'], $image['height']);
    }
    
    /**
     * 将图片转为圆形后写入海报
     * @param unknown $image_path
     * @param unknown $x
     * @param unknown $y
     * @param unknown $width
     * @param unknown $height
     */
    public function imageCircularCopy($image_path, $x, $y, $width, $height){
        $image = $this->circular($image_path);
        imagecopyresampled($this->poster, $image['image'], $x, $y, 0, 0, $width, $height, $image['width'], $image['height']);
    }
    
    /**
     * 将文字写入海报
     * @param string $text 
     * @param int $size 文字大小
     * @param array $color 文字颜色 [$red, $green, $blue]
     * @param int $x x轴起始点
     * @param int $y y轴起始点
     * @param number $max_width 最大宽度
     * @param number $max_line 最大行数
     * @param string $blod 是否加粗
     */
    public function imageText(string $text, int $size, array $color, int $x, int $y, $max_width = 0, $max_line = 1, $blod = false){
        $text = $this->handleStr($text, $size, $max_width, $max_line);
        $color = $this->createColor(...$color);
        imagettftext($this->poster, $size, 0, $x, $y, $color, PUBLIC_PATH . 'static/font/Microsoft.ttf', $text);
        if ($blod) imagettftext($this->poster, $size, 0, ($x + 1), ($y + 1), $color, PUBLIC_PATH . 'static/font/Microsoft.ttf', $text);
    }
    
    /**
     * 字符串处理
     * @param unknown $str
     * @param unknown $size
     * @param unknown $max_width
     * @param unknown $max_line
     */
    private function handleStr($str, $size, $max_width, $max_line)
    {
        if (empty($str)) return $str;
        mb_internal_encoding("UTF-8");
        $letter = [];
        $content = '';
        $line = 1;
        for ($i = 0; $i < mb_strlen($str); $i++) {
            $letter[] = mb_substr($str, $i, 1);
        }
        foreach ($letter as $l) {
            $temp_str = $content . " " . $l;
            $fontBox = imagettfbbox($size, 0, PUBLIC_PATH . 'static/font/Microsoft.ttf', $temp_str);
            if (($fontBox[2] > $max_width) && ($content !== "")) {
                $content .= "\n";
                $line += 1;
            }
            if ($line <= $max_line) {
                $content .= $l;
            } else {
                $content = mb_substr($content, 0, (mb_strlen($content) - 2)) . '...';
                break;
            }
        }
        return $content;
    }
    
    /**
     * 将图片转正圆
     * @param unknown $filename
     */
    private function circular($filename){
        $image_info = $this->getImageResources($filename);
        $width = min($image_info['width'], $image_info['height']);
        $height = $width;
        // 如果图片不是正方形
        if ($image_info['width'] != $image_info['height']) {
            $temp_file_path = 'upload/temp_' .uniqid() . '.' . $image_info['ext'];
            $image_manager  = Image::make($filename)->fit($width, $height, function ($constraint) {
            }, 'center');
            $image_manager->save($temp_file_path);
            $image_info = $this->getImageResources($temp_file_path);
            unlink($temp_file_path);
        }
        $image = imagecreatetruecolor($width, $height);
        imagesavealpha($image, true);
        $bg = imagecolorallocatealpha($image, 255, 255, 255, 127);
        imagefill($image, 0, 0, $bg);
        $r = $width / 2; //圆半径
        $y_x = $r; //圆心X坐标
        $y_y = $r; //圆心Y坐标
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgbColor = imagecolorat($image_info['image'], $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($image, $x, $y, $rgbColor);
                }
            }
        }
        $image_info['image'] = $image;
        return $image_info;
    }
    
    /**
     * 图片设置圆角
     * @param string $filename
     * @param int $radius
     */
    private function radius(string $filename, int $radius){
        $image_info = $this->getImageResources($filename);
        // 创建画布
        $image = imagecreatetruecolor($image_info['width'], $image_info['height']);
        imagesavealpha($image, true);
        $bg = imagecolorallocatealpha($image, 255, 255, 255, 127); // 创建一个完全透明色
        imagefill($image, 0, 0, $bg);
    
        for ($x = 0; $x < $image_info['width']; $x++) {
            for ($y = 0; $y < $image_info['height']; $y++) {
                $rgb_color = imagecolorat($image_info['image'], $x, $y);//获取像素索引
                if (($x >= $radius && $x <= ($image_info['width'] - $radius)) || ($y >= $radius && $y <= ($image_info['height'] - $radius))) {
                    //不在四角的范围内,直接画
                    imagesetpixel($image, $x, $y, $rgb_color);
                }else {
                    //在四角的范围内选择画
                    //上左
                    $y_x = $radius; //圆心X坐标
                    $y_y = $radius; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($radius * $radius))) {
                        imagesetpixel($image, $x, $y, $rgb_color);
                    }
                    //上右
                    $y_x = $image_info['width'] - $radius; //圆心X坐标
                    $y_y = $radius; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($radius * $radius))) {
                        imagesetpixel($image, $x, $y, $rgb_color);
                    }
                    //下左
                    $y_x = $radius; //圆心X坐标
                    $y_y = $image_info['height'] - $radius; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($radius * $radius))) {
                        imagesetpixel($image, $x, $y, $rgb_color);
                    }
                    //下右
                    $y_x = $image_info['width'] - $radius; //圆心X坐标
                    $y_y = $image_info['height'] - $radius; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($radius * $radius))) {
                        imagesetpixel($image, $x, $y, $rgb_color);
                    }
                }
            }
        }
        $image_info['image'] = $image;
        return $image_info;
    }
    
    /**
     * 创建海报内容
     * @param unknown $data
     * @return \extend\Poster|multitype:
     */
    public function create($data){
        try {
            foreach ($data as $item) {
                $action = $item['action'];
                $this->$action(...$item['data']);
            }
            return $this;
        } catch (\Exception $e) {
            return error(-1, $e->getMessage());
        }        
    }
    
    /**
     * 获取图片资源
     * @param unknown $filename
     * @return multitype:unknown multitype:
     */
    private function getImageResources($filename){
        [0 => $width, 1 => $height, 'mime' => $mime] = getimagesize($filename);
        $ext = explode('/', $mime)[1];
        switch ($ext) {
            case "png":
                $image = imagecreatefrompng($filename);
                break;
            case "jpeg":
                $image = imagecreatefromjpeg($filename);
                break;
            case "jpg":
                $image = imagecreatefromjpeg($filename);
                break;
            case "gif":
                $image = imagecreatefromgif($filename);
                break;
        }
        return [
            'width' => $width,
            'height' => $height,
            'mime' => $mime,
            'ext' => $ext,
            'image' => $image
        ];
    }
    
    /**
     * 校验目录是否可写
     * @param unknown $path
     * @return multitype:number unknown |multitype:unknown
     */
    private function checkPath($path)
    {
        if (is_dir($path) || mkdir($path, intval('0755', 8), true)) {
            return success();
        }
        return error(-1, "directory {$path} creation failed");
    }
    
    /**
     * 输出jpeg格式的海报
     * @param unknown $path 图片生成路径
     * @param unknown $name 图片名称
     */
    public function jpeg($path, $name){
        $check_res = $this->checkPath($path);
        if ($check_res['code'] < 0) return $check_res;
        
        try {
            $filename = $path .'/'. $name . '.jpg';
            header("Content-type: image/jpeg"); // 定义输出类型
            imagejpeg($this->poster, $filename); // 输出图片
            imagedestroy($this->poster); // 销毁图片资源
            
            return success(0, '', ['path' => $filename]);            
        } catch (\Exception $e) {
            return error(-1, $e->getMessage());
        }
    }
}