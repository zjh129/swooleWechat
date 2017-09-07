<?php
namespace App\Service;

class WxMedia
{
    /**
     * @var \App\Model\WxMedia
     */
    private $wxMediaModel;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->wxMediaModel = model('WxMedia');
    }

    /**
     * 保存图片上传
     * @param array $formData
     */
    public function save($formData = [])
    {
        return true;
    }
}