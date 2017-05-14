<?php
namespace App\Model;

/**
 * 自定义菜单事件记录模型
 * @package App\Model
 */
class WxRecEventMenu extends \App\Component\BaseModel
{
    public $primary = 'id';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_rec_event_menu';
}