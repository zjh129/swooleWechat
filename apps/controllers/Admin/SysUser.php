<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统用户相关操作
 * @package App\Controller\Admin
 */
class SysUser extends Base
{
    /**
     * @var \App\Model\SysUser
     */
    private $sysUserModel;

    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('系统管理', '/Admin/System/index');
        $this->sysUserModel = model('SysUser');
    }

    /**
     * 用户列表
     */
    public function index()
    {
        $this->setSeoTitle('用户管理');
        $this->addBreadcrumb('用户管理', $this->currentUrl);

        $this->display();
    }
}