<?php
namespace App\WechatHandler;

/**
 * 链接消息处理
 * @package App\WechatHandler
 */
class Location extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到坐标消息';
    }

    /**
     * 保存消息记录
     */
    public function saveRecMessage()
    {
        $model = Model('WxRecMsgLocation');
        $data = [
            'MsgId' => $this->recMessage->MsgId ?? '',
            'MsgType' => $this->recMessage->MsgType ?? '',
            'ToUserName' => $this->recMessage->ToUserName ?? '',
            'FromUserName' => $this->recMessage->FromUserName ?? '',
            'CreateTime' => $this->recMessage->CreateTime ?? 0,
            'Location_X' => $this->recMessage->Location_X ?? 0,
            'Location_Y' => $this->recMessage->Location_Y ?? 0,
            'Scale' => $this->recMessage->Scale ?? 0,
            'Label' => $this->recMessage->Label ?? '',
        ];
        return $model->put($data);
    }
}