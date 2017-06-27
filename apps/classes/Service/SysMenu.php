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
     * 菜单列表
     * @var
     */
    private $menuList;
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
     * 当前选中菜单ID集
     * @var
     */
    private $sysAdminCurrentIds;
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
        $this->menuList = $this->sysMenuModel->getMenuList($moduleType);

        $userId = \Swoole::$php->user->getUid();
        foreach ($this->menuList as $k => $v){
            //无权限则删除
            $isValid = \Swoole::$php->rbac->check(strtolower($v['url']), $userId);
            if(!$isValid){
                unset($this->menuList[$k]);
            }
        }

        $tree     = new \App\Common\Tree('menuId', 'parentMenuId', 'child');
        $tree->load($this->menuList);
        $treelist = $tree->deepTree();

        return $treelist;
    }

    /**
     * 生成后台菜单
     * @return string
     */
    public function buildAdminTreeMenu($currentUrl = '')
    {
        $treeList = $this->getTreeMenuList('admin');
        //初始化标签列表
        $this->initAdminLableList();
        //初始化当前菜单ID集
        $currentMenuData = $this->sysMenuModel->getMenuDataByUrl($currentUrl);
        if ($currentMenuData)
        {
            $this->initCurrentIds($currentMenuData['menuId']);
        }

        return $this->compineAdminTreeMenu($treeList);
    }
    /**
     * 获取当前菜单ID集
     * @param $parentId
     */
    private function initCurrentIds($parentId)
    {
        if ($parentId > 0 && isset($this->menuList[$parentId])){
            $this->sysAdminCurrentIds[] = $parentId;
            if ($this->menuList[$parentId]['menuId'] > 0){
                $this->initCurrentIds($this->menuList[$parentId]['parentMenuId']);
            }
        }
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
                //当前菜单选中状态
                $html .= '<li '.(in_array($menuOne['menuId'], $this->sysAdminCurrentIds) ? 'class="active"' : '').'>';
                //链接
                $html .= '<a href="'.(isset($menuOne['child']) && $menuOne['child'] ? '#' : $menuOne['url']).'">';
                //菜单前面图标
                if (isset($this->adminMenuIconClass[$menuUrl]) && $this->adminMenuIconClass[$menuUrl]){
                    $html .= '<i class="'.$this->adminMenuIconClass[$menuUrl].'"></i>';
                }
                $html .= '<span class="nav-label">'.$menuOne['menuName'].' </span>';
                //标签
                if (isset($this->adminMenuLableList[$menuUrl])){
                    $html .= $this->adminMenuLableList[$menuUrl];
                }elseif (isset($menuOne['child']) && $menuOne['child']){
                    $html .= '<span class="fa arrow"></span>';
                }
                $html .= '</a>';
                if (isset($menuOne['child']) && $menuOne['child']){
                    $html .= $this->compineAdminTreeMenu($menuOne['child'], $menuLevel+1);
                }
            }
            if ($menuLevel > 1){
                $html .= '</ul>';
            }
        }

        return $html;
    }
}
