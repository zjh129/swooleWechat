<?php
namespace App\Model;
/**
 * 微信菜单模型
 * @package App\Model
 */
class WxMenu extends \App\Component\BaseModel
{
    public $primary = 'menuId';
    /**
     * 表名
     * @var string
     */
    public $table = 'wx_menu';

    /**
     * 重构获取菜单数据方法
     * @param $params
     * @return array
     */
    public function getone($params)
    {
        $menuData = parent::getone($params);
        if(isset($menuData['matchrule'])){
            $menuData['matchrule'] = $menuData['matchrule'] ? json_decode($menuData['matchrule'], true) : [];
        }
        return $menuData;
    }

    /**
     * @param string $moduleType
     * @return array
     */
    public function getMenuList()
    {
        $menuList = $this->gets([
            'select' => 'menuId,wxMenuId,menuName,isConditional,parentId',
            'where' => "`isDel`=0",
            'order' => "orderNum ASC,menuId ASC",
        ]);
        $newMenuList = [];
        foreach ($menuList as $v){
            //$v['url'] = strtolower($v['url']);
            $newMenuList[(int)$v['menuId']] = $v;
        }
        return $newMenuList;
    }
}