<?php
namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 群发消息推送处理.
 */
class EventMass extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        $event = strtolower($this->recMessage->Event);
        switch ($event){
            case 'masssendjobfinish'://群发结果推送
                $massSer = new \App\Service\WxMass();
                return $massSer->saveJobFinish($this->recMessage->MsgId,[
                    'status' => $this->recMessage->Status,
                    'total_num' => $this->recMessage->TotalCount,
                    'filter_num' => $this->recMessage->FilterCount,
                    'success_num' => $this->recMessage->SentCount,
                    'error_num' => $this->recMessage->ErrorCount,
                ]);
                break;
        }
        return false;
    }
}