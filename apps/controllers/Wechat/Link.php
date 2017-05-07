<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

/**
 * ；链接消息处理
 * @package App\Controller\Wechat
 */
class Link extends Base
{
    /**
     * 主入口方法
     * @param $message
     */
    public function index($message)
    {
        return '接受到链接消息';
    }
}