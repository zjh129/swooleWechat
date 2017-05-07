<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

/**
 * 事件消息处理
 * @package App\Controller\Wechat
 */
class Event extends Base
{
    /**
     * 主入口方法
     * @param $message
     */
    public function index($message)
    {
        return '接受到事件消息';
    }
}