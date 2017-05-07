<?php
namespace App\WechatHandler;

/**
 * 图片消息处理
 * @package App\WechatHandler
 */
class Image extends Base implements InterfaceHandler
{
    /**
     * 主入口方法
     */
    public function main()
    {
        return '接受到图片消息';
    }
}