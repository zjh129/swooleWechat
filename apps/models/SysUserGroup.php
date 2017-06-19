<?php
namespace App\Model;
/**
 * 系统用户分组表模型
 * @package App\Model
 */
class SysUserGroup extends \App\Component\BaseModel
{
    public $primary = 'groupId';
    /**
     * 表名
     * @var string
     */
    public $table = 'sys_user_group';
}