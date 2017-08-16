<?php
namespace App\Controller\Admin;
use App\BaseController\AdminBaseController as Base;

class WxTemplate extends Base
{
    /**
     * @var \App\Model\WxTemplate
     */
    private $wxTemplateModel;

    /**
     * @var \App\Service\WxTemplate
     */
    private $wxTemplateSer;

    /**
     * 构造函数
     * @param \Swoole $swoole
     */
    public function __construct(\Swoole $swoole)
    {
        parent::__construct($swoole);
        $this->addBreadcrumb('模板消息管理', '/Admin/WxTemplate/index');
        $this->wxTemplateModel = model('WxTemplate');
        $this->wxTemplateSer = new \App\Service\WxTemplate();
    }

    /**
     * 模板消息列表
     */
    public function index()
    {
        $this->setSeoTitle('模板消息管理');
        $this->addBreadcrumb('模板消息管理', $this->currentUrl);
        //使用key列表
        $keyList = $this->wxTemplateSer->getKeyList();
        $this->assign('keyList', $keyList);
        $this->display();
    }

    /**
     * 获取模板消息列表
     * @return array
     */
    public function getPageList()
    {
        //绘制计数器。
        $draw = (int) ($this->request->request['draw'] ?? 0);
        $where = [
            'select' => '`templateId`,`key`,`wxTemplateId`,`title`,`primaryIndustry`,`deputyIndustry`,`content`,`example`',
        ];
        //开始位置
        $start = (int) ($this->request->request['start'] ?? 0);
        //长度
        $length = (int) ($this->request->request['length'] ?? 10);
        $where['limit'] = $start . ',' . $length;
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
                    $where['order'] = '`key` '.$order[0]['dir'];
                    break;
                default:
                    $where['order'] = '`templateId` DESC';
            }
        }

        $data  = [
            'draw' => $draw,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
        ];
        $data['recordsTotal'] = $this->wxTemplateModel->count($where);
        $list = $this->wxTemplateModel->getList($where);
        if ($list){
            foreach ($list as $k => $v){
                $v['keyName'] = $this->wxTemplateSer->getKeyName($v['key']);
                $list[$k] = $v;
            }
        }
        $data['data'] = $list;
        $data['recordsFiltered'] = count($list);

        return $data;
    }

    /**
     * 同步线上模板
     * @return bool
     */
    public function syncOnline()
    {
        try {
            $rs = $this->wxTemplateSer->syncOnline();
            if ($rs){
                return $this->showMsg('success', '同步所有用户成功');
            }
            throw new \Exception('同步所有用户失败');
        } catch (\Exception $e) {
            return $this->showMsg('error', $e->getMessage());
        }
    }
    public function setKey()
    {

    }
}