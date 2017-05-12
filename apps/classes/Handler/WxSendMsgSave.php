<?php
namespace App\Handler;

use Swoole;
use App\WechatHandler\WxMsg;
use EasyWeChat\Support\XML;

class WxSendMsgSave extends WxMsg implements Swoole\IFace\EventHandler
{
    function trigger($type, $data)
    {
        if(!isset($data['message']) || !$data['message']){
            return false;
        }
        $message = XML::parse($data['message']);
        var_dump($message);
    }
}