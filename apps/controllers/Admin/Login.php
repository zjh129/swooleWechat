<?php
namespace App\Controller\Admin;

use App\BaseController\AdminBaseController as Base;
use Swoole;
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
        $error = '';
        //使用crypt密码
        \Swoole\Auth::$password_hash = \Swoole\Auth::HASH_CRYPT;

        $this->session->start();
        //已经登录了，跳转到
        if ($this->user->isLogin())
        {
            $this->http->redirect('/Admin/Index/index');
            return;
        }
        if ($_POST)
        {
            try{
                if (!$_POST['username']){
                    throw new \Exception('请输入管理账号');
                }
                if (!$_POST['password']){
                    throw new \Exception('请输入管理密码');
                }
                if (!$_POST['captcha']){
                    throw new \Exception('请输入验证码');
                }
                if ($_POST['captcha'] != $_SESSION['vcode']){
                    throw new \Exception('验证码错误');
                }
                $r = $this->user->login(trim($_POST['username']), $_POST['password']);
                if (!$r)
                {
                    throw new \Exception('登录失败');
                }
                $this->http->redirect('/Admin/Index/home/');

            }catch (\Exception $e){
                $error = $e->getMessage();
            }
        }
        $this->assign('error', $error);
        $this->display();
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        $this->session->start();
        $this->user->logout();
    }

    /**
     * 验证码
     */
    public function captcha()
    {
        //启动会话
        $this->session->start();
        //输出格式为图片
        $this->http->header('Content-Type', 'image/png');
        //生成验证码
        $verifyCode = Swoole\Image::verifycode_gd();
        //将验证码数字写入session
        $_SESSION['vcode'] = $verifyCode['code'];
        return $verifyCode['image'];
    }
}