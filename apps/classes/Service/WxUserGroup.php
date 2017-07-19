<?php
namespace App\Service;

use Swoole;
/**
 * 微信用户组服务类
 * @package App\Service
 */
class WxUserGroup
{
    /**
     * @var \App\Model\WxUserGroup
     */
    private $wxUserGroupModel;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->wxUserGroupModel = model('WxUserGroup');
    }

    /**
     * 同步线上用户组数据
     */
    public function syncOnline()
    {
        $onlineGroups = Swoole::$php->easywechat->user_group->lists();
        if (!isset($onlineGroups['groups']) || empty($onlineGroups['groups'])){
            throw new \Exception('线上用户组数据为空');
        }
        $this->wxUserGroupModel->start();
        try{
            foreach ($onlineGroups['groups'] as $groupData){

            }
            $this->wxUserGroupModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxUserGroupModel->rollback();
            throw new \Exception($e->getMessage());
        }

    }
}