<!-- Mainly scripts -->
<script src="//static.tudouyu.cn/jQuery/jquery-3.2.1.min.js"></script>
<script src="//static.tudouyu.cn/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<?php if (strpos($this->currentUrl, '/admin/login') === false){?>
<!-- Custom and plugin javascript -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/inspinia.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/pace/pace.min.js"></script>
<?php }?>
<!-- Toastr script -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/toastr/toastr.min.js"></script>
<script>
    toastr.options = {
        "positionClass": "toast-top-center",
    };
    function showToastr(data) {
        isReload = arguments[1] ? arguments[1] : false;
        switch (data.status){
            case 'success':
                toastr.success(data.message, data.title);
                break;
            case 'error':
                toastr.error(data.message, data.title);
                break;
            case 'info':
                toastr.info(data.message, data.title);
                break;
            default:
                toastr.warning(data.message, data.title);
                break;
        }
        if (isReload && data.redirectUrl){
            setTimeout(function(){
                window.location.href = data.redirectUrl;
            }, 1000);
        }
    }
</script>
<!-- Jquery Validate -->
<script src="//static.tudouyu.cn/validate/1.16.0/jquery.validate.min.js"></script>
<script src="//static.tudouyu.cn/validate/1.16.0/messages_zh.js"></script>
<!-- Jquery Form -->
<script src="//static.tudouyu.cn/jquery-form/3.51.0/jquery.form.min.js"></script>
<!-- Jquery-confirm -->
<script src="//static.tudouyu.cn/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>
