<?php
namespace App\BaseController;

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
        $requestPath = $this->request->meta['path'];
        //非登录界面都要验证是否登录
        if (in_array(strtolower($requestPath), ['/admin/login/index', '/admin/login/captcha'])){
            //\Swoole\Auth::loginRequire();
        }
    }
}