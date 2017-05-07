<?php

namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;
use EasyWeChat\Core\Exception;

class Index extends Base
{
    /**
     * 构造函数，必须申明.
     *
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
    }

    /**
     * 入口文件.
     */
    public function index()
    {
        try {
            $server = $this->wechatApp->server;
            $server->setMessageHandler(function ($message) {
                $msgType = strtolower($message->MsgType);
                $msgType = ucfirst($msgType);
                $method = 'Index'; //主入口方法
                $this->swoole->router(function($msgType, $method, $message){
                    return ['directory' => 'Wechat', 'controller' => $msgType, 'view' => $method,'param' => $message];
                });
                return $this->swoole->runMVC();
            });
            $response = $server->serve();
            //将响应输出
            $response->send();
        } catch (\Exception $e) {
            echo 'success';
            $this->log->error($e->getMessage());
        }
    }
}
