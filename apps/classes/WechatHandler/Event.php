<?php

namespace App\WechatHandler;

/**
 * 事件消息处理.
 */
class Event extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        $sendMessage = '接受到事件消息';
        if ($this->recMessageType) {
            switch ($this->recMessageType) {
                case self::RECMSG_EVENT_SUBSCRIBE://关注事件推送
                    //异步触发用户关注取关注事件
                    \Swoole::$php->event->trigger('WxUserSubscribe', [
                        'openid' => $this->recMessage->FromUserName,
                        'subscribe' => $this->recMessage->Event == 'subscribe' ? 1 : 0,
                    ]);
                    //转接到子模块处理
                    $sendMessage = (new \App\WechatHandler\Event\EventSubscribe($this->recMessage))->main();
                    break;
                case self::RECMSG_EVENT_SCAN://扫码事件
                    if ($this->recMessage->Event == 'subscribe'){
                        //异步触发用户关注取关注事件
                        \Swoole::$php->event->trigger('WxUserSubscribe', [
                            'openid' => $this->recMessage->FromUserName,
                            'subscribe' => $this->recMessage->Event == 'subscribe' ? 1 : 0,
                        ]);
                    }
                    //转接到子模块处理
                    $sendMessage = (new \App\WechatHandler\Event\EventScan($this->recMessage))->main();
                    break;
                case self::RECMSG_EVENT_LOCATION://上报地理位置事件
                    //转接到子模块处理
                    $sendMessage = (new \App\WechatHandler\Event\EventLocation($this->recMessage))->main();
                    break;
                case self::RECMSG_EVENT_MENU://自定义菜单事件
                    //转接到子模块处理
                    $sendMessage = (new \App\WechatHandler\Event\EventMenu($this->recMessage))->main();
                    break;
            }
        }

        return $sendMessage;
    }
}
