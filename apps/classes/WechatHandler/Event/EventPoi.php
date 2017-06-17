<?php
namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 门店事件推送处理.
 */
class EventPoi extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        $event = strtolower($this->recMessage->Event);
        switch ($event){
            case 'poi_check_notify'://门店审核事件推送
                //更改门店详情表的状态
                $status = $this->recMessage->Result == 'succ' ? 3 : 4;
                $storeDetailModel = model('SfyStoreDetail');
                $storeDetailModel->sets([
                    'poi_id' => $this->recMessage->PoiId,
                    'wx_status' => $status,
                    'wx_status_msg' => $this->recMessage->msg,
                    'update_at' => time(),
                ],['sid'=>$this->recMessage->UniqId]);
                break;
        }
        return false;
    }
}