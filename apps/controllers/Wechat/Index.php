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
        try{
            $server = $this->wechatApp->server;
            $server->setMessageHandler(function ($message){
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
        }catch (\Exception $e){
            echo 'success';
            $this->log->error($e->getMessage());
        }
    }
}
