<?php

namespace App\WechatHandler;

/**
 * 链接消息处理.
 */
class Text extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        $materialData = [];
        //发送消息的用户openId
        $openId = $this->recMessage->FromUserName;
        //文本消息内容
        $content = $this->recMessage->Content;
        //判断默认关键字是否命中
        $materialData = (new \App\Service\WxKeywordStatic($content, $openId))->getMateriaData();
        if ($materialData){
            //如果命中默认关键字，则投递异步任务
            \Swoole::$php->event->trigger('WxKeyword', ['message' => $this->recMessage]);
        }
        //判断规则关键字是否命中
        $materialData || $materialData = (new \App\Service\WxKeywordRule($content, $openId))->getMateriaData();
        //判断客服关键字是否命中
        $materialData || $materialData = (new \App\Service\WxKeywordKf($content, $openId))->getMateriaData();
        //最后无关键字回复
        $materialData || $materialData = (new \App\Service\WxKeywordNo($content, $openId))->getMateriaData();

        return $this->formatMessage($materialData);
    }
}
