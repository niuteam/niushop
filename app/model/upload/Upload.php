<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\model\upload;

use extend\Upload as UploadExtend;
use Intervention\Image\ImageManagerStatic as Image;
use app\model\BaseModel;

class Upload extends BaseModel
{

    public $upload_path = __UPLOAD__;//公共上传文件
    public $config = []; //上传配置
    public $site_id;
    public $rule_type;//允许上传 mime类型
    public $rule_ext;// 允许上传 文件后缀
    public $path;//上传路径

    public function __construct($site_id = 1, $app_module = 'shop')
    {
        $this->site_id = $site_id;
        $config_model = new Config();
        $config_result = $config_model->getUploadConfig(1, 'shop');
        $this->config = $config_result[ "data" ][ "value" ];//上传配置
    }
    /************************************************************上传开始*********************************************/

    /**
     * 单图上传
     * @param number $site_id
     * @param string $thumb_type 生成缩略图类型
     */
    public function image($param)
    {
        $check_res = $this->checkImg();
        if ($check_res[ "code" ] >= 0) {
            $file = request()->file($param[ "name" ]);
            if (empty($file))
                return $this->error();

            $tmp_name = $file->getPathname();//获取上传缓存文件
            $original_name = $file->getOriginalName();//文件原名
            $file_path = $this->path;
            // 检测目录
            $checkpath_result = $this->checkPath($file_path);//验证写入文件的权限
            if ($checkpath_result[ "code" ] < 0)
                return $checkpath_result;

            $file_name = $file_path . $this->createNewFileName();
            $extend_name = $file->getOriginalExtension();

            $thumb_type = $param[ "thumb_type" ];
            //原图保存
            $new_file = $file_name . "." . $extend_name;
            $image = Image::make($tmp_name);
            $width = $image->width();//图片宽
            $height = $image->height();//图片高
            // 是否需生成水印
            if (isset($param[ 'watermark' ]) && $param[ 'watermark' ]) {
                $image = $this->imageWater($image);
            }
            // 是否需上传到云存储
            if (isset($param[ 'cloud' ]) && $param[ 'cloud' ]) {
                $result = $this->imageCloud($image, $new_file);
                if ($result[ "code" ] < 0)
                    return $result;
            } else {
                try {
                    $image->save($new_file);
                    $result = $this->success($new_file, "UPLOAD_SUCCESS");
                } catch (\Exception $e) {
                    return $this->error('', $e->getMessage());
                }
            }

            $thumb_res = $this->thumbBatch($tmp_name, $file_name, $extend_name, $thumb_type);//生成缩略图
            if ($thumb_res[ "code" ] < 0)
                return $result;

            $data = array (
                "pic_path" => $result[ "data" ],//图片云存储
                "pic_name" => $original_name,
                "file_ext" => $extend_name,
                "pic_spec" => $width . "*" . $height,
                "update_time" => time(),
                "site_id" => $this->site_id
            );
            return $this->success($data, "UPLOAD_SUCCESS");
        } else {
            //返回错误信息
            return $check_res;
        }
    }

    /**
     * 相册图片上传
     * @param number $site_id
     * @param number $category_id
     * @param string $thumb_type
     */
    public function imageToAlbum($param)
    {
        $check_res = $this->checkImg();
        if ($check_res[ "code" ] >= 0) {
            $file = request()->file($param[ "name" ]);
            if (empty($file))
                return $this->error();

            $tmp_name = $file->getPathname();//获取上传缓存文件
            $original_name = $file->getOriginalName();//文件原名

            $file_path = $this->path;
            // 检测目录
            $checkpath_result = $this->checkPath($file_path);//验证写入文件的权限
            if ($checkpath_result[ "code" ] < 0)
                return $checkpath_result;

            $file_name = $file_path . $this->createNewFileName();
            $extend_name = $file->getOriginalExtension();

            $thumb_type = $param[ "thumb_type" ];//所留
            $album_id = $param[ "album_id" ];
            //原图保存
            $new_file = $file_name . "." . $extend_name;
            $image = Image::make($tmp_name);
            $width = $image->width();//图片宽
            $height = $image->height();//图片高
            $image = $this->imageWater($image);
            $result = $this->imageCloud($image, $new_file);//原图云上传(文档流上传)
            if ($result[ "code" ] < 0)
                return $result;

            $thumb_res = $this->thumbBatch($result['data'], $file_name, $extend_name, $thumb_type);//生成缩略图
            if ($thumb_res[ "code" ] < 0)
                return $result;

            $pic_name_first = substr(strrchr($original_name, '.'), 1);

            $pic_name = basename($original_name, "." . $pic_name_first);

            $data = array (
                "pic_path" => $result[ "data" ],//图片云存储
                "pic_name" => $pic_name,
                "pic_spec" => $width . "*" . $height,
                "update_time" => time(),
                "site_id" => $this->site_id,
                "album_id" => $album_id
            );
            $album_model = new Album();
            $res = $album_model->addAlbumPic($data);
            if ($res[ 'code' ] >= 0) {
                $data[ "id" ] = $res[ "data" ];
                return $this->success($data, "UPLOAD_SUCCESS");
            } else {
                return $this->error($res);
            }
        } else {
            //返回错误信息
            return $check_res;
        }

    }

