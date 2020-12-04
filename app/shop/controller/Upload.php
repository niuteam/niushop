<?php
/**
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2019-2029 上海牛之云网络科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: https://www.niushop.com

 * =========================================================
 */

namespace app\shop\controller;

use app\model\upload\Upload as UploadModel;
use app\model\system\User as UserModel;
use app\model\upload\Config as ConfigModel;
use app\model\upload\Album as AlbumModel;
use think\Exception;
use app\model\BaseModel;



/**
 * 图片上传
 * Class Verify
 * @package app\shop\controller
 */
class Upload extends BaseShop
{
    public $site_id = 0;
    protected $app_module = "shop";

    public function __construct()
    {
        //执行父类构造函数
        parent::__construct();
        $this->site_id = request()->siteid();
        if (empty($this->site_id)) {
            $this->site_id = input("site_id", 0);
            request()->siteid($this->site_id);
        }
    }

    /**
     *  上传配置
     */
    public function config()
    {
        $config_model = new ConfigModel();
        if (request()->isAjax()) {
            //基础上传
            $max_filesize = input("max_filesize", "10240");//允许上传大小
            $image_allow_ext = trim(input("image_allow_ext", ""));//图片允许扩展名
            $image_allow_mime = trim(input("image_allow_mime", ""));//图片允许Mime类型

            /*************************************************************************** 缩略图 *******************************************************************/
            $thumb_big_width = input("thumb_big_width", 400);//缩略大图 宽
            $thumb_big_height = input("thumb_big_height", 400);//缩略大图 高
            $thumb_mid_width = input("thumb_mid_width", 200);//缩略中图 宽
            $thumb_mid_height = input("thumb_mid_height", 200);//缩略中图 高
            $thumb_small_width = input("thumb_small_width", 100);//缩略小图 宽
            $thumb_small_height = input("thumb_small_height", 100);//缩略小图 高
            /*************************************************************************** 水印 *******************************************************************/
            $is_watermark = input("is_watermark", 0);//是否开启水印
            $watermark_type = input("watermark_type", '1');//水印类型  1图片 2文字
            $watermark_source = input("watermark_source", '');//水印图片来源
            $watermark_position = input("watermark_position", 'top-left');//水印图片位置(相对于当前图像)top-left(默认)top top-right left center right bottom-left bottom bottom-right
            $watermark_x = input("watermark_x", 0);//水印图片横坐标偏移量
            $watermark_y = input("watermark_y", 0);//水印图片纵坐标偏移量
            $watermark_opacity = input("watermark_opacity", '0');//水印图片透明度
            $watermark_rotate = input("watermark_rotate", '0');//水印图片倾斜度

            $watermark_text = input("watermark_text", '');//水印文字
            $watermark_text_file = input("watermark_text_file", '');//水印文字 字体文件。设置True Type Font文件的路径，或者GD库内部字体之一的1到5之间的整数值。 默认值：1
            $watermark_text_size = input("watermark_text_size", '12');//水印文字 字体大小。字体大小仅在设置字体文件时可用，否则将被忽略。 默认值：12
            $watermark_text_color = input("watermark_text_color", '#000000');//水印文字 字体颜色
            $watermark_text_align = input("watermark_text_align", 'left');//水印文字水平对齐方式 水平对齐方式：left,right,center。默认left
            $watermark_text_valign = input("watermark_text_valign", 'bottom');//水印文字垂直对齐方式  垂直对齐方式：top,bottom,middle。默认bottom
            $watermark_text_angle = input("watermark_text_angle", '0');//文本旋转角度。文本将围绕垂直和水平对齐点逆时针旋转。 旋转仅在设置字体文件时可用，否则将被忽略

            $data = array (
                //上传相关配置
                "upload" => array (
                    "max_filesize" => $max_filesize,//最大上传限制,
                    "image_allow_ext" => $image_allow_ext,
                    "image_allow_mime" => $image_allow_mime,
                ),
                //缩略图相关配置
                "thumb" => array (
                    "thumb_big_width" => $thumb_big_width,
                    "thumb_big_height" => $thumb_big_height,
                    "thumb_mid_width" => $thumb_mid_width,
                    "thumb_mid_height" => $thumb_mid_height,
                    "thumb_small_width" => $thumb_small_width,
                    "thumb_small_height" => $thumb_small_height,
                ),
                //水印相关配置
                "water" => array (
                    "is_watermark" => $is_watermark,
                    "watermark_type" => $watermark_type,
                    "watermark_source" => $watermark_source,
                    "watermark_position" => $watermark_position,
                    "watermark_x" => $watermark_x,
                    "watermark_y" => $watermark_y,
                    "watermark_opacity" => $watermark_opacity,
                    "watermark_rotate" => $watermark_rotate,
                    "watermark_text" => $watermark_text,
                    "watermark_text_file" => $watermark_text_file,
                    "watermark_text_size" => $watermark_text_size,
                    "watermark_text_color" => $watermark_text_color,
                    "watermark_text_align" => $watermark_text_align,
                    "watermark_text_valign" => $watermark_text_valign,
                    "watermark_text_angle" => $watermark_text_angle,
                ),
            );
            $this->addLog("修改上传配置");
            $result = $config_model->setUploadConfig($data);
            return $result;
        } else {
            $this->forthMenu();
            $config_result = $config_model->getUploadConfig();
            $config = $config_result[ "data" ];
            $this->assign("config", $config);
            $position = array (
                "top-left" => "上左",
                "top" => "上中",
                "top-right" => "上右",
                "left" => "左",
                "center" => "中",
                "right" => "右",
                "bottom-left" => "下左",
                "bottom" => "下中",
                "bottom-right" => "下右",
            );//位置
            $this->assign("position", $position);
            return $this->fetch('upload/config');
        }
    }

