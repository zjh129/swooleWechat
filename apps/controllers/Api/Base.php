<?php
namespace App\Controller\Api;

use Swoole;

/**
 * 基类控制器
 * @package App\Controller\Api
 */
class Base extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }
}