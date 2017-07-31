<?php
namespace App\Controller\Admin;
use App\BaseController\AdminBaseController as Base;

/**
 * 微信自定义菜单相关操作.
 */
class WxMenu extends Base
{
    /**
     * 菜单模型
     * @var \App\Model\SysMenu
     */
    private $sysMenuModel;
    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('自定义菜单', '/Admin/WxMenu/index');
        $this->sysMenuModel = model('SysMenu');
    }

    /**
     * 菜单首页
     */
    public function index()
    {
        $this->setSeoTitle('菜单管理');
        $this->addBreadcrumb('菜单管理', $this->currentUrl);
        //菜单模块类别
        $sysMenu = new \App\Service\SysMenu();
        $this->assign('moduleTypeList', $sysMenu->getModuleTypeList());
        $moduleType = isset($_GET['moduleType']) && $_GET['moduleType'] ? $_GET['moduleType'] : $sysMenu::MENU_TYPE_ADMIN;
        $this->assign('moduleType', $moduleType);
        //菜单列表
        $menuList     = $this->sysMenuModel->getMenuList($moduleType);
        //树结构菜单列表
        $tree          = new \App\Common\Tree('menuId', 'parentId', 'child');
        $tree->nameKey = 'menuName';
        $tree->load($menuList);
        //可嵌套列表
        $addHtml = '<button type="button" class="btn btn-outline btn-danger btn-xs pull-right del"><i class="fa fa-trash-o"></i>删除</button>';
        $addHtml .= '<button type="button" class="btn btn-outline btn-primary btn-xs pull-right edit" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>编辑</button>';
        $addHtml .= '<button type="button" class="btn btn-outline btn-primary btn-xs pull-right addchild" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>添加子菜单</button>';
        $nestableHtml = $tree->buildNestableTree($addHtml);
        $this->assign('nestableHtml', $nestableHtml);
        $this->display();
    }
}