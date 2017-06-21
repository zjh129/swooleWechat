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
                if (strtolower($_POST['captcha']) != strtolower($_SESSION['vcode'])){
                    throw new \Exception('验证码错误');
                }
                \Swoole\Auth::$username = 'account';
                \Swoole\Auth::$lastlogin = 'loginTime';
                \Swoole\Auth::$lastip = 'loginIp';
                //使用crypt密码
                \Swoole\Auth::$password_hash = \Swoole\Auth::HASH_SHA1;
                $r = $this->user->login(trim($_POST['username']), trim($_POST['password']));
                if (!$r)
                {
                    throw new \Exception('登录失败,账号或密码错误');
                }
                $this->user->updateStatus();
                $redireUrl = isset($_GET['refer']) && $_GET['refer'] ? $_GET['refer'] : '/Admin/Index/index/';
                $this->http->redirect($redireUrl);

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
        if($this->user->logout()){
            $this->http->redirect('/Admin/Login/index');
        }else{
            $this->http->redirect('/Admin/Index/index');
        }
    }

    /**
     * 验证码
     */
    public function captcha()
    {
        //输出格式为图片
        $this->http->header('Content-Type', 'image/png');
        //生成验证码
        $verifyCode = Swoole\Image::verifycode_gd();
        //将验证码数字写入session
        $_SESSION['vcode'] = $verifyCode['code'];
        return $verifyCode['image'];
    }
}