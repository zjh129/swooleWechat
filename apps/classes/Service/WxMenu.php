<?php
namespace App\Service;

class WxMenu
{
    /**
     * @var \App\Model\WxMenu
     */
    private $wxMenuModel;
    /**
     * 菜单类别列表
     * @var
     */
    private $menuTypeList;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->wxMenuModel = model('WxMenu');
    }

    /**
     * 菜单类别列表
     */
    public function getMenuTypeList()
    {
        $this->menuTypeList = [
            'click' => '点击类型',
            'view' => '网页类型',
            'miniprogram' => '小程序',
            'scancode_push' => '扫码推事件',
            'scancode_waitmsg' => '扫码带提示',
            'pic_sysphoto' => '系统拍照发图',
            'pic_photo_or_album' => '拍照或者相册发图',
            'pic_weixin' => '微信相册发图',
            'location_select' => '发送位置',
            'media_id' => '图片',
            'view_limited' => '图文消息',
        ];
        return $this->menuTypeList;
    }
    /**
     * 保存菜单排序数据
     * @param $sortData
     * @return bool
     * @throws \Exception
     */
    public function saveSort($sortData)
    {
        $this->wxMenuModel->start();
        try{
            $this->saveSortData($sortData);
            $this->wxMenuModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxMenuModel->rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 保存排序数据
     * @param $list
     * @param int $parentId
     * @return bool
     */
    private function saveSortData($list, $parentId = 0)
    {
        if ($list) {
            foreach ($list as $k => $v) {
                $id = isset($v['id']) && $v['id'] ? (int)$v['id'] : 0;
                $id && $this->wxMenuModel->set($id, ['orderNum' => $k, 'parentId' => $parentId]);
                if (isset($v['children']) && $v['children']) {
                    $this->saveSortData($v['children'], $id);
                }
            }
            return true;
        }
    }

    /**
     * 同步线上数据
     */
    public function syncOnline()
    {

    }

    /**
     * 推送菜单配置到线上
     */
    public function pushOnline()
    {

    }

    /**
     * 保存菜单数据
     * @param array $menuData
     */
    public function saveMenu($menuData = [])
    {

    }
}