<?php
namespace App\Handler;

use Swoole;

class Hello1 implements Swoole\IFace\EventHandler
{
    function trigger($type, $data)
    {
        echo "事件1: ";
        var_dump($type);
        var_dump($data);
    }
}