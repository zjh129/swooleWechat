<?php
namespace App\WechatHandler\Event;

use Swoole;

/**
 * 扫描带参数二维码事件消息处理.
 */
class EventScan extends \App\WechatHandler\Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        return '扫描带参数二维码事件';
    }
}