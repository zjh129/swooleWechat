<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

/**
 * 微信用户相关操作.
 */
class WxUser extends Base
{
    /**
     * @var \App\Model\WxUser
     */
    private $wxUserModel;
    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('微信用户', '/Admin/WxUser/index');
        $this->wxUserModel = model('WxUser');
    }

    /**
     * 微信用户管理首页
     */
    public function index()
    {
        $this->setSeoTitle('微信用户管理');
        $this->addBreadcrumb('微信用户管理', $this->currentUrl);

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
        $where = [
            'select' => 'wx_user.*,wx_user_group.groupName',
        ];
        //开始位置
        $start = (int) ($this->request->request['start'] ?? 0);
        //长度
        $length = (int) ($this->request->request['length'] ?? 10);
        $where['limit'] = $start . ',' . $length;
        //搜索关键字
        $keyword = $this->request->request['search']['value'] ?? '';
        if ($keyword){
            $where['where'] = (isset($where['where']) && $where['where'] ? ' AND ' : '') . "`nickName` like '$keyword%'";
        }
        //排序字段
        $order = $this->request->request['order'] ?? [];
        if ($order){
            switch ($order[0]['column']){
                case 1:
                    $where['order'] = 'wx_user.nickName '.$order[0]['dir'];
                    break;
                default:
                    $where['order'] = 'wx_user.subscribeTime DESC';
            }
        }

        $data  = [
            'draw' => $draw,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
        ];
        $data['recordsTotal'] = $this->wxUserModel->count($where);
        $list = $this->wxUserModel->getUserList($where);
        if ($list){
            foreach ($list as $k => $v){
                $v['DT_RowId'] = $v['userId'];
                $v['subscribeTime'] = date('Y-m-d H:i:s', $v['subscribeTime']);
                $list[$k] = $v;
            }
        }
        $data['data'] = $list;
        $data['recordsFiltered'] = count($list);

        return $data;
    }
}