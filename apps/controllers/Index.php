<?php
namespace App\Controller;

use Swoole;

class Index extends Swoole\Controller
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        /*Swoole::$php->session->start();
        Swoole\Auth::loginRequire();*/
    }

    public function index()
    {
        echo __METHOD__;
    }

    public function test()
    {
        $data = model('User')->get(1)->get();

        return json_encode($data);
    }
}
