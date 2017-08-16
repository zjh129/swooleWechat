<?php
namespace App\Service;
/**
 * 模板消息服务类
 * @package App\Service
 */
class WxTemplate
{
    /**
     * @var \App\Model\WxTemplate
     */
    private $wxTemplateModel;
    /**
     * 模板关键词key列表
     * @var array
     */
    private $keyList = [
        'score_change' => '积分变更提醒',
        'order_submit' => '订单提交提醒',
        'order_cancel' => '订单取消提醒',
        'order_refund' => '订单退货提醒',
    ];

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->wxTemplateModel = model('WxTemplate');
    }

    /**
     * 获取KEY列表
     * @return array
     */
    public function getKeyList()
    {
        return $this->keyList;
    }
    /**
     * 获取模板关键词名称
     * @param string $key
     */
    public function getKeyName($key = '')
    {
        return isset($this->keyList[$key]) ? $this->keyList[$key] : '';
    }

    /**
     * 设置KEY
     * @param $templateId
     * @param $key
     */
    public function setKey($templateId, $key)
    {
        $templateData = $this->wxTemplateModel->getone(['templateId'=>$templateId, 'isDel'=>0]);
        if (empty($templateD)){
            throw new \Exception('模板数据不存在');
        }
        if ($templateData['key'] == $key){
            throw new \Exception('该模板已设置该KEY');
        }
        $findOther = $this->wxTemplateModel->getone(['key' => $key, 'isDel'=> 0]);
        if ($findOther){
            throw new \Exception('该KEY已被占用');
        }
        return $this->wxTemplateModel->set($templateId, ['key'=>$key]);
    }
    /**
     * 同步拉取线上模板消息列表
     */
    public function syncOnline()
    {
        $templateList = \Swoole::$php->easywechat->notice->getPrivateTemplates();
        $templateList = $templateList->toArray();
        if ($templateList['template_list']){
            $this->wxTemplateModel->start();
            try{
                $this->wxTemplateModel->sets(['isDel'=>1], ['isDel' => 0]);
                foreach ($templateList['template_list'] as $templateData){
                    $wxTemplateId = $templateData['template_id'];
                    $data = [
                        'wxTemplateId' => $templateData['template_id'],
                        'title' => $templateData['title'],
                        'primaryIndustry' => $templateData['primary_industry'] ?? '',
                        'deputyIndustry' => $templateData['deputy_industry'] ?? '',
                        'content' => $templateData['content'] ?? '',
                        'example' => $templateData['example'] ?? '',
                        'keywords' => json_encode([]),
                        'isDel' => 0,
                    ];
                    $findData = $this->wxTemplateModel->getone(['wxTemplateId'=>$wxTemplateId, 'select'=>'templateId']);
                    if ($findData){
                        $this->wxTemplateModel->set($findData['templateId'], $data);
                    }else{
                        $this->wxTemplateModel->put($data);
                    }
                }
                $this->wxTemplateModel->commit();
                return true;
            }catch (\Exception $e){
                $this->wxTemplateModel->rollback();
                throw new \Exception($e->getMessage());
            }
        }
        throw new \Exception('模板列表为空');
    }

    /**
     * 设置账号所属行业
     */
    public function setIndustry($industry1, $industry2)
    {
        return \Swoole::$php->easywechat->notice->setIndustry($industry1, $industry2);
    }

    /**
     * 根据模板库中的编号添加模板
     * @param $shortId
     */
    public function add($shortId)
    {
        \Swoole::$php->easywechat->notice->addTemplate($shortId);
        $this->syncOnline();
    }

    /**
     * 删除
     * @param $templateId
     */
    public function del($templateId)
    {
        $templateData = $this->wxTemplateModel->getone(['templateId'=>$templateId, 'isDel'=>0, 'select'=>'templateId,wxTemplateId']);
        if (empty($templateD)){
            throw new \Exception('模板数据不存在');
        }
        \Swoole::$php->easywechat->notice->deletePrivateTemplate($templateData['wxTemplateId']);
        $this->wxTemplateModel->set($templateData['templateId'], ['isDel'=>1]);
    }

    /**
     * 发送模板消息
     * @param $key
     * @param array $templateData
     */
    public function send($key, $defineData = [])
    {
        $templateData = $this->wxTemplateModel->getone(['key'=>$key, 'isDel'=>0, 'select'=>'templateId,wxTemplateId']);
        if (empty($templateD)){
            throw new \Exception('模板数据不存在');
        }
        if (empty($defineData['touser'])){
            throw new \Exception('请设置接收模板消息用户');
        }
        if (empty($defineData['data'])){
            throw new \Exception('请设置模板消息数据');
        }
        $sendData = [
            'touser' => $defineData['touser'],
            'template_id' => $templateData['wxTemplateId'],
            'data' => $defineData['data'],
        ];
        if (!empty($defineData['url'])){
            $sendData['url'] = $defineData['url'];
        }
        if (!empty($defineData['miniprogram'])){
            $sendData['miniprogram'] = $defineData['miniprogram'];
        }
        \Swoole::$php->easywechat->notice->send($sendData);

        return true;
    }
}