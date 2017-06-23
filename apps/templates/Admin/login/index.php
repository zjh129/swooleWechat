<?php echo $this->fetch('common/header-start.php');?>
<link href="//static.tudouyu.cn/AdminInspinia/2.7.1/css/plugins/iCheck/custom.css" rel="stylesheet">
<?php echo $this->fetch('common/header-end.php');?>

<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">SW+</h1>
        </div>
        <h3>欢迎来到SW+</h3>
        <p>使用swoole+easywechat搭建的php服务号管理后台.
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <!--<p>Login in. To see it in action.</p>-->
        <form class="m-t" role="form" action="/Admin/Login/index" method="post">
            <?php if ($error) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="账号" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="密码" required="">
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group has-feedback">
                        <input type="text" name="captcha" class="form-control" placeholder="验证码">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <img alt="点击换图" id="codeImg" style="cursor:pointer; width:100px;height: 40px;" src="/Admin/login/captcha" align="absmiddle">
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox i-checks">
                    <label> <input type="checkbox" name="isRemember"><i></i> 记住我</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">登录</button>
            <!--<a href="#"><small>忘记密码?</small></a>
            <p class="text-muted text-center"><small>还没有账号?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">创建一个账号</a>-->
        </form>
        <p class="m-t">
            <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
        </p>
    </div>
</div>

<?php echo $this->fetch('common/footer-start.php');?>
<!-- iCheck -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        //切换验证码
        $("#codeImg").click(function () {
            $(this).attr('src', '/Admin/login/captcha?=' + Math.random(0, 1));
        });
    });
</script>
<?php echo $this->fetch('common/footer-end.php');?>