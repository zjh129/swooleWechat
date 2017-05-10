<?php
namespace App\WechatHandler;

/**
 * 链接消息处理
 * @package App\WechatHandler
 */
class Link extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到链接消息';
    }

    /**
     * 保存消息记录
     */
    public function saveRecMessage()
    {
        $model = Model('WxRecMsgLink');
        $data = [
            'MsgId' => $this->recMessage->MsgId ?? '',
            'MsgType' => $this->recMessage->MsgType ?? '',
            'ToUserName' => $this->recMessage->ToUserName ?? '',
            'FromUserName' => $this->recMessage->FromUserName ?? '',
            'CreateTime' => $this->recMessage->CreateTime ?? 0,
            'Title' => $this->recMessage->Title ?? '',
            'Description' => $this->recMessage->Description ?? '',
            'Url' => $this->recMessage->Description ?? '',
        ];
        return $model->put($data);
    }
}