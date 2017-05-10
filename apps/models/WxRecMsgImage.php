<?php
namespace App\Model;
use Swoole;

/**
 * 图片接收消息记录模型
 * @package App\Model
 */
class WxRecMsgImage extends Swoole\Model
{
    public $primary = 'id';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_rec_msg_image';
}