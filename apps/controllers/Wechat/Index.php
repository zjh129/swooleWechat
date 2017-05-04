<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

class Index extends Base
{
    public function index()
    {
        $this->wechatapp->server->setMessageHandler(function ($message){
            return "您好！欢迎关注我！";
        });
        $response = $this->wechatapp->server->serve();
        //将响应输出
        $response->send();
    }
}