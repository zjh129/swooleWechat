<?php
namespace App\Controller\Api;

use Swoole;

class Index extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }

    public function index()
    {
        echo __METHOD__;
    }
}