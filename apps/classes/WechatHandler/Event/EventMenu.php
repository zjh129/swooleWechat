<?php
namespace App\WechatHandler\Event;

use Swoole;

/**
 * 自定义菜单事件消息处理.
 */
class EventMenu extends \App\WechatHandler\Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        return '自定义菜单事件消息';
    }
}