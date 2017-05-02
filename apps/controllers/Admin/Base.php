<?php
namespace App\Controller\Admin;

use Swoole;

/**
 * 基类控制器
 * @package App\Controller\Admin
 */
class Base extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }
}