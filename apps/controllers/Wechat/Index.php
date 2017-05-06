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
                $controllerClass = '\\App\\Controller\\Wechat\\' . $msgType;
                if (!class_exists($controllerClass, false)) {
                    throw new Exception('消息类型【' . $message->MsgType . '】处理类不存在');
                }
                $controller = new $controllerClass($this);
                $method = 'Index'; //主入口方法
                if (!method_exists($controller, $method)) {
                    throw new Exception('处理类【' . $controllerClass . '】的[' . $method . ']主入口方法不存在');
                }
                return $controller->$method($message);

                switch ($message->MsgType) {
                    case 'event':
                        return '收到事件消息';
                        break;
                    case 'text':
                        return '收到文字消息';
                        break;
                    case 'image':
                        return '收到图片消息';
                        break;
                    case 'voice':
                        return '收到语音消息';
                        break;
                    case 'video':
                        return '收到视频消息';
                        break;
                    case 'location':
                        return '收到坐标消息';
                        break;
                    case 'link':
                        return '收到链接消息';
                        break;
                    // ... 其它消息
                    default:
                        return '收到其它消息';
                        break;
                }
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
