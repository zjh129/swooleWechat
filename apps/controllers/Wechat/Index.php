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
                $controllerClass = '\\App\\WechatHandler\\' . $msgType;
                $method = 'Index'; //主入口方法
                if (!class_exists($controllerClass, false)) {
                    throw new Exception('消息类型【' . $message->MsgType . '】处理类不存在');
                }
                $controller = new $controllerClass($message);
                if (!method_exists($controllerClass, $method)) {
                    throw new Exception('处理类【' . $controllerClass . '】的[' . $method . ']主入口方法不存在');
                }
                return $controllerClass->$method();
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
