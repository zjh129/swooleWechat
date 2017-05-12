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

        $data = [
            'MsgType'      => $this->recMessage->MsgType ?? '',
            'ToUserName'   => $this->recMessage->ToUserName ?? '',
            'FromUserName' => $this->recMessage->FromUserName ?? '',
            'CreateTime'   => $this->recMessage->CreateTime ?? 0,
        ];
        //文本消息
        if ($this->recMessageType == self::RECMSG_TYPE_TEXT) {
            $data['MsgId']   = $this->recMessage->MsgId ?? '';
            $data['Content'] = $this->recMessage->Content ?? '';
            $model           = Model('WxRecMsgText');
        }
        //图片消息
        if ($this->recMessageType == self::RECMSG_TYPE_IMAGE) {
            $data['MsgId']   = $this->recMessage->MsgId ?? '';
            $data['MediaId'] = $this->recMessage->MediaId ?? '';
            $data['PicUrl']  = $this->recMessage->PicUrl ?? '';
            $model           = Model('WxRecMsgImage');
        }
        //语音消息
        if ($this->recMessageType == self::RECMSG_TYPE_VOICE) {
            $data['MsgId']       = $this->recMessage->MsgId ?? '';
            $data['MediaId']     = $this->recMessage->MediaId ?? '';
            $data['Format']      = $this->recMessage->Format ?? '';
            $data['Recognition'] = $this->recMessage->Recognition ?? '';
            $model               = Model('WxRecMsgVoice');
        }
        //视频消息
        if ($this->recMessageType == self::RECMSG_TYPE_VIDEO) {
            $data['MsgId']        = $this->recMessage->MsgId ?? '';
            $data['MediaId']      = $this->recMessage->MediaId ?? '';
            $data['ThumbMediaId'] = $this->recMessage->ThumbMediaId ?? '';
            $model                = Model('WxRecMsgVideo');
        }
        //小视频消息
        if ($this->recMessageType == self::RECMSG_TYPE_SHORTVIDEO) {
            $data['MsgId']        = $this->recMessage->MsgId ?? '';
            $data['MediaId']      = $this->recMessage->MediaId ?? '';
            $data['ThumbMediaId'] = $this->recMessage->ThumbMediaId ?? '';
            $model                = Model('WxRecMsgShortvideo');
        }
        //地理位置消息
        if ($this->recMessageType == self::RECMSG_TYPE_LOCATION) {
            $data['MsgId']       = $this->recMessage->MsgId ?? '';
            $data['Location_X']  = $this->recMessage->Location_X ?? 0;
            $data['Location_Y']  = $this->recMessage->Location_Y ?? 0;
            $data['Scale']       = $this->recMessage->Scale ?? 0;
            $data['Label']       = $this->recMessage->Label ?? '';
            $model               = Model('WxRecMsgLocation');
        }
        //链接消息
        if ($this->recMessageType == self::RECMSG_TYPE_LINK) {
            $data['MsgId']       = $this->recMessage->MsgId ?? '';
            $data['Title']       = $this->recMessage->Title ?? '';
            $data['Description'] = $this->recMessage->Description ?? '';
            $data['Url']         = $this->recMessage->Description ?? '';
            $model               = Model('WxRecMsgLink');
        }
        //关注事件推送
        if ($this->recMessageType == self::RECMSG_EVENT_SUBSCRIBE) {
            $data['Event'] = $this->recMessage->Event ?? '';
            $model         = Model('WxRecEventSubscribe');
        }
        //扫码事件
        if ($this->recMessageType == self::RECMSG_EVENT_SCAN) {
            $data['Event']    = $this->recMessage->Event ?? '';
            $data['EventKey'] = $this->recMessage->EventKey ?? '';
            $data['Ticket']   = $this->recMessage->Ticket ?? '';
            $model            = Model('WxRecEventSubscribe');
        }
        //上报地理位置事件
        if ($this->recMessageType == self::RECMSG_EVENT_LOCATION) {
            $data['Event']     = $this->recMessage->Event ?? '';
            $data['Latitude']  = $this->recMessage->Latitude ?? 0;
            $data['Longitude'] = $this->recMessage->Longitude ?? 0;
            $data['Precision'] = $this->recMessage->Precision ?? '';
            $model             = Model('WxRecEventLocation');
        }
        //自定义菜单事件
        if ($this->recMessageType == self::RECMSG_EVENT_MENU) {
            $data['Event']    = $this->recMessage->Event ?? '';
            $data['EventKey'] = $this->recMessage->EventKey ?? '';
            $model            = Model('WxRecEventMenu');
        }
        if (isset($model) && is_callable([$model, 'put'])) {
            return $model->put($data);
        }
    }
}
