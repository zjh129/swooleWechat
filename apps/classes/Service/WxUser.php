<?php
namespace App\Service;

use Swoole;

/**
 * 微信用户相关服务类
 * @package App\Service
 */
class WxUser
{
    /**
     * @var \App\Model\WxUser
     */
    private $wxUserModel;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->wxUserModel = model('WxUser');
    }

    public function syncOnline()
    {

    }
    /**
     * 设置用户备注
     * @param $openId
     * @param string $remark
     * @return bool
     * @throws \Exception
     */
    public function setRemark($userId, $remark = '')
    {
        $this->wxUserModel->start();
        try{
            $findUser = $this->wxUserModel->get($userId);
            if (!$findUser){
                throw new \Exception('微信用户不存在');
            }
            $rs = Swoole::$php->easywechat->user->remark($findUser['openId'], $remark);
            if (!$rs){
                throw new \Exception('线上设置用户备注失败');
            }
            $localRs = $this->wxUserModel->set($findUser['userId'], ['remark' => $remark]);
            if (!$localRs){
                throw new \Exception('本地设置备注失败');
            }
            $this->wxUserModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxUserModel->rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 批量拉黑用户
     * @param array $userIds
     * @return bool
     * @throws \Exception
     */
    public function setBatchBlock($userIds = [])
    {
        if (!$userIds){
            throw new \Exception('请选择要拉黑的用户ID');
        }
        $this->wxUserModel->start();
        try{
            $userList = $this->wxUserModel->gets([
                'select' => 'userId,openId',
                'where' => "`userId` in (".implode(',', $userIds).") AND `isBlock`=0"
            ]);
            if (!$userList){
                throw new \Exception('您所选择拉黑的用户无效');
            }
            $userIds = array_column($userList, 'userId');
            $openIdList = array_column($userList, 'openId');
            $rs = Swoole::$php->easywechat->user->batchBlock($openIdList);
            if ($rs['errcode'] != 0){
                throw new \Exception('线上拉黑用户失败');
            }
            $rsLocal = $this->wxUserModel->sets(['isBlock'=>1], [
                'where' => "`userId` in (".implode(',', $userIds).")"
            ]);
            if (!$rsLocal){
                throw new \Exception('本地拉黑用户失败');
            }
            $this->wxUserModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxUserModel->rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 批量取消拉黑用户
     * @param array $userIds
     * @return bool
     * @throws \Exception
     */
    public function setBatchUnblock($userIds = [])
    {
        if (!$userIds){
            throw new \Exception('请选择要取消拉黑的用户ID');
        }
        $this->wxUserModel->start();
        try{
            $userList = $this->wxUserModel->gets([
                'select' => 'userId,openId',
                'where' => "`userId` in (".implode(',', $userIds).") AND `isBlock`=1"
            ]);
            if (!$userList){
                throw new \Exception('您所选择取消拉黑的用户无效');
            }
            $userIds = array_column($userList, 'userId');
            $openIdList = array_column($userList, 'openId');
            $rs = Swoole::$php->easywechat->user->batchUnblock($openIdList);
            if ($rs['errcode'] != 0){
                throw new \Exception('线上取消拉黑用户失败');
            }
            $rsLocal = $this->wxUserModel->sets(['isBlock'=>0], [
                'where' => "`userId` in (".implode(',', $userIds).")"
            ]);
            if (!$rsLocal){
                throw new \Exception('本地取消拉黑用户失败');
            }
            $this->wxUserModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxUserModel->rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 设置微信分组
     * @param $userId
     * @param int $wxGroupId
     * @return bool
     * @throws \Exception
     */
    public function setUserGroup($userId, $wxGroupId = 0)
    {
        $this->wxUserModel->start();
        try{
            $findUser = $this->wxUserModel->getone($userId);
            if (!$findUser){
                throw new \Exception('微信用户不存在');
            }
            $rs = Swoole::$php->easywechat->user_group->moveUser($userId['openId'], $wxGroupId);
            if (!$rs){
                throw new \Exception('线上设置用户分组失败');
            }
            $localRs = $this->wxUserModel->set($findUser['userId'], ['groupId' => $wxGroupId]);
            if (!$localRs){
                throw new \Exception('本地设置用户分组失败');
            }
            $this->wxUserModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxUserModel->rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 批量设置用户分组
     * @param $userIds
     * @param int $wxGroupId
     * @return bool
     * @throws \Exception
     */
    public function setUsersGroup($userIds, $wxGroupId = 0)
    {
        if (!$userIds){
            throw new \Exception('请选择要移动分组的用户ID');
        }
        $this->wxUserModel->start();
        try{
            $userList = $this->wxUserModel->gets([
                'select' => 'userId,openId',
                'where' => "`userId` in (".implode(',', $userIds).") AND `subscribe`=1"
            ]);
            if (!$userList){
                throw new \Exception('您选择设置分组的用户无效');
            }
            $userIds = array_column($userList, 'userId');
            $openIdList = array_column($userList, 'openId');
            $rs = Swoole::$php->easywechat->user_group->moveUsers($openIdList, $wxGroupId);
            if ($rs['errcode'] != 0){
                throw new \Exception('线上设置用户分组失败');
            }
            $rsLocal = $this->wxUserModel->sets(['groupId'=>$wxGroupId], [
                'where' => "`userId` in (".implode(',', $userIds).")"
            ]);
            if (!$rsLocal){
                throw new \Exception('本地设置用户分组失败');
            }
            $this->wxUserModel->commit();
            return true;
        }catch (\Exception $e){
            $this->wxUserModel->rollback();
            throw new \Exception($e->getMessage());
        }
    }
}