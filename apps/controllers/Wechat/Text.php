<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

/**
 * 文字消息处理
 * @package App\Controller\Wechat
 */
class Text extends Base
{
    /**
     * 主入口方法
     * @param $message
     */
    public function index($message)
    {
        return '接受到文字消息';
    }
}