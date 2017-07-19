<?php

namespace App\Model;

/**
 * 微信用户模型.
 */
class WxUserGroup extends \App\Component\BaseModel
{
    public $primary = 'groupId';
    /**
     * 表名.
     *
     * @var string
     */
    public $table = 'wx_user_group';
}
