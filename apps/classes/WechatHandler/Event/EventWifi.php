<?php

namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * WIFI消息推送处理.
 */
class EventWifi extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        //触发微信关注取关注消息事件
        \Swoole::$php->event->trigger('WxWifi', ['message' => $this->recMessage]);
        $event = strtolower($this->recMessage->Event);
        switch ($event) {
            case 'wificonnected':
                //同步微信用户数据
                $userSer = new \App\Service\WxUser();
                $userSer->syncUserInfo($this->recMessage->FromUserName);
                //WIFI数据处理
                $wifiSer = new \App\Service\WxWifi();

                return $wifiSer->saveConnected($this->recMessage->FromUserName, $this->recMessage->ShopId, [
                    'ConnectTime' => $this->recMessage->ConnectTime,
                    'ExpireTime'  => $this->recMessage->ExpireTime,
                    'VendorId'    => $this->recMessage->VendorId,
                    'DeviceNo'    => $this->recMessage->DeviceNo,
                ]);
                break;
        }
    }
}
