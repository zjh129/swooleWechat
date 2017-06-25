<?php
namespace App\Model;
/**
 * 系统菜单模型
 * @package App\Model
 */
class SysMenu extends \App\Component\BaseModel
{
    public $primary = 'menuId';
    /**
     * 表名
     * @var string
     */
    public $table = 'sys_menu';

    /**
     * 显示菜单列表
     * @param string $moduleType
     * @return array
     */
    public function getMenuList($moduleType = 'admin')
    {
        $menuList = $this->gets([
            'select' => 'menuId,menuName,url,parentMenuId',
            'where' => "`moduleType`='$moduleType' AND `isDel`=0",
            'order' => "orderNum ASC,menuId ASC",
        ]);
        return $menuList;
    }
}