    /*
     * 替换图片文件
     * */
    public function modifyFile($param)
    {
//        参数校验
        if(empty($param['album_id'])){
            return $this->error('', "PARAMETER_ERROR");
        }

        if(empty($param['pic_id'])){
            return $this->error('', "PARAMETER_ERROR");
        }

        if(empty($param['filename'])){
            return $this->error('', "PARAMETER_ERROR");
        }

        if(empty($param['suffix'])){
            return $this->error('', "PARAMETER_ERROR");
        }

        $check_res = $this->checkImg();

        if ($check_res[ "code" ] >= 0) {

            $file = request()->file($param[ "name" ]);
            if (empty($file))
                return $this->error();

            $tmp_name = $file->getPathname();//获取上传缓存文件
            $original_name = $file->getOriginalName();//文件原名

            $file_path = $this->path;
            // 检测目录
            $checkpath_result = $this->checkPath($file_path);//验证写入文件的权限
            if ($checkpath_result[ "code" ] < 0){
                return $checkpath_result;
            }

//            保留原文件名和后缀
            $file_name = $file_path . $param['filename'];
            $extend_name = $param['suffix'];
            $thumb_type = $param[ "thumb_type" ];//所留
            //原图保存
            $new_file = $file_name . "." . $extend_name;
            $image = Image::make($tmp_name);
            $width = $image->width();//图片宽
            $height = $image->height();//图片高
            $image = $this->imageWater($image);

            $result = $this->imageCloud($image, $new_file);//原图云上传(文档流上传)
            if ($result[ "code" ] < 0){
                return $result;
            }

            $thumb_res = $this->thumbBatch($tmp_name, $file_name, $extend_name, $thumb_type);//生成缩略图
            if ($thumb_res[ "code" ] < 0){
                return $thumb_res;
            }

            $pic_name_first = substr(strrchr($original_name, '.'), 1);
            $pic_name = basename($original_name, "." . $pic_name_first);

            $data = array (
                "pic_path" => $result[ "data" ],//图片云存储
                "pic_spec" => $width . "*" . $height,
                "update_time" => time(),
            );

            $album_model = new Album();
            $condition   = array(
                ["pic_id", "=", $param['pic_id']],
                ["site_id", "=", $this->site_id],
                ['album_id', "=", $param['album_id']],
            );

            $res = $album_model->editAlbumPic($data, $condition);

            if ($res[ 'code' ] >= 0) {
                $data[ "id" ] = $res[ "data" ];
                return $this->success($data, "UPLOAD_SUCCESS");
            } else {
                return $this->error($res);
            }

        } else {
            //返回错误信息
            return $check_res;
        }

    }

    /**
     * 视频上传
     * @param $param
     */
    public function video($param)
    {
        $check_res = $this->checkFile();
        if ($check_res[ "code" ] >= 0) {
            // 获取表单上传文件
            $file = request()->file($param[ "name" ]);
            try {
                $extend_name = $file->getOriginalExtension();
                $new_name = $this->createNewFileName() . "." . $extend_name;

                $file_path = $this->path;
                \think\facade\Filesystem::disk('public')->putFileAs($file_path, $file, $new_name);
                $file_name = $file_path . $new_name;
                $result = $this->fileCloud($file_name);
                return $this->success([ "path" => $result[ 'data' ] ?? '' ], "UPLOAD_SUCCESS");
            } catch (\think\exception\ValidateException $e) {
                return $this->error('', $e->getMessage());
            }
        } else {
            return $check_res;
        }
    }

