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
        if (!$message){
            return false;
        }
        var_dump($message);
        $saveData = [
            'ToUserName' => $message['ToUserName'],
            'FromUserName' => $message['FromUserName'],
            'MsgType' => $message['MsgType'],
            'CreateTime' => $message['CreateTime'],
        ];
        unset($message['ToUserName'], $message['FromUserName'], $message['MsgType'], $message['CreateTime']);
        $saveData['ContentDetail'] = \GuzzleHttp\json_encode($message);

    }
}