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
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
    }
}