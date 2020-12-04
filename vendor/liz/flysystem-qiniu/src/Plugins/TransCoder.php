<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/27
 * Time: 上午11:31.
 */

namespace Liz\Flysystem\QiNiu\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;
use Liz\Flysystem\QiNiu\Plugins\TransCoderHelpers\AbstractTransCoderPolicy;
use Liz\Flysystem\QiNiu\QiNiuOssAdapter;
use function Qiniu\base64_urlSafeEncode;

/**
 * Class TransCoder.
 *
 * @method array transCoding(需要进行转码的文件全路径 $path, 转码规则 $rules, 另存文件全路径 $saveAs=null, 通知地址 $notifyUrl=null, 队列名称 $pipeline=null, 保存bucket $bucket=null)
 */
class TransCoder extends AbstractPlugin
{
    protected $notifyUrl;

    protected $pipeLine;

    protected $toBucket;

    protected $wmImage;
    /**
     * @var null
     */
    private $rules;

    /**
     * TransCoder constructor.
     *
     * @param null $notifyUrl 处理完毕默认通知地址
     * @param null $pipeLine  默认队列名称 https://portal.qiniu.com/dora/mps/new
     * @param null $toBucket  处理完成默认保存到的bucket
     * @param null $wmImage   水印图片地址
     */
    public function __construct($notifyUrl = null, $pipeLine = null, $toBucket = null, $wmImage = null, $rules = null)
    {
        $this->notifyUrl = $notifyUrl;
        $this->pipeLine = $pipeLine;
        $this->toBucket = $toBucket;
        $this->wmImage = $wmImage;
        $this->rules = $rules;
    }

    public function setPolicy(AbstractTransCoderPolicy $transCoderPolicy){
        $this->notifyUrl = $transCoderPolicy->getNotifyUrl();
        $this->pipeLine = $transCoderPolicy->getPipeLine();
        $this->toBucket = $transCoderPolicy->getToBucket();
        $this->wmImage = $transCoderPolicy->getWmImage();
        $this->rules = $transCoderPolicy->getRules();
    }

    public function getMethod()
    {
        return 'transCoding';
    }

    /**
     * @return QiNiuOssAdapter
     */
    protected function getFlySystemAdapter()
    {
        return $this->filesystem->getAdapter();
    }

    /**
     * @param $path
     * @param $rules
     * @param null $saveAs
     * @param null $notifyUrl
     * @param null $pipeline
     * @param null $toBucket
     *
     * @return array
     *
     * @throws \Liz\Flysystem\QiNiu\QiNiuOssAdapterException
     */
    public function handle($path, $rules, $saveAs = null, $notifyUrl = null, $pipeline = null, $toBucket = null)
    {
        $notifyUrl = $notifyUrl ?: $this->notifyUrl;
        $pipeline = $pipeline ?: $this->pipeLine;
        $toBucket = $toBucket ?: $this->toBucket;
        $rules = $rules ?: $this->rules;
        if ($this->wmImage && !strstr($rules, 'wmImage')) {
            $rules .= '/wmImage/'.base64_urlSafeEncode($this->wmImage);
        }
        return $this->getFlySystemAdapter()->transCoding($path, $rules, $saveAs, $notifyUrl, $pipeline, $toBucket);
    }
}
