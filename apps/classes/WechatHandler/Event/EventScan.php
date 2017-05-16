<?php
namespace App\WechatHandler\Event;

use Swoole;
use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 扫描带参数二维码事件消息处理.
 */
class EventScan extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        return '扫描带参数二维码事件';
    }
}