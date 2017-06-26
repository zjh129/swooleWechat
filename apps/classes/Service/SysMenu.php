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
    //图标后缀标签
    private $adminMenuLableList = [];

    /**
     * @var \App\Model\SysMenu
     */
    private $sysMenuModel;
    /**
     * 后台管理菜单
     * @var
     */
    private $sysAdminMenuList;
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

        $userId = \Swoole::$php->user->getUid();
        foreach ($menuList as $v){
            \Swoole::$php->rbac->check(strtolower($v['url']), $userId);
        }

        $tree     = new \App\Common\Tree('menuId', 'parentMenuId', 'child');
        $tree->load($menuList);
        $treelist = $tree->deepTree();

        return $treelist;
    }

    /**
     * 生成后台菜单
     * @return string
     */
    public function buildAdminTreeMenu()
    {
        $treeList = $this->getTreeMenuList('admin');
        //初始化标签列表
        $this->initAdminLableList();

        return $this->compineAdminTreeMenu($treeList);
    }
    /**
     * 初始化菜单标签列表
     */
    private function initAdminLableList()
    {

    }
    /**
     * 合并后台菜单html
     */
    private function compineAdminTreeMenu($menuList = [], $menuLevel = 1)
    {
        $html = '';
        if ($menuList){
            if ($menuLevel == 2){
                $html .= '<ul class="nav nav-second-level collapse">';
            }elseif ($menuLevel == 3){
                $html .= '<ul class="nav nav-third-level collapse">';
            }
            foreach ($menuList as $menuOne){
                $menuUrl = strtolower($menuOne['url']);
                $html .= '<li>';
                //链接
                $html .= '<a href="'.($menuOne['child'] ? '#' : $menuOne['url']).'">';
                //菜单前面图标
                if (isset($this->sysAdminMenuList[$menuUrl])){
                    $html .= '<i class="'.$this->sysAdminMenuList[$menuUrl].'"></i>';
                }
                $html .= '<span class="nav-label">'.$menuOne['menuName'].' </span>';
                //标签
                if ($menuOne['child']){
                    $html .= '';
                }
                if (isset($this->adminMenuLableList[$menuUrl])){
                    $html .= $this->adminMenuLableList[$menuUrl];
                }elseif (isset($menuOne['child']) && $menuOne['child']){
                    $html .= '<span class="fa arrow"></span>';
                }
                $html .= '</a>';
                if ($menuOne['child']){
                    $html .= $this->compineAdminTreeMenu($menuList['child'], $menuLevel+1);
                }
            }
            if ($menuLevel > 1){
                $html .= '</ul>';
            }
        }

        return $html;
    }
}
