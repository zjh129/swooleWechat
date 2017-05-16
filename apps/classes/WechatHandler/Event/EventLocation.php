<?php
namespace App\WechatHandler\Event;

use Swoole;

/**
 * 上报地理位置事件消息处理.
 */
class EventLocation extends \App\WechatHandler\Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        return '上报地理位置事件消息';
    }
}