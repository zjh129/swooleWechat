<?php

namespace App\BaseController;

use Swoole;

/**
 * 接口基类控制器.
 *
 * @property \EasyWeChat\Foundation\Application         $wechatApp
 */
class BaseController extends Swoole\Controller
{
    /**
     * 构造函数.
     *
     * @param Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
    }
}
