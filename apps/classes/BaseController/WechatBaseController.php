<?php
namespace App\BaseController;

/**
 * 微信接口基类控制器
 * @package App\Controller\Api
 */
class WechatBaseController extends BaseController
{
    protected $wechatApp;

    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        //某些涉及到http请求的，无法设置成全局对象，所以只能在使用到的地方重新初始化，官方文档也有说明
        //初始化强大的微信SDK开发工具微信EasyWeChat
        if (empty($this->config['wechat'][\Swoole::$php->factory_key]))
        {
            throw new Swoole\Exception\Factory("wechat->".\Swoole::$php->factory_key." is not found.");
        }
        $wechatConfig = $this->config['wechat'][\Swoole::$php->factory_key];
        $this->wechatApp = new \EasyWeChat\Foundation\Application($wechatConfig);
        //设置Request类，改为调用优化好的的Request，因为swoole不支持原生的file_get_content('php://input');
        $this->wechatApp->server->setRequest(new \App\Component\Request());
    }
}