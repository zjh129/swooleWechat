<?php
namespace App\Component;

use Swoole;

/**
 * 发送消息模型
 * @subpackage Model
 * @package App\Model
 */
class BaseModel extends Swoole\Model
{
    /**
     * 获取单个数据
     * @param $params
     * @return array
     * @throws \Exception
     */
    public function getone($params)
    {
        if (empty($params))
        {
            throw new \Exception("no params.");
        }

        $selectdb = new \Swoole\SelectDB($this->db);
        $selectdb->from($this->table);
        $selectdb->primary = $this->primary;
        $selectdb->select($this->select);

        if (!isset($params['order']))
        {
            $params['order'] = "`{$this->table}`.{$this->primary} desc";
        }
        $selectdb->put($params);

        return $selectdb->getone();
    }
}