    /**
     * 上传文件
     * @param $param
     */
    public function file($param)
    {
        $check_res = $this->checkFile();
        if ($check_res[ "code" ] >= 0) {
            // 获取表单上传文件
            $file = request()->file($param[ "name" ]);
            try {
                $extend_name = $file->getOriginalExtension();
                if (!empty($param[ 'extend_type' ])) {
                    if (!in_array($extend_name, $param[ 'extend_type' ])) {
                        return $this->error([], 'UPLOAD_TYPE_ERROR');
                    }
                }
                $new_name = $this->createNewFileName() . "." . $extend_name;
                $file_path = $this->path;
                \think\facade\Filesystem::disk('public')->putFileAs($file_path, $file, $new_name);
                $file_name = $file_path . $new_name;
                return $this->success([ "path" => $file_name, 'name' => $new_name ], "UPLOAD_SUCCESS");
            } catch (\think\exception\ValidateException $e) {
                return $this->error('', $e->getMessage());
            }
        } else {
            return $check_res;
        }

    }

    /**
     *  域名校验文件
     */
    public function domainCheckFile($param)
    {
        $check_res = $this->checkFile();
        if ($check_res[ "code" ] >= 0) {
            // 获取表单上传文件
            $file = request()->file($param[ "name" ]);
            try {
                $file_name = $file->getOriginalName();
                $file_path = '';
                \think\facade\Filesystem::disk('public')->putFileAs($file_path, $file, $file_name);
                $file_name = $file_path . $file_name;
                return $this->success([ "path" => $file_name ], "UPLOAD_SUCCESS");
            } catch (\think\exception\ValidateException $e) {
                return $this->error('', $e->getMessage());
            }
        } else {
            return $check_res;
        }
    }
    /************************************************************上传结束*********************************************/
    /************************************************************上传功能组件******************************************/


    /**
     * 缩略图生成
     * @param unknown $file_name
     * @param unknown $extend_name
     * @param unknown $thumb_type
     * @return Ambigous <string, multitype:multitype:string  >
     */
    private function thumbBatch($file_path, $file_name, $extend_name, $thumb_type = [])
    {
        $thumb_type_array = array (
            "BIG" => array (
                "size" => "BIG",
                "width" => $this->config[ "thumb" ][ "thumb_big_width" ],
                "height" => $this->config[ "thumb" ][ "thumb_big_height" ],
                "thumb_name" => ""
            ),
            "MID" => array (
                "size" => "MID",
                "width" => $this->config[ "thumb" ][ "thumb_mid_width" ],
                "height" => $this->config[ "thumb" ][ "thumb_mid_height" ],
                "thumb_name" => ""
            ),
            "SMALL" => array (
                "size" => "SMALL",
                "width" => $this->config[ "thumb" ][ "thumb_small_width" ],
                "height" => $this->config[ "thumb" ][ "thumb_small_height" ],
                "thumb_name" => ""
            )
        );
        foreach ($thumb_type_array as $k => $v) {
            if (!empty($thumb_type) && in_array($k, $thumb_type)) {
                $new_path_name = $file_name . "_" . $v[ "size" ] . "." . $extend_name;
                $result = $this->imageThumb($file_path, $new_path_name, $v[ "width" ], $v[ "height" ]);
                //返回生成的缩略图路径
                if ($result[ "code" ] >= 0) {
                    $thumb_type_array[ $k ][ "thumb_name" ] = $new_path_name;
                } else {
                    return $result;
                }
            }
        }
        return $this->success($thumb_type_array);
    }

    /**
     * 缩略图
     * @param unknown $file_name
     * @param unknown $new_path
     * @param unknown $width
     * @param unknown $height
     * @return multitype:boolean unknown |multitype:boolean
     */
    public function imageThumb($file, $thumb_name, $width, $height)
    {
        $image = Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
//            $constraint->upsize();
        });
        $now_width = $image->width();
        $now_height= $image->height();
        $new_height = $height - $now_height;
        $new_width = $width - $now_width;
        $image = $image->resizeCanvas($new_width, $new_height, 'center', true, 'ffffff');
