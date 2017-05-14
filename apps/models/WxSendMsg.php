<?php
namespace App\Model;

/**
 * 发送消息模型
 * @package App\Model
 */
class WxSendMsg extends \App\Component\BaseModel
{
    public $primary = 'id';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_send_msg';
}