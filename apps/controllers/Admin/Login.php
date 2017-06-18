<?php
namespace App\Controller\Admin;

use App\BaseController\BaseController as Base;

/**
 * 后台登录控制器
 * @package App\Controller\Admin
 */
class Login extends Base
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
    }

    /**
     * 登录界面
     */
    public function index()
    {
        //使用crypt密码
        \Swoole\Auth::$password_hash = \Swoole\Auth::HASH_CRYPT;

        $this->session->start();
        //已经登录了，跳转到
        if ($this->admin->isLogin())
        {
            $this->http->redirect('/Admin/Index/index');
            return;
        }
        if (!empty($_POST['password']))
        {
            $r = $this->admin->login(trim($_POST['username']), $_POST['password']);
            if ($r)
            {
                $this->http->redirect('/Admin/Index/home/');
                return;
            }
            else
            {
                echo "登录失败";
            }
        }
        else
        {
            $this->display('user/login.php');
        }
    }
    function logout()
    {
        $this->session->start();
        $this->admin->logout();
    }
}