<?php
namespace App\Model;
/**
 * 系统用户表模型
 * @package App\Model
 */
class SysUser extends \App\Component\BaseModel
{
    public $primary = 'userId';
    /**
     * 表名
     * @var string
     */
    public $table = 'sys_user';
}