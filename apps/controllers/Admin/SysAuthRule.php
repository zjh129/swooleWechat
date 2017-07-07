<?php

namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统用户相关操作.
 */
class SysAuthRule extends Base
{
    /**
     * @var \App\Model\SysAuthRule
     */
    private $sysAuthRuleModel;

    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('系统管理', '/Admin/System/index');
        $this->sysAuthRuleModel = model('SysAuthRule');
    }
    /**
     * 权限列表
     */
    public function index()
    {
        $this->setSeoTitle('权限管理');
        $this->addBreadcrumb('权限管理', $this->currentUrl);

        $this->display();
    }

    /**
     * 返回jsTree格式数据格式
     * @return array
     */
    public function getJsTreeData()
    {
        //权限规则列表
        $ruleList     = $this->sysAuthRuleModel->getAuthRuleList();
        //树结构用户组列表
        $tree          = new \App\Common\Tree('ruleId', 'parentId', 'children');
        $tree->nameKey = 'ruleName';
        $tree->load($ruleList);
        return $tree->makeJsTreeFormat();
    }
}
