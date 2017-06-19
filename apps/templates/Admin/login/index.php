<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理 | 登录界面</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="//static.tudouyu.cn/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//static.tudouyu.cn/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//static.tudouyu.cn/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="//static.tudouyu.cn/AdminLTE/2.3.11/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="//static.tudouyu.cn/iCheck/1.0.2/skins/square/blue.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Admin</b>LTE
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登录开始您的会话</p>

        <form action="/Admin/Login/index" method="post">
            <?php echo $this->getContent(); ?>
            <div class="form-group has-feedback">
                <input type="account" class="form-control" placeholder="账号">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group has-feedback">
                        <input type="captcha" class="form-control" placeholder="captcha">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <img alt="点击换图" id="codeImg" style="cursor:pointer; width:100px;height: 40px;" src="/Admin/public/captcha" align="absmiddle">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <!-- <div class="checkbox icheck">
                      <label>
                        <input type="checkbox"> 记住我
                      </label>
                    </div> -->
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <a href="#">忘记密码请联系管理员</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.4 -->
<script src="//static.tudouyu.cn/jQuery/jquery-2.2.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="//static.tudouyu.cn/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="//static.tudouyu.cn/iCheck/1.0.2/icheck.min.js"></script>
<script>
    $(function () {
        //切换验证码
        $("#codeImg").click(function () {
            $(this).attr('src', '/Admin/login/captcha?=' + Math.random(0,1));
        });
    });
</script>
</body>
</html>