<?php
namespace App\Model;

/**
 * 关注与取关注事件消息记录模型
 * @package App\Model
 */
class WxRecEventSubscribe extends \App\Component\BaseModel
{
    public $primary = 'id';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_rec_event_subscribe';
}