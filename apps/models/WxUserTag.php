<?php

namespace App\Model;

/**
 * 微信用户标签模型.
 */
class WxUserTag extends \App\Component\BaseModel
{
    public $primary = 'tagId';
    /**
     * 表名.
     *
     * @var string
     */
    public $table = 'wx_user_tag';
}
