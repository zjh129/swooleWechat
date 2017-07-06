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
}
