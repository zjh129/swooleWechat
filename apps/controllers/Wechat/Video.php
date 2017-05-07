<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

/**
 * 视频消息处理
 * @package App\Controller\Wechat
 */
class Video extends Base
{
    /**
     * 主入口方法
     * @param $message
     */
    public function index($message)
    {
        return '接受到视频消息';
    }
}