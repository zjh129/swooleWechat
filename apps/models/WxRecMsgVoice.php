<?php
namespace App\Model;
use Swoole;

/**
 * 语音接收消息记录模型
 * @package App\Model
 */
class WxRecMsgVoice extends Swoole\Model
{
    public $primary = 'id';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_rec_msg_voice';
}