<?php
namespace App\WechatHandler;

use Swoole;

/**
 * 消息处理基础类
 * @package App\Controller\Wechat
 */
class Base
{
    //接收到服务器的消息
    protected $recMessage;
    //微信easyWechat的application对象实例
    protected $wechatApp;
    public function __construct($message)
    {
        //对象属性赋值
        $this->recMessage = $message;
        //初始化强大的微信SDK开发工具微信EasyWeChat
        if (empty($this->config['wechat'][\Swoole::$php->factory_key]))
        {
            throw new Swoole\Exception\Factory("wechat->".\Swoole::$php->factory_key." is not found.");
        }
        $wechatConfig = $this->config['wechat'][\Swoole::$php->factory_key];
        $this->wechatApp = new \EasyWeChat\Foundation\Application($wechatConfig);
    }
}