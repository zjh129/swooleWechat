<?php

namespace App\WechatHandler;

class WxMsg
{
    const RECMSG_TYPE_TEXT        = 100; //文本消息
    const RECMSG_TYPE_IMAGE       = 101; //图片消息
    const RECMSG_TYPE_VOICE       = 102; //语音消息
    const RECMSG_TYPE_VIDEO       = 103; //视频消息
    const RECMSG_TYPE_SHORTVIDEO  = 104; //小视频消息
    const RECMSG_TYPE_LOCATION    = 105; //地理位置消息
    const RECMSG_TYPE_LINK        = 106; //链接消息
    const RECMSG_EVENT_SUBSCRIBE  = 200; //关注、取关注类事件
    const RECMSG_EVENT_SCAN       = 201; //扫描带参数二维码事件
    const RECMSG_EVENT_LOCATION   = 202; //上报地理位置事件
    const RECMSG_EVENT_MENU       = 203; //自定义菜单事件

    //接收消息
    protected $recMessage;
    //发送消息
    protected $sendMessage;
    /**
     * 接收消息类别.
     *
     * @var int
     */
    protected $recMessageType = 0;
    /**
     * 发送消息类别.
     *
     * @var int
     */
    protected $sendMessageType = 0;

    /**
     * 设置接受消息类别.
     *
     * @param $message
     */
    public function setRecMessageType($message)
    {
        //判断消息是否是对象
        if (!is_object($message)){
            return false;
        }
        $this->recMessage = $message;
        //文本消息推送
        if ($this->recMessage->MsgType == 'text'){
            $this->recMessageType = self::RECMSG_TYPE_TEXT;
            return true;
        }
        //图片消息推送
        if ($this->recMessage->MsgType == 'image'){
            $this->recMessageType = self::RECMSG_TYPE_IMAGE;
            return true;
        }
        //语音消息推送
        if ($this->recMessage->MsgType == 'voice'){
            $this->recMessageType = self::RECMSG_TYPE_VOICE;
            return true;
        }
        //视频消息推送
        if ($this->recMessage->MsgType == 'video'){
            $this->recMessageType = self::RECMSG_TYPE_VIDEO;
            return true;
        }
        //小视频消息推送
        if ($this->recMessage->MsgType == 'shortvideo'){
            $this->recMessageType = self::RECMSG_TYPE_SHORTVIDEO;
            return true;
        }
        //地理位置消息
        if ($this->recMessage->MsgType == 'location'){
            $this->recMessageType = self::RECMSG_TYPE_LOCATION;
            return true;
        }
        //链接消息
        if ($this->recMessage->MsgType == 'link'){
            $this->recMessageType = self::RECMSG_TYPE_LINK;
            return true;
        }
        //关注事件推送
        if ($this->recMessage->MsgType == 'event' && in_array($this->recMessage->Event, ['subscribe', 'unsubscribe']) && !isset($this->recMessage->EventKey)) {
            $this->recMessageType = self::EVENT_TYPE_SUBSCRIBE;
            return true;
        }
        //扫码事件
        if ($this->recMessage->MsgType == 'event' && in_array($this->recMessage->Event, ['subscribe', 'SCAN']) && isset($this->recMessage->EventKey) && strpos($this->recMessage->EventKey, 'qrscene_') !== false) {
            $this->recMessageType = self::EVENT_TYPE_SCAN;
            return true;
        }
        //上报地理位置事件
        if ($this->recMessage->MsgType == 'event' && in_array($this->recMessage->Event, ['LOCATION'])) {
            $this->recMessageType = self::EVENT_TYPE_LOCATION;
            return true;
        }
        //自定义菜单事件
        if ($this->recMessage->MsgType == 'event' && in_array($this->recMessage->Event, ['CLICK', 'VIEW'])) {
            $this->recMessageType = self::EVENT_TYPE_MENU;
            return true;
        }
    }

    /**
     * 获取接收消息类别.
     *
     * @return int
     */
    public function getRecMessageType()
    {
        return $this->recMessageType;
    }

    /**
     * 设置发送消息类别
     * @param array $message
     */
    public function setSendMessageType($message = [])
    {

    }

    /**
     * 获取发送消息类别
     * @return int
     */
    public function getSendMessageType()
    {
        return $this->sendMessageType;
    }
}
