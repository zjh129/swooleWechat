<?php
namespace App\Component;

use Swoole;

/**
 * 基础模型类
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

        $this->dbs->from($this->table);
        $this->dbs->primary = $this->primary;
        $this->dbs->select($this->select);

        if (!isset($params['order']))
        {
            $params['order'] = "`{$this->table}`.{$this->primary} desc";
        }
        $this->dbsb->put($params);

        return $this->dbs->getone();
    }
}