//        $image = $this->imageWater($image);
        $result = $this->imageCloud($image, $thumb_name);
        return $result;
    }

    /**
     * 添加水印
     */
    public function imageWater($image)
    {
        //判断是否有水印(具体走配置)
        if ($this->config[ "water" ][ "is_watermark" ]) {
            switch ( $this->config[ "water" ][ "watermark_type" ] ) {
                case "1"://图片水印
                    if (!empty($this->config[ "water" ][ "watermark_source" ]) && is_file($this->config[ "water" ][ "watermark_source" ])) {
                        $watermark = Image::make($this->config[ "water" ][ "watermark_source" ]);
                        $image->insert($watermark, $this->config[ "water" ][ "watermark_position" ], $this->config[ "water" ][ "watermark_x" ], $this->config[ "water" ][ "watermark_y" ]);
                    }
                    break;
                case "2"://文字水印
                    if (!empty($this->config[ "water" ][ "watermark_text" ])) {
                        $image->text($this->config[ "water" ][ "watermark_text" ], $this->config[ "water" ][ "watermark_x" ], $this->config[ "water" ][ "watermark_y" ], function($font) {
//                        $font->file($this->config["water"]["watermark_text_file"]);//设置字体文件位置
                            $font->size($this->config[ "water" ][ "watermark_text_size" ]);//设置字号大小
                            $font->color($this->config[ "water" ][ "watermark_text_color" ]);//设置字号颜色
                            $font->align($this->config[ "water" ][ "watermark_text_align" ]);//设置字号水平位置
                            $font->valign($this->config[ "water" ][ "watermark_text_valign" ]);//设置字号 垂直位置
                            $font->angle($this->config[ "water" ][ "watermark_text_angle" ]);//设置字号倾斜角度
                        });
                    }
                    break;
            }
        }

        return $image;
    }

    /**
     * 删除文件
     * @param $file_name
     */
    private function deleteFile($file_name)
    {
        $res = @unlink($file_name);
        if ($res) {
            return $this->success();
        } else {
            return $this->error();
        }

    }

    /**
     * 图片云上传中转
     * @param $image
     * @param $file
     * @return array|mixed|string
     */
    public function imageCloud($image, $file)
    {
        try {
            $image->save($file);
            $result = $this->fileCloud($file);
            //云上传没有成功  保存到本地
            return $result;
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage());
        }

    }

    /**
     * 云上传
     */
    public function fileCloud($file)
    {
        try {
            //走 云上传
            $put_result = event("Put", [ "file_path" => $file, "key" => $file ], true);
            if (!empty($put_result)) {
                $this->deleteFile($file);
                if ($put_result[ "code" ] >= 0) {
                    $file = $put_result[ "data" ][ "path" ];
                } else {
                    return $put_result;
                }
            }
            //云上传没有成功  保存到本地
            return $this->success($file, "UPLOAD_SUCCESS");
        } catch (\Exception $e) {
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 检测图片上传 类型  大小
     * @param $file_info
     * @return \multitype
     */
    public function checkImage1($file_info)
    {
        $upload_extend = new UploadExtend('');//实例化上传类
        $upload_extend->setFilename($file_info[ "tmp_name" ]);
        $rule_type = $this->config[ "upload" ][ "image_allow_mime" ];//规则mine类型
        $rule_ext = $this->config[ "upload" ][ "image_allow_ext" ];//规则 允许上传后缀
//        $rule = [ "type" => "image/png,image/jpeg,image/gif,image/bmp", "ext" => "gif,jpg,jpeg,bmp,png" ];//上传文件验证规则
        $rule = [ "type" => $rule_type, "ext" => $rule_ext ];//上传文件验证规则
        $old_name = $upload_extend->getFileName($file_info[ "name" ]);//文件原名
        $file_name = $this->site_id . "/images/" . date("Ymd") . "/" . $upload_extend->createNewFileName();
        $extend_name = $upload_extend->getFileExt($file_info[ "name" ]);
        $size_data = $upload_extend->getImageInfo($file_info[ "tmp_name" ]);//获取图片信息
        $check = $upload_extend->setValidate($rule)->setUploadInfo($file_info)->checkAll($this->upload_path, $file_name . "." . $extend_name);
        if (!$check)
            return $this->error("", $upload_extend->getError());

        $data = array (
            "file_name" => $file_name,
            "old_name" => $old_name,
            "extend_name" => $extend_name,
            "size_data" => $size_data,
        );
        return $this->success($data);

    }

    /**
     * 图片验证
     * @param $file
     * @return \multitype
     */
    public function checkImg()
    {
        try {
            $file = request()->file();
            $rule_array = [];
            $size_rule = $this->config[ "upload" ][ "max_filesize" ];
            $ext_rule = $this->config[ "upload" ][ "image_allow_ext" ];
            $mime_rule = $this->config[ "upload" ][ "image_allow_mime" ];

//            $size_rule = 10240;
//            $ext_rule = "jpg,jpeg,png,gif,pem";
//            $mime_rule = "image/jpeg,image/gif,image/png,text/plain";

            if (!empty($size_rule)) {
                $rule_array[] = "fileSize:{$size_rule}";
            }
            if (!empty($ext_rule)) {
                $rule_array[] = "fileExt:{$ext_rule}";
            }
            if (!empty($mime_rule)) {
                $rule_array[] = "fileMime:{$mime_rule}";
            }
            if (!empty($rule_array)) {
                //            'image'=>'filesize:10240|fileExt:jpg,jpeg,png,gif,pem|fileMime:image/jpeg,image/gif,image/png,text/plain'
                $rule = implode("|", $rule_array);
                validate([ 'file' => $rule ])->check($file);
            }
            return $this->success();
        } catch (\think\exception\ValidateException $e) {
            return $this->error('', $e->getMessage());
        }
    }

    /**
     * 图片验证
     * @param $file
     * @return \multitype
     */
    public function checkFile()
    {
        try {
            $file = request()->file();
            $rule_array = [];
            $size_rule = $this->config[ "upload" ][ "max_filesize" ];
//            $ext_rule = $this->config["upload"]["image_allow_ext"];
//            $mime_rule = $this->config["upload"]["image_allow_mime"];

//            $size_rule = 10240*100;
//            $ext_rule = "jpg,jpeg,png,gif,pem";
//            $mime_rule = "image/jpeg,image/gif,image/png,text/plain";

//            if(!empty($size_rule)){
//                $rule_array[] = "fileSize:{$size_rule}";
//            }
//            if(!empty($ext_rule)){
//                $rule_array[] = "fileExt:{$ext_rule}";
//            }
//            if(!empty($mime_rule)){
//                $rule_array[] = "fileMime:{$mime_rule}";
//            }
//            $rule = implode("|", $rule_array);
//            'image'=>'filesize:10240|fileExt:jpg,jpeg,png,gif,pem|fileMime:image/jpeg,image/gif,image/png,text/plain'
//            $res = validate(['file'=>$rule])->check($file);
//            if($res){
//                return $this->success();
//            }else{
//                return $this->error();
//            }
            return $this->success();
        } catch (\think\exception\ValidateException $e) {
            echo $e->getMessage();
        }
    }
    /************************************************************上传功能组件******************************************/


    /**
     *获取一个新文件名
     */
    public function createNewFileName()
    {
        $name = date('Ymdhis', time())
            . sprintf('%03d', microtime(true) * 1000)
            . sprintf('%02d', mt_rand(10, 99));
        return $name;
    }

    /**
     * 验证目录是否可写
     * @param unknown $path
     * @return boolean
     */
    public function checkPath($path)
    {
        if (is_dir($path) || mkdir($path, 0755, true)) {
            return $this->success();
        }

        return $this->error('', "directory {$path} creation failed");
    }

    /**
     * 设置上传目录
     * @param $path
     */
    public function setPath($path)
    {
        if ($this->site_id > 0) {
            $this->path = $this->site_id . "/" . $path;
        } else {
            $this->path = $path;
        }
        $this->path = $this->upload_path . "/" . $this->path;
        return $this;
    }


    /**
     * 远程拉取图片
     * @param $path
     */
    public function remotePull($path)
    {

        $file_path = $this->path;
        // 检测目录
        $checkpath_result = $this->checkPath($file_path);//验证写入文件的权限
        if ($checkpath_result[ "code" ] < 0)
            return $checkpath_result;

        $file_name = $file_path . $this->createNewFileName();
        $new_file = $file_name . ".png";


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $file = curl_exec($ch);
        curl_close($ch);

        $image = Image::make($file);
        $image = $this->imageWater($image);
        $result = $this->imageCloud($image, $new_file);//原图云上传(文档流上传)
        if ($result[ "code" ] < 0)
            return $result;

        return $this->success([ "pic_path" => $result[ "data" ] ]);
    }

    public function remotePullBinary($file)
    {
        $file_path = $this->path;
        // 检测目录
        $checkpath_result = $this->checkPath($file_path);//验证写入文件的权限
        if ($checkpath_result[ "code" ] < 0)
            return $checkpath_result;

        $file_name = $file_path . $this->createNewFileName();
        $new_file = $file_name . ".png";

        $image = Image::make($file);
        $result = $this->imageCloud($image, $new_file);//原图云上传(文档流上传)
        if ($result[ "code" ] < 0)
            return $result;

        return $this->success([ "pic_path" => $result[ "data" ] ]);
    }

    /**
     * 远程拉取图片到本地
     * @param $path
     */
    public function remotePullToLocal($path)
    {

        if (stristr($path, 'http://') || stristr($path, 'https://')) {
            $file_path = $this->path;
            // 检测目录
            $checkpath_result = $this->checkPath($file_path);//验证写入文件的权限
            if ($checkpath_result[ "code" ] < 0)
                return $checkpath_result;

            $file_name = $file_path . $this->createNewFileName();
            $new_file = $file_name . ".png";


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            $file = curl_exec($ch);
            curl_close($ch);

            $image = Image::make($file);
            $image = $this->imageWater($image);
            $image->save($new_file);
            return $this->success([ "path" => $new_file ]);
        } else {
            return $this->success([ "path" => $path ]);
        }
    }
}