    /**
     * 云上传方式
     */
    public function oss()
    {
        if (request()->isAjax()) {
            $config_model = new ConfigModel();
            $list = event('OssType', []);
            return $config_model->success($list);
        } else {
            $this->forthMenu();
            return $this->fetch("upload/oss");
        }
    }

    /**
     * 上传(不存入相册)
     * @return \app\model\upload\Ambigous|\multitype
     */
    public function image()
    {
        $upload_model = new UploadModel($this->site_id, $this->app_module);
        $thumb_type = input("thumb", "");
        $name = input("name", "");
        $watermark = input("watermark", 0); // 是否需生成水印
        $cloud = input("cloud", 1); // 是否需上传到云存储
        $param = array (
            "thumb_type" => "",
            "name" => "file",
            "watermark" => $watermark,
            "cloud" => $cloud
        );
        $path = $this->site_id > 0 ? "common/images/" . date("Ymd") . '/' : "common/images/" . date("Ymd") . '/';
        $result = $upload_model->setPath($path)->image($param);
        return $result;
    }

    /**
     * 上传 存入相册
     * @return \multitype
     */
    public function album()
    {
        $upload_model = new UploadModel($this->site_id);
        $album_id = input("album_id", 0);
        $name = input("name", "");
        $param = array (
            "thumb_type" => [ "BIG", "MID", "SMALL" ],
            "name" => "file",
            "album_id" => $album_id
        );
        $result = $upload_model->setPath("common/images/" . date("Ymd") . '/')->imageToAlbum($param);
        return $result;
    }

    /**
     * 视频上传
     * @return \multitype
     */
    public function video()
    {
        $upload_model = new UploadModel($this->site_id);
        $name = input("name", "");
        $param = array (
            "name" => "file"
        );
        $result = $upload_model->setPath("common/video/" . date("Ymd") . '/')->video($param);
        return $result;
    }

    /**
     * 上传(不存入相册)
     * @return \app\model\upload\Ambigous|\multitype
     */
    public function upload()
    {
        $upload_model = new UploadModel();
        $thumb_type = input("thumb", "");
        $name = input("name", "");
        $param = array (
            "thumb_type" => "",
            "name" => "file"
        );
        $result = $upload_model->setPath("common/images/" . date("Ymd") . '/')->image($param);
        return $result;
    }

    /**
     *  校验文件
     */
    public function checkfile()
    {
        $upload_model = new UploadModel();
        $result = $upload_model->domainCheckFile([ "name" => "file" ]);
        return $result;
    }

    /**
     * 上传文件
     */
    public function file()
    {
        $upload_model = new UploadModel($this->site_id);

        $param = array (
            "name" => "file",
            'extend_type' => [ 'xlsx' ]
        );

        $result = $upload_model->setPath("common/file/" . date("Ymd") . '/')->file($param);
        return $result;
    }

    /**
     * 删除文件
     */
    public function deleteFile()
    {
        if (request()->isAjax()) {
            $path = input("path", '');
            $res = false;
            if (!empty($path)) {
                $res = delFile($path);
            }
            return $res;
        }
    }

    /*
     * 替换图片文件
     * */
    public function modifyFile()
    {

//      实例化响应数据结构生成类
        $base_model = new BaseModel();

        try {
//            参数
            $album_id = input("album_id", '');
            $pic_id = input("pic_id", '');

//            获取图片信息
            $album_model = new AlbumModel($this->site_id);
            $get_pic_info = array(
                ["pic_id", "=", $pic_id],
                ["site_id", "=", $this->site_id],
            );

//            图片信息
            $pic_info = $album_model->getAlbumPicInfo($get_pic_info);
//            判断是否找到有效图片
            if(empty($pic_info) || empty($pic_info['data'])){
                return json($base_model->error('', 'FAIL'));
            }

//            文件名及后缀
            $file_full_name = basename($pic_info['data']['pic_path']);
            $filename_arr = explode('.', $file_full_name);
            $filename =$filename_arr[0];
            $suffix = $filename_arr[1];

//            实例化文件上传类
            $upload_model = new UploadModel($this->site_id);

            $upload_param = array (
                "name" => "file",
                "album_id" => $album_id,
                "pic_id" => $pic_id,
                "thumb_type" => [ "BIG", "MID", "SMALL" ],
                "filename" => $filename,
                "suffix" => $suffix
            );


            $result = $upload_model->setPath("common/images/" . date("Ymd") . '/')->modifyFile($upload_param);

            return json($result);

        }catch (Exception $e){
            return json($base_model->error($e, 'FAIL'));
        }

    }

}