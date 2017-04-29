<?php
namespace App\Handler;

use Swoole;

class Hello2 implements Swoole\IFace\EventHandler
{
    function trigger($type, $data)
    {
        echo "事件二: ";
        var_dump($type);
        var_dump($data);
    }
}