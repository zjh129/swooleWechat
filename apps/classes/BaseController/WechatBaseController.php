<?php
namespace App\BaseController;

/**
 * 微信接口基类控制器
 * @package App\Controller\Api
 */
class WechatBaseController extends BaseController
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }
}