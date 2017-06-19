<?php
namespace App\Model;
/**
 * 系统菜单模型
 * @package App\Model
 */
class SysMenu extends \App\Component\BaseModel
{
    public $primary = 'menuId';
    /**
     * 表名
     * @var string
     */
    public $table = 'sys_menu';
}