<?php

namespace App\Model;

/**
 * 微信用户标签模型.
 */
class WxUserTag extends \App\Component\BaseModel
{
    public $primary = 'tagId';
    /**
     * 表名.
     *
     * @var string
     */
    public $table = 'wx_user_tag';

    /**
     * @return array
     */
    public function getUserTagList()
    {
        $groupList = $this->gets([
            'select' => 'tagId,tagName,parentId,orderNum',
            'from' => $this->table,
            'where' => "isDel=0",
            'order' => "orderNum ASC,tagId ASC",
        ]);
        return $groupList;
    }

    /**
     * 获取标签z选择设置时的权限列表
     * @return array
     */
    public function getUserTagListByChoice()
    {
        $groupList = $this->gets([
            'select' => 'wxTagId as tagId,tagName,parentId,orderNum',
            'from' => $this->table,
            'where' => "isDel=0",
            'order' => "orderNum ASC,tagId ASC",
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
            'select' => 'tagId,tagName,parentId,orderNum',
            'from' => $this->table,
            'where' => "parentId= $parentId AND isDel=0",
            'order' => "orderNum ASC,tagId ASC",
        ]);
        return $groupList;
    }
}
