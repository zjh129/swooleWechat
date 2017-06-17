<?php

namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 扫描带参数二维码事件消息处理.
 */
class EventScan extends Base implements InterfaceHandler
{
    /**
     * 创建二维码时的二维码
     *
     * @var
     */
    private $sceneId;

    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * 主入口方法.
     */
    public function main()
    {
        //关注事件时触发微信关注取关注消息组件
        if (strtolower($this->recMessage->Event) == 'subscribe') {
            \Swoole::$php->event->trigger('WxUserSubscribe', ['message' => $this->recMessage]);
            $this->sceneId = (int) str_replace('qrscene_', '', $this->recMessage->EventKey);
        } else {
            $this->sceneId = (int) $this->recMessage->EventKey;
        }
        //触发扫码事件
        \Swoole::$php->event->trigger('WxScan', ['message' => $this->recMessage]);
        //扫码事件处理
        $openId = $this->recMessage->FromUserName;
        //1-100w之间
        if ($this->sceneId > 0 && $this->sceneId <= 1000000) {
            //获取二维码数据
            $wxQrCodeService = new \App\Service\WxQrCode($this->sceneId);
            $qrCodeData      = $wxQrCodeService->getQrCodeData();
            switch ($qrCodeData['qrc_type']) {
                case 1://活动二维码
                    $sfyQrCodeObj = new \App\Service\SfyQrCodeActive($this->sceneId);
                    break;
                case 2://门店二维码
                    $sfyQrCodeObj = new \App\Service\SfyQrCodeStore($this->sceneId);
                    break;
                case 3://一人一码
                    $sfyQrCodeObj = new \App\Service\SfyQrCodeEmp($this->sceneId);
                    break;
                case 4://全民营销
                    $sfyQrCodeObj = new \App\Service\SfyQrCodeMarket($this->sceneId);
                    break;
            }
        } elseif ($this->sceneId > 1000000) {//100w以上
            $sfyQrCodeObj = new \App\Service\SfyQrCodeMarketLimit($this->sceneId);
        }
        if (!method_exists($sfyQrCodeObj, 'getMaterialData')) {
            $materialData = $sfyQrCodeObj->getMaterialData($openId);
            //返回消息
            return $this->formatMessage($materialData);
        }

        return '';
    }
}
