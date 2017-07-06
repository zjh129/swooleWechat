<?php

namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统用户相关操作.
 */
class SysAuthRule extends Base
{
    /**
     * @var \App\Model\SysAuthRule
     */
    private $sysAuthRuleModel;

    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->sysAuthRuleModel = model('SysAuthRule');
    }
}
