<?php
namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 客服消息推送处理.
 */
class EventKf extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        $event = strtolower($this->recMessage->Event);
        switch ($event){
            case 'kf_create_session'://接入会话
                $kfSessionSer = new \App\Service\SfyKfSession();
                return $kfSessionSer->createSession($this->recMessage->FromUserName, $this->recMessage->KfAccount, ['CreateTime'=>$this->recMessage->CreateTime]);
                break;
            case 'kf_close_session'://关闭会话
                $kfSessionSer = new \App\Service\SfyKfSession();
                return $kfSessionSer->closeSession($this->recMessage->FromUserName, $this->recMessage->KfAccount, ['CreateTime'=>$this->recMessage->CreateTime]);
                break;
            case 'kf_switch_session'://转接会话
                $kfSessionSer = new \App\Service\SfyKfSession();
                return $kfSessionSer->switchSession($this->recMessage->FromUserName, $this->recMessage->FromKfAccount, $this->recMessage->ToKfAccount, ['CreateTime'=>$this->recMessage->CreateTime]);
                break;
        }
        return false;
    }
}