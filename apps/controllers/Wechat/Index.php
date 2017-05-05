<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;
use EasyWeChat\Core\Exception;

class Index extends Base
{
    public function index()
    {
        /*$this->wechatapp->server->setMessageHandler(function ($message){
            return "您好！欢迎关注我！";
        });
        $response = $this->wechatapp->server->serve();
        //将响应输出
        $response->send();*/
        try{
            $config = $this->config['wechat'][\Swoole::$php->factory_key];
            $wechatapp = new \EasyWeChat\Foundation\Application($config);
            $wechatapp->server->setMessageHandler(function ($message){
                return '欢迎！欢迎关注我！';
            });
            $response = $wechatapp->server->serve();
            $response->send();
        }catch (Exception $e){
            //echo $e->getMessage();
            echo 'success';
            $this->log->error($e->getMessage());
        }
    }
}