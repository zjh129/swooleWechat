<?php
namespace App\WechatHandler;

/**
 * 链接消息处理
 * @package App\WechatHandler
 */
class Text extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到文字消息';
    }

    /**
     * 保存消息记录
     */
    public function saveRecMessage()
    {
        $model = Model('WxRecMsgText');
        $data = [
            'MsgId' => $this->recMessage->MsgId,
            'MsgType' => $this->recMessage->MsgType,
            /*'ToUserName' => $this->recMessage->ToUserName,
            'FromUserName' => $this->recMessage->FromUserName,
            'CreateTime' => $this->recMessage->CreateTime,
            'Content' => $this->recMessage->Content,*/
        ];
        return $model->put($data);
    }
}