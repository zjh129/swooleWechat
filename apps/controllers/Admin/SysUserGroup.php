<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统用户分组相关操作
 * @package App\Controller\Admin
 */
class SysUserGroup extends Base
{
    /**
     * @var \App\Model\SysUserGroup
     */
    private $sysUserGroupModel;
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('系统管理', '/admin/System/index');
        $this->sysUserGroupModel = model('SysUserGroup');
    }

    /**
     * 用户分组列表
     */
    public function index()
    {
        $this->setSeoTitle('用户组管理');
        $this->addBreadcrumb('用户组管理', $this->currentUrl);
        //用户组列表
        $groupList     = $this->sysUserGroupModel->getUserGroupList();
        //树结构用户组列表
        $tree          = new \App\Common\Tree('groupId', 'parentGroupId', 'child');
        $tree->nameKey = 'groupName';
        $tree->load($groupList);
        $optionHtml = $tree->buildOptions();
        //用户组选择列表
        $this->assign('treeOption', $optionHtml);
        //可嵌套列表
        $addHtml  = '<button type="button" class="btn btn-outline btn-primary btn-xs pull-right edit" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>编辑</button>';
        $addHtml .= '<button type="button" class="btn btn-outline btn-danger btn-xs pull-right del"><i class="fa fa-trash-o"></i>删除</button>';
        $nestableHtml = $tree->buildNestableTree($addHtml);
        $this->assign('nestableHtml', $nestableHtml);
        $this->display();
    }
}