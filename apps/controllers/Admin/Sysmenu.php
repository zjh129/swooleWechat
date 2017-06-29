<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统菜单管理
 * @package App\Controller\Admin
 */
class Sysmenu extends Base
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('系统管理','/admin/System//index');
    }

    /**
     * 菜单管理界面
     */
    public function index()
    {
        $this->setSeoTitle('菜单管理');
        $this->addBreadcrumb('菜单管理','/admin/sysmenu/index');

        $this->display();
    }
}