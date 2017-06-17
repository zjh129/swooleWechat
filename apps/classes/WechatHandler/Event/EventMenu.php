<?php

namespace App\WechatHandler\Event;

use App\WechatHandler\Base;
use App\WechatHandler\InterfaceHandler;

/**
 * 自定义菜单事件消息处理.
 */
class EventMenu extends Base implements InterfaceHandler
{
    /**
     * 主入口方法.
     */
    public function main()
    {
        $event = strtolower($this->recMessage->Event);
        switch ($event) {
            case 'click'://点击菜单拉取消息时的事件推送
                $menuModel = model('WxCustomMenu');
                $menuData  = $menuModel->getone([
                    'select' => 'id,type,material_id',
                    'where'  => "`id` = '" . $this->recMessage->EventKey . "'",
                ]);
                if ($menuData['type'] == 1) {//系统回复
                    $materialData = (new \App\Service\WxMaterial())->getMaterialData($menuData['material_id']);

                    return $this->formatMessage($materialData);
                } elseif ($menuData['type'] == 2) {//动态获取
                    return false;
                }//访问网页
                return false;

                break;
            case 'view'://点击菜单跳转链接时的事件推送
                break;
        }

        return false;
    }
}
