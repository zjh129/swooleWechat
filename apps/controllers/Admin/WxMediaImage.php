<?php
namespace App\Controller\Admin;
use App\BaseController\AdminBaseController as Base;

/**
 * 图片素材管理
 * @package App\Controller\Admin
 */
class WxMediaImage extends Base
{
    /**
     * @var \App\Model\WxMedia
     */
    private $wxMediaModel;
    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('素材管理', '/Admin/WxMediaImage/index');
        $this->wxMediaModel = model('WxMedia');
    }

    /**
     * 图片素材列表
     */
    public function index()
    {
        $this->setSeoTitle('图片素材管理');
        $this->addBreadcrumb('图片素材管理', $this->currentUrl);

        $this->display();
    }

    /**
     * 获取图片素材列表
     * @return array
     */
    public function getPageList()
    {
        //绘制计数器。
        $draw = (int) ($this->request->request['draw'] ?? 0);
        $where = [
            'select' => '`mediaId`,`wxMediaId`,`title`,`intro`,`uploadPath`,`wxRemoteUrl`',
        ];
        //开始位置
        $start = (int) ($this->request->request['start'] ?? 0);
        //长度
        $length = (int) ($this->request->request['length'] ?? 10);
        $where['limit'] = $start . ',' . $length;
        $where['where'] = 'isDel=0';
        //搜索关键字
        $keyword = $this->request->request['search']['value'] ?? '';
        if ($keyword){
            $where['where'] = (isset($where['where']) && $where['where'] ? ' AND ' : '') . "`title` like '$keyword%'";
        }
        //排序字段
        $order = $this->request->request['order'] ?? [];
        if ($order){
            switch ($order[0]['column']){
                case 1:
                    $where['order'] = '`addTime` '.$order[0]['dir'];
                    break;
                default:
                    $where['order'] = '`mediaId` DESC';
            }
        }

        $data  = [
            'draw' => $draw,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
        ];
        $data['recordsTotal'] = $this->wxMediaModel->count($where);
        $list = $this->wxMediaModel->getList($where);
        if ($list){
            foreach ($list as $k => $v){
                $v['DT_RowId'] = $v['templateId'];
                $list[$k] = $v;
            }
        }
        $data['data'] = $list;
        $data['recordsFiltered'] = count($list);

        return $data;
    }

    /**
     * 新增图片素材
     */
    public function add()
    {

    }
}