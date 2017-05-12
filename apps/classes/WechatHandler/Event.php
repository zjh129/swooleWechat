<?php
namespace App\WechatHandler;

/**
 * 事件消息处理
 * @package App\WechatHandler
 */
class Event extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到事件消息';
    }
}