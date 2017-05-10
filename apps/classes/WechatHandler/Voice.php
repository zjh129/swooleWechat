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

    /**
     * 保存消息记录
     */
    public function saveRecMessage()
    {
        $model = Model('WxRecMsgVoice');
        $data = [
            'MsgId' => $this->recMessage->MsgId,
            'MsgType' => $this->recMessage->MsgType,
            'ToUserName' => $this->recMessage->ToUserName,
            'FromUserName' => $this->recMessage->FromUserName,
            'CreateTime' => $this->recMessage->CreateTime,
            'MediaId' => $this->recMessage->MediaId,
            'Format' => $this->recMessage->Format,
        ];
        return $model->put($data);
    }
}