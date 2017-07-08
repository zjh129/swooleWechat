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

    /**
     * 获取所有权限规则列表
     * @return array
     */
    public function getAuthRuleList()
    {
        $groupList = $this->gets([
            'select' => 'ruleId,ruleName,url,parentId,orderNum',
            'from' => $this->table,
            'where' => "isDel=0",
            'order' => "orderNum ASC,ruleId ASC",
        ]);
        return $groupList;
    }

    /**
     * 获取某一级分类下的列表
     * @param $parentId
     * @return array
     */
    public function getAuthRuleListByParentId($parentId)
    {
        $groupList = $this->gets([
            'select' => 'ruleId,ruleName,url,parentId,orderNum',
            'from' => $this->table,
            'where' => "parentId= $parentId AND isDel=0",
            'order' => "orderNum ASC,ruleId ASC",
        ]);
        return $groupList;
    }
}