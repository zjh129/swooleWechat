<?php
namespace App\WechatHandler;

/**
 * 链接消息处理
 * @package App\WechatHandler
 */
class Location extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到坐标消息';
    }
}