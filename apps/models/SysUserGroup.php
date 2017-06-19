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

    /**
     * 获取用户的分组列表
     * @param $userId
     * @return array
     */
    public function getUserGroupList($userId)
    {
        $groupList = $this->gets([
            'select' => 'a.groupId,a.groupName,a.ruleIds',
            'from' => $this->table.' a',
            'join' => ['sys_user_to_group b', 'b.userId='.$userId.' AND a.groupId=b.groupId'],
            'where' => "a.isDel=0"
        ]);
        return $groupList;
    }
}