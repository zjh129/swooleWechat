<?php

namespace App\Handler;

use Swoole;

/**
 * 微信用户资料同步.
 *
 * @property \EasyWeChat\Foundation\Application $easywechat
 */
class WxSyncUser implements Swoole\IFace\EventHandler
{
    protected $easywechat;

    public function trigger($type, $data)
    {
        $openid = $data['openid'] ?? '';
        if (!$openid) {
            return false;
        }
        $this->easywechat = Swoole::$php->easywechat;
        $userService      = $this->easywechat->user;
        $userInfo         = $userService->get($openid);
        if ($userInfo) {
            if ($userInfo->subscribe == 1) {
                $saveData = [
                    'openid'        => $userInfo->openid,
                    'nickname'      => $userInfo->nickname,
                    'sex'           => (int) $userInfo->sex,
                    'country'       => $userInfo->country,
                    'province'      => $userInfo->province,
                    'city'          => $userInfo->city,
                    'language'      => $userInfo->language,
                    'headimgurl'    => $userInfo->headimgurl,
                    'subscribeTime' => $userInfo->subscribe_time,
                    'remark'        => $userInfo->remark,
                    'groupid'       => (int) $userInfo->groupid,
                    'tagidList'     => json_encode((array) $userInfo->tagid_list),
                ];
            }
            $saveData['subscribe'] = $userInfo->subscribe;
        }
        $model = model('WxUser');
        $findOne = $model->getone(['openid'=>$openid]);
        if ($findOne){
            return $model->set($findOne['userId'], $saveData);
        }else{
            $saveData['firstSubscribeTime'] = $userInfo->subscribe_time;
            $saveData['createTime'] = time();
            return $model->put($saveData);
        }
    }
}
