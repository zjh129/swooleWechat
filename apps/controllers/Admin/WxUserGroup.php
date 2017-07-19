<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 微信用户相关操作.
 */
class WxUserGroup extends Base
{
    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('微信用户', '/Admin/WxUser/index');
    }

    /**
     * 微信用户管理首页
     */
    public function index()
    {
        $this->setSeoTitle('微信用户组管理');
        $this->addBreadcrumb('微信用户组管理', $this->currentUrl);

        $this->display();
    }

    /**
     * 同步微信线上数据
     */
    public function syncOnline()
    {
        return $this->easywechat->user_group->lists();
    }
}