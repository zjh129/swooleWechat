<?php

namespace App\Model;

/**
 * 微信用户模型.
 */
class WxUser extends \App\Component\BaseModel
{
    public $primary = 'userId';
    /**
     * 表名.
     *
     * @var string
     */
    public $table = 'wx_user';
}
