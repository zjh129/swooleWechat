<?php

namespace App\Handler;

use App\WechatHandler\WxMsg;
use Swoole;

class WxRecMsgSave extends WxMsg implements Swoole\IFace\EventHandler
{
    public function trigger($type, $data)
    {
        if(!isset($data['message']) || !$data['message']){
            return false;
        }

        $this->setRecMessageType($data['message']);

        $saveData = [
            'MsgType'      => $this->recMessage->MsgType ?? '',
            'ToUserName'   => $this->recMessage->ToUserName ?? '',
            'FromUserName' => $this->recMessage->FromUserName ?? '',
            'CreateTime'   => $this->recMessage->CreateTime ?? 0,
        ];
        //文本消息
        if ($this->recMessageType == self::RECMSG_TYPE_TEXT) {
            $saveData['MsgId']   = $this->recMessage->MsgId ?? '';
            $saveData['Content'] = $this->recMessage->Content ?? '';
            $model           = Model('WxRecMsgText');
        }
        //图片消息
        if ($this->recMessageType == self::RECMSG_TYPE_IMAGE) {
            $saveData['MsgId']   = $this->recMessage->MsgId ?? '';
            $saveData['MediaId'] = $this->recMessage->MediaId ?? '';
            $saveData['PicUrl']  = $this->recMessage->PicUrl ?? '';
            $model           = Model('WxRecMsgImage');
        }
        //语音消息
        if ($this->recMessageType == self::RECMSG_TYPE_VOICE) {
            $saveData['MsgId']       = $this->recMessage->MsgId ?? '';
            $saveData['MediaId']     = $this->recMessage->MediaId ?? '';
            $saveData['Format']      = $this->recMessage->Format ?? '';
            $saveData['Recognition'] = $this->recMessage->Recognition ?? '';
            $model               = Model('WxRecMsgVoice');
        }
        //视频消息
        if ($this->recMessageType == self::RECMSG_TYPE_VIDEO) {
            $saveData['MsgId']        = $this->recMessage->MsgId ?? '';
            $saveData['MediaId']      = $this->recMessage->MediaId ?? '';
            $saveData['ThumbMediaId'] = $this->recMessage->ThumbMediaId ?? '';
            $model                = Model('WxRecMsgVideo');
        }
        //小视频消息
        if ($this->recMessageType == self::RECMSG_TYPE_SHORTVIDEO) {
            $saveData['MsgId']        = $this->recMessage->MsgId ?? '';
            $saveData['MediaId']      = $this->recMessage->MediaId ?? '';
            $saveData['ThumbMediaId'] = $this->recMessage->ThumbMediaId ?? '';
            $model                = Model('WxRecMsgShortvideo');
        }
        //地理位置消息
        if ($this->recMessageType == self::RECMSG_TYPE_LOCATION) {
            $saveData['MsgId']       = $this->recMessage->MsgId ?? '';
            $saveData['Location_X']  = $this->recMessage->Location_X ?? 0;
            $saveData['Location_Y']  = $this->recMessage->Location_Y ?? 0;
            $saveData['Scale']       = $this->recMessage->Scale ?? 0;
            $saveData['Label']       = $this->recMessage->Label ?? '';
            $model               = Model('WxRecMsgLocation');
        }
        //链接消息
        if ($this->recMessageType == self::RECMSG_TYPE_LINK) {
            $saveData['MsgId']       = $this->recMessage->MsgId ?? '';
            $saveData['Title']       = $this->recMessage->Title ?? '';
            $saveData['Description'] = $this->recMessage->Description ?? '';
            $saveData['Url']         = $this->recMessage->Description ?? '';
            $model               = Model('WxRecMsgLink');
        }
        //关注事件推送
        if ($this->recMessageType == self::RECMSG_EVENT_SUBSCRIBE) {
            $saveData['Event'] = $this->recMessage->Event ?? '';
            $model         = Model('WxRecEventSubscribe');
        }
        //扫码事件
        if ($this->recMessageType == self::RECMSG_EVENT_SCAN) {
            $saveData['Event']    = $this->recMessage->Event ?? '';
            $saveData['EventKey'] = $this->recMessage->EventKey ?? '';
            $saveData['Ticket']   = $this->recMessage->Ticket ?? '';
            $model            = Model('WxRecEventSubscribe');
        }
        //上报地理位置事件
        if ($this->recMessageType == self::RECMSG_EVENT_LOCATION) {
            $saveData['Event']     = $this->recMessage->Event ?? '';
            $saveData['Latitude']  = $this->recMessage->Latitude ?? 0;
            $saveData['Longitude'] = $this->recMessage->Longitude ?? 0;
            $saveData['Precision'] = $this->recMessage->Precision ?? '';
            $model             = Model('WxRecEventLocation');
        }
        //自定义菜单事件
        if ($this->recMessageType == self::RECMSG_EVENT_MENU) {
            $saveData['Event']    = $this->recMessage->Event ?? '';
            $saveData['EventKey'] = $this->recMessage->EventKey ?? '';
            $model            = Model('WxRecEventMenu');
        }
        if (isset($model) && is_callable([$model, 'put'])) {
            return $model->put($saveData);
        }
    }
}
