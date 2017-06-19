<?php
namespace App\BaseController;
use Swoole\Auth;

/**
 * 管理后台基类控制器
 * @package App\Controller\Api
 */
class AdminBaseController extends BaseController
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        $this->template_dir .= 'Admin/';
        //开启session
        $this->session->start();
        //\Swoole\Auth::$login_url = '/Admin/Login/index';
        //\Swoole\Auth::loginRequire();
    }
}