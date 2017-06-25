<?php

namespace App\Service;

/**
 * 系统菜单服务类.
 */
class SysMenu
{
    const MENU_TYPE_PUBLIC = 'public';
    const MENU_TYPE_ADMIN  = 'admin';
    const MENU_TYPE_INDEX  = 'index';
    const MENU_TYPE_USER   = 'user';
    /**
     * 后台菜单图标类
     * @var array
     */
    private $adminMenuIconClass = [
        '/Admin/Index/index' => 'fa fa-th-large',//仪表盘
        '/Admin/Index/sysinfo' => '',//系统信息
        '/Admin/System/index' => '',//系统管理
        '/Admin/SysMenu/index' => '',//菜单管理
        '/Admin/SysUserGroup/index' => '',//用户组管理
        '/Admin/SysUser/Index' => '',//用户管理
        '/Admin/SysAuthRule/index' => '',//权限管理
    ];
    /**
     * @var \App\Model\SysMenu
     */
    private $sysMenuModel;

    /**
     * 构造函数.
     */
    public function __construct()
    {
        $this->sysMenuModel = model('SysMenu');
    }

    /**
     * 获取菜单属性数组结构.
     *
     * @param $moduleType
     *
     * @return array
     */
    public function getTreeMenuList($moduleType)
    {
        $menuList = $this->sysMenuModel->getMenuList($moduleType);
        $tree     = new \App\Common\Tree('menuId', 'parentMenuId', 'child');
        $tree->load($menuList);
        $treelist = $tree->deepTree();

        return $treelist;
    }
}
