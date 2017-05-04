<?php
namespace App\BaseController;

use Swoole;

/**
 * 接口基类控制器
 * @property \EasyWeChat\Foundation\Application         $wechatapp
 *
 * @package App\Controller\Api
 */
class BaseController extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }
}