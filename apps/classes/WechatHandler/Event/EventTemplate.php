<?php

namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;
use Swoole;

/**
 * 模板消息处理.
 */
class EventTemplate extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        Swoole::$php->event->trigger('WxMsgSaveTemplate', ['message'=>$this->recMessage]);

        return '模板消息事件推送';
    }
}
