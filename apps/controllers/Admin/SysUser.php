<?php

namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 系统用户相关操作.
 */
class SysUser extends Base
{
    /**
     * @var \App\Model\SysUser
     */
    private $sysUserModel;

    /**
     * 构造函数.
     *
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('系统管理', '/Admin/System/index');
        $this->sysUserModel = model('SysUser');
    }

    /**
     * 用户列表.
     */
    public function index()
    {
        $this->setSeoTitle('用户管理');
        $this->addBreadcrumb('用户管理', $this->currentUrl);

        $this->display();
    }

    /**
     * 返回用户列表数据
     * @return array
     */
    public function getPageList()
    {
        //绘制计数器。
        $draw = (int) ($this->request->request['draw'] ?? 0);
        //开始位置
        $start = (int) ($this->request->request['start'] ?? 0);
        //长度
        $length = (int) ($this->request->request['length'] ?? 10);
        //搜索关键字
        $keyword = $this->request->request['search'] ?? '';
        //排序字段
        $order = $this->request->request['order'] ?? [];

        $data  = [
            'draw' => $draw,
            'recordsTotal' => 20,
            'recordsFiltered' => 10,
            'data' => [],
        ];
        $data['data'][] = [
            'userName' => '超级管理员',
            'account' => 'admin',
            'groupName' => '超级用户组',
            'email' => 'zhaojianhui129@163.com',
            'loginTime' => date('Y-m-d H:i:s'),
            'loginIp' => '127.0.0.1',
        ];

        return $data;
    }
}
