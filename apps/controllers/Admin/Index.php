<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;

class Index extends Base
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }
    
    public function index()
    {
        echo __METHOD__;
    }
}