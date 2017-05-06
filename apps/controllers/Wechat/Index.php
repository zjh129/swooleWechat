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
            $this->log->error('提示');
            $this->wechatApp->server->setMessageHandler(function ($message){
                $this->log->info('提示：' . var_export($message));
                return "您好！欢迎关注我！";
            });
            $response = $this->wechatApp->server->serve();
            //将响应输出
            $response->send();
        }catch (\Exception $e){
            echo 'success';
            $this->log->error($e->getMessage());
        }
    }
}
