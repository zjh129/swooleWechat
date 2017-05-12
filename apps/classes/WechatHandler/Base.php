<?php
namespace App\WechatHandler;

use Swoole;

/**
 * 消息处理基础类
 * @package App\Controller\Wechat
 */
class Base extends WxMsg
{
    public function __construct($message)
    {
        $this->setRecMessageType($message);
    }
}