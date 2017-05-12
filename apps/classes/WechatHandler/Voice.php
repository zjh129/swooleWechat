<?php
namespace App\WechatHandler;

/**
 * 事件处理消息
 * @package App\WechatHandler
 */
class Voice extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到语音消息';
    }
}