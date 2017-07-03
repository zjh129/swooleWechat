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
        $this->addBreadcrumb('系统管理','/admin/System/index');
    }

    /**
     * 菜单管理界面
     */
    public function index()
    {
        $this->setSeoTitle('菜单管理');
        $this->addBreadcrumb('菜单管理',$this->currentUrl);
        //菜单模块类别
        $sysMenu = new \App\Service\SysMenu();
        $this->assign('moduleTypeList', $sysMenu->getModuleTypeList());
        $moduleType = isset($_GET['moduleType']) && $_GET['moduleType'] ? $_GET['moduleType'] : $sysMenu::MENU_TYPE_ADMIN;
        $this->assign('moduleType', $moduleType);
        //菜单选择列表
        $menuTreeOptionHtml = (new \App\Service\SysMenu())->getTreeOptions($moduleType);
        $this->assign('menuTreeOption', $menuTreeOptionHtml);
        $this->display();
    }
    public function add()
    {

    }
}