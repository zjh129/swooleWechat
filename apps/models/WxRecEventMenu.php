<?php
namespace App\Model;

use Swoole;

/**
 * 自定义菜单事件记录模型
 * @package App\Model
 */
class WxRecEventMenu extends Swoole\Model
{
    public $primary = 'id';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_rec_event_menu';
}