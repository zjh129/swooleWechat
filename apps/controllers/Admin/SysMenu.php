<?php

namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统菜单管理.
 */
class SysMenu extends Base
{
    /**
     * 菜单模型
     * @var \App\Model\SysMenu
     */
    private $sysMenuModel;
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('系统管理', '/admin/System/index');
        $this->sysMenuModel = model('SysMenu');
    }

    /**
     * 菜单管理界面.
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
        $tree          = new \App\Common\Tree('menuId', 'parentMenuId', 'child');
        $tree->nameKey = 'menuName';
        $tree->load($menuList);
        $optionHtml = $tree->buildOptions();
        //菜单选择列表
        $this->assign('menuTreeOption', $optionHtml);
        //可嵌套列表
        $addHtml  = '<button type="button" class="btn btn-outline btn-primary btn-xs pull-right edit" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>编辑</button>';
        $addHtml .= '<button type="button" class="btn btn-outline btn-danger btn-xs pull-right del"><i class="fa fa-trash-o"></i>删除</button>';
        $nestableHtml = $tree->buildNestableTree($addHtml);
        $this->assign('nestableHtml', $nestableHtml);
        $this->display();
    }

    /**
     * 保存菜单数据.
     */
    public function saveData()
    {
        try {
            $menuData              = $this->request->post;
            $menuData['addUserId'] = $this->user->getUid();
            $sysMenu               = new \App\Service\SysMenu();
            $rs                    = $sysMenu->saveMenu($menuData);
            if ($rs) {
                return $this->showMsg('success', ($menuData['menuId'] ? '编辑' : '添加') . '成功', '/admin/sysmenu/index');
            }
            throw new \Exception(($menuData['menuId'] ? '编辑' : '添加') . '菜单失败');
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }

    /**
     * 获取菜单数据.
     *
     * @return bool
     */
    public function getData()
    {
        try {
            $menuId   = $this->request->get['menuId'] ?? 0;
            $menuData = $this->sysMenuModel->getone(['menuId'=>$menuId]);

            return $this->showMsg('success', '获取成功', '', $menuData);
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }

    /**
     * 保存排序层级数据.
     */
    public function saveSort()
    {
        try {
            $sortData = $this->request->post['sortData'];
            if (empty($sortData)) {
                throw new \Exception('排序数据有误');
            }
            $sysMenu = new \App\Service\SysMenu();
            $rs      = $sysMenu->saveSort($sortData);
            if ($rs) {
                return $this->showMsg('success', '保存排序成功');
            }
            throw new \Exception('保存排序失败');
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }

    /**
     * 删除菜单
     * @return bool
     */
    public function delMenu()
    {
        try {
            $menuId   = $this->request->post['menuId'] ?? 0;
            if (!$menuId){
                throw new \Exception('请指定要删除的菜单');
            }
            $rs = $this->sysMenuModel->set($menuId, ['isDel'=>1]);
            if ($rs){
                return $this->showMsg('success', '删除成功');
            }
            throw new \Exception('删除失败');
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }
}
