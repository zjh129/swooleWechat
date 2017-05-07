<?php
namespace App\Controller\Wechat;

use App\BaseController\WechatBaseController as Base;

/**
 * 坐标消息处理
 * @package App\Controller\Wechat
 */
class Location extends Base
{
    /**
     * 主入口方法
     * @param $message
     */
    public function index($message)
    {
        return '接受到坐标消息';
    }
}