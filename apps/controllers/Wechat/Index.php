<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

class Index extends Base
{
    /**
     * 构造函数，必须申明
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
    }

    /**
     * 入口文件
     */
    public function index()
    {
        $this->log->error('test');
        try{
            $server = $this->wechatApp->server;
            //设置Request类，改为调用内部的Request，添加了swoole的消息体接收支持
            $server->setRequest(new \App\Component\Request());
            $this->log->error('消息内容：' . var_export($server->getMessage(), true));
            $server->setMessageHandler(function ($message){
                $this->log->info('提示：' . var_export($message, true));
                return "您好！欢迎关注我！";
            });
            $response = $server->serve();
            //将响应输出
            $response->send();
        }catch (\Exception $e){
            echo 'success';
            $this->log->error($e->getMessage());
        }
    }
}
