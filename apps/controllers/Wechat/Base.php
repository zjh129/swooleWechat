<?php
namespace App\Controller\Wechat;

use Swoole;

/**
 * 基类控制器
 * @package App\Controller\Wechat
 */
class Base extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }
}