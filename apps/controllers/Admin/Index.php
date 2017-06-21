<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

class Index extends Base
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }

    /**
     * 后台主页
     */
    public function index()
    {
        $this->display();
    }
    public function index2()
    {
        return time();
    }
}