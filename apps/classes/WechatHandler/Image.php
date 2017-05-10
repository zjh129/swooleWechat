<?php

namespace App\WechatHandler;

/**
 * 图片消息处理
 * @package App\WechatHandler
 */
class Image extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到图片消息';
    }

    /**
     * 保存消息记录
     */
    public function saveRecMessage()
    {
        $model = Model('WxRecMsgImage');
        $data = [
            'MsgId' => $this->recMessage->MsgId ?? '',
            'MsgType' => $this->recMessage->MsgType ?? '',
            'ToUserName' => $this->recMessage->ToUserName ?? '',
            'FromUserName' => $this->recMessage->FromUserName ?? '',
            'CreateTime' => $this->recMessage->CreateTime ?? 0,
            'MediaId' => $this->recMessage->MediaId ?? '',
            'PicUrl' => $this->recMessage->PicUrl ?? '',
        ];
        return $model->put($data);
    }
}