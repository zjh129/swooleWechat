<?php
namespace App\BaseController;

use Swoole;

/**
 * 接口基类控制器
 * @property \EasyWeChat\Foundation\Application         $wechatApp
 *
 * @package App\Controller\Api
 */
class BaseController extends Swoole\Controller
{
    protected $wechatApp;
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        //初始化
        $this->_init();
    }

    /**
     * 某些涉及到http请求的，无法设置成全局对象，所以只能在使用到的地方重新初始化
     * 官方文档也有说明
     */
    public function _init()
    {
        //初始化强大的微信SDK开发工具微信EasyWeChat
        if (empty($this->config['wechat'][\Swoole::$php->factory_key]))
        {
            throw new Swoole\Exception\Factory("wechat->".\Swoole::$php->factory_key." is not found.");
        }
        $wechatConfig = $this->config['wechat'][\Swoole::$php->factory_key];
        $this->wechatApp = new \EasyWeChat\Foundation\Application($wechatConfig);
    }
}