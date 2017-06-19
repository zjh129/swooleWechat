<?php
namespace App\Model;
/**
 * 系统权限表模型
 * @package App\Model
 */
class SysAuthRule extends \App\Component\BaseModel
{
    public $primary = 'ruleId';
    /**
     * 表名
     * @var string
     */
    public $table = 'sys_auth_rule';
}