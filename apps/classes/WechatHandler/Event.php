<?php
namespace App\WechatHandler;

/**
 * 事件消息处理
 * @package App\WechatHandler
 */
class Event extends Base implements InterfaceHandler
{
    protected $eventType = 0;
    CONST EVENT_TYPE_SUBSCRIBE = 1;//关注、取关注类事件
    CONST EVENT_TYPE_SCAN = 2;//关注、取关注类事件
    CONST EVENT_TYPE_LOCATION = 3;//关注、取关注类事件
    CONST EVENT_TYPE_MENU = 4;//关注、取关注类事件
    public function __construct($message)
    {
        parent::__construct($message);
        //关注事件推送
        if (in_array($this->recMessage->Event, ['subscribe', 'unsubscribe']) && !isset($this->recMessage->EventKey)){
            $this->eventType = self::EVENT_TYPE_SUBSCRIBE;
        }
        //扫码事件
        if (in_array($this->recMessage->Event, ['subscribe', 'SCAN']) && isset($this->recMessage->EventKey) && strpos($this->recMessage->EventKey, 'qrscene_') !== false){
            $this->eventType = self::EVENT_TYPE_SCAN;
        }
        //上报地理位置事件
        if (in_array($this->recMessage->Event, ['LOCATION'])){
            $this->eventType = self::EVENT_TYPE_LOCATION;
        }
        //自定义菜单事件
        if (in_array($this->recMessage->Event, ['CLICK', 'VIEW'])){
            $this->eventType = self::EVENT_TYPE_MENU;
        }
    }

    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到事件消息';
    }

    /**
     * 保存消息记录
     */
    public function saveRecMessage()
    {
        $data = [
            'MsgType' => $this->recMessage->MsgType,
            'ToUserName' => $this->recMessage->ToUserName,
            'FromUserName' => $this->recMessage->FromUserName,
            'CreateTime' => $this->recMessage->CreateTime,
            'Event' => $this->recMessage->Event,
        ];
        //关注事件推送
        if ($this->eventType == self::EVENT_TYPE_SUBSCRIBE){
            $model = Model('WxRecEventSubscribe');
        }
        //扫码事件
        if ($this->eventType == self::EVENT_TYPE_SCAN){
            $data['EventKey'] = $this->recMessage->EventKey;
            $data['Ticket'] = $this->recMessage->Ticket;
            $model = Model('WxRecEventSubscribe');
        }
        //上报地理位置事件
        if ($this->eventType == self::EVENT_TYPE_LOCATION){
            $data['Latitude'] = $this->recMessage->Latitude;
            $data['Longitude'] = $this->recMessage->Longitude;
            $data['Precision'] = $this->recMessage->Precision;
            $model = Model('WxRecEventLocation');
        }
        //自定义菜单事件
        if ($this->eventType == self::EVENT_TYPE_MENU){
            $data['EventKey'] = $this->recMessage->EventKey;
            $model = Model('WxRecEventMenu');
        }

        return $model->put($data);
    }
}