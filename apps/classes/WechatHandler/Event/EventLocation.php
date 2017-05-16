<?php
namespace App\WechatHandler\Event;

use Swoole;
use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 上报地理位置事件消息处理.
 */
class EventLocation extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        return '上报地理位置事件消息';
    }
}