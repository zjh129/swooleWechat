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

    /**
     * 获取用户数据
     * @return bool
     */
    public function get()
    {
        try {
            $id   = $this->request->get['id'] ?? 0;
            $data = $this->wxUserModel->getone([
                'where'=>"`userId`=$id",
            ]);
            return $this->showMsg('success', '获取成功', '', $data);
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }

    /**
     * 设置用户备注
     * @return bool
     */
    public function setRemark()
    {
        try {
            $id   = $this->request->post['id'] ?? 0;
            $remark = $this->request->post['remark'] ?? '';
            if (!$remark){
                throw new \Exception('您要设置的备注为空');
            }
            $wxUserSer = new \App\Service\WxUser();
            $rs = $wxUserSer->setRemark($id, $remark);
            if ($rs){
                return $this->showMsg('success', '设置备注成功');
            }
            throw new \Exception('设置备注失败');
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }
    /**
     * 设置拉黑和取消拉黑
     * @return bool
     */
    public function setBlock()
    {
        try {
            $ids   = $this->request->post['ids'] ?? 0;
            $status = (int) $this->request->post['status'] ?? 0;
            $actName = $status == 1 ? '拉黑' : '开启';
            if (!$ids){
                throw new \Exception('请指定要拉黑的用户');
            }
            $wxUserSer = new \App\Service\WxUser();
            if ($status){
                $rs = $wxUserSer->setBatchBlock($ids);
            }else{
                $rs = $wxUserSer->setBatchUnblock($ids);
            }
            if ($rs){
                return $this->showMsg('success', $actName . '成功');
            }
            throw new \Exception($actName . '失败');
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }
}