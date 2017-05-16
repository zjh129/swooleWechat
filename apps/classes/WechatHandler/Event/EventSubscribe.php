<?php
namespace App\WechatHandler\Event;

use Swoole;
use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 关注、取关注事件消息处理.
 */
class EventSubscribe extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        return '关注、取关注事件消息';
    }
}