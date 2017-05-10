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
        if (empty(Swoole::$php->config['wechat'][\Swoole::$php->factory_key]))
        {
            throw new Swoole\Exception\Factory("wechat->".\Swoole::$php->factory_key." is not found.");
        }
        $wechatConfig = Swoole::$php->config['wechat'][\Swoole::$php->factory_key];
        $this->wechatApp = new \EasyWeChat\Foundation\Application($wechatConfig);

        //如果有保存数据方法申明，则保存接收到的消息记录
        if (is_callable([$this, 'saveRecMessage'])){
            $this->saveRecMessage();
        }else{
            $this->log->error('saveRecMessage方法不能调用');
        }
    }
}