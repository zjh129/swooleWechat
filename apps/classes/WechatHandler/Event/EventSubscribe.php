<?php

namespace App\WechatHandler\Event;

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
        //触发微信关注取关注消息事件
        \Swoole::$php->event->trigger('WxUserSubscribe', ['message' => $this->recMessage]);
        //获取微信欢迎关键词配置
        $configData = (new \App\Service\WxConfig())->getConfigData('wx_welcome');

        return $this->formatMessage($configData);
    }
}
