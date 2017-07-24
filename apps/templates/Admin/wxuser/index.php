<!-- 头部开始部分代码 -->
<?php echo $this->fetch('common/header-start.php'); ?>
<!-- Gritter -->
<link href="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<!-- jsTree -->
<link href="//static.tudouyu.cn/jsTree/3.3.4/themes/default/style.min.css" rel="stylesheet">
<!-- dataTables-->
<link rel="stylesheet" type="text/css" href="//static.tudouyu.cn/AdminInspinia/2.7.1/css/plugins/dataTables/datatables.min.css">
<!-- 头部结束部分代码 -->
<?php echo $this->fetch('common/header-end.php'); ?>
<body>
<div id="wrapper">
    <!-- 主体内容导航栏 -->
    <?php echo $this->fetch('common/main-left-navbar.php'); ?>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- 主体顶部导航 -->
        <?php echo $this->fetch('common/main-top-navbar.php'); ?>
        <!-- 主体内容 -->
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-md-4">
                    <div id="nestable-menu">
                        <button type="button" class="btn btn-outline btn-primary btn-sm add" data-toggle="modal" data-target="#groupModal"><i class="fa fa-group"></i>设置用户组</button>
                        <button type="button" class="btn btn-outline btn-primary btn-sm add" data-toggle="modal" data-target="#userModal"><i class="fa fa-lock"></i>拉黑用户</button>
                        <button type="button" class="btn btn-outline btn-primary btn-sm add" data-toggle="modal" data-target="#userModal"><i class="fa fa-unlock"></i>取消拉黑用户</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>用户列表</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover" id="tableBox">
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 用户编辑model -->
        <div class="modal inmodal" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">添加用户</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="form" action="/Admin/SysUser/save">
                            <input type="hidden" name="id" id="id" value="0">
                            <div class="form-group">
                                <label>用户账号</label>
                                <input type="text" class="form-control" name="account" id="account" required>
                            </div>
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码" value="">
                                <span class="help-block m-b-none help-password">如不设置则留空</span>
                            </div>
                            <div class="form-group">
                                <div class="pwstrength_viewport_progress"></div>
                            </div>
                            <div class="form-group">
                                <label>用户名称</label>
                                <input type="text" placeholder="输入用户名称" class="form-control" name="userName" id="userName" required>
                            </div>
                            <div class="form-group">
                                <label>所属用户组</label>
                                <select class="form-control m-b __web-inspector-hide-shortcut__" name="groupId" id="groupId" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>邮箱</label>
                                <input type="email" placeholder="输入邮箱" class="form-control" name="email" id="email">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="javascript:$('#form').submit();">保存</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 权限编辑 -->
        <div class="modal inmodal" id="ruleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">权限控制</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="ruleform" action="/Admin/SysUser/saveRule">
                            <input type="hidden" name="id" id="id" value="0">
                            <div id="jstree">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="javascript:$('#ruleform').submit();">保存</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 主体页脚 -->
        <?php echo $this->fetch('common/main-footer.php'); ?>
    </div>
    <!-- 聊天窗口 -->
    <?php echo $this->fetch('common/small-chat-box.php'); ?>
    <!-- 右侧边栏 -->
    <?php echo $this->fetch('common/right-sidebar.php'); ?>
</div>
<!-- 文档页脚代码开始 -->
<?php echo $this->fetch('common/footer-start.php'); ?>
<!-- jsTree -->
<script src="//static.tudouyu.cn/jsTree/3.3.4/jstree.min.js"></script>
<!-- dataTables -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/dataTables/datatables.min.js" type="text/javascript"></script>
<!-- Password meter -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/pwstrength/pwstrength-bootstrap.min.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/pwstrength/zxcvbn.js"></script>
<script>
    //载入树结构select的option的html
    function loadGroupIdOption() {
        var secId = arguments[0] ? arguments[0] : 0;
        $.ajax({
            type: "get",
            url: "/Admin/WxUserGroup/getTreeOption",
            data: {
                'secId' : secId,
            },
            success: function (data) {
                $("#form select[name='groupId']").html(data);
            }
        });
    }
    $(document).ready(function(){
        //密码强度
        var options1 = {};
        options1.ui = {
            container: "#form",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pwstrength_viewport_progress"
            }
        };
        options1.common = {
            debug: false
        };
        $('#password').pwstrength(options1);
        //列表
        var table = $('#tableBox').DataTable({
            language: {
                url: '//static.tudouyu.cn/datatables/language/zh-CN.json'
            },
            pageLength: 10,
            responsive: true,
            sClass:'text-center',
            dom: '<"html5buttons"B>lTfgtip',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            bStateSave: true,
            processing: true,
            //开启服务器模式
            serverSide: true,
            //数据来源（包括处理分页，排序，过滤） ，即url，action，接口，等等
            ajax: {
                url : '/Admin/WxUser/getPageList',
                type : 'POST',
            },
            columns:[
                {data: "userId",title:"用户ID",orderable:false,searchable:true,},
                {
                    data: "headimgurl",title:"用户头像",orderable:false,searchable:true,
                    createdCell: function (td, cellData, rowData, row, col) {
                        var html = '';
                        if (cellData){
                            html = '<img src="' + cellData + '" class="img-circle img-sm">';
                        }
                        $(td).html(html);
                    }
                },
                {data: "openId",title:"openId",orderable:false,searchable:true,},
                {data: "unionId",title:"unionId",orderable:false,searchable:true,},
                {data: "nickName",title: "用户昵称",orderable:false, searchable:true,},
                {data: "groupName",title: "用户组",orderable:false, searchable:true,},
                {data: "sex",title: "性别",orderable:false, searchable:true,},
                {data: "country",title: "国家",orderable:false, searchable:false,},
                {data: "province",title: "省份",orderable:false, searchable:false,},
                {data: "city",title: "城市",orderable:false, searchable:false,},
                {
                    data: "tagidList",title: "标签",orderable:false, searchable:false,
                    createdCell: function (td, cellData, rowData, row, col) {
                        var html = '<ul class="tag-list" style="padding: 0">';
                        if (cellData != '[]'){
                            $.each(cellData, function(i, n){
                                html += '<li><a href="#">n</a></li>';
                            });
                        }
                        html += '</ul>';
                        $(td).html(html);
                    }
                },
                {data: "remark",title: "备注",orderable:false, searchable:false,},
                {
                    data: 'isBlock',title: "状态",orderable:false, searchable:true,
                    createdCell: function (td, cellData, rowData, row, col) {
                        var html = '';
                        if (cellData == 1){
                            html = '<span class="label label-danger">拉黑</span>';
                        }else{
                            html = '<span class="label label-primary">正常</span>';
                        }
                        $(td).html(html);
                    }
                },
                {data: "subscribeTime",title: "关注时间",searchable : false,orderable:false, searchable:false,},
                {
                    data:null, title: "操作", orderable:false, searchable:false,
                    createdCell: function (td, cellData, rowData, row, col) {
                        var html = '';
                        html += '<button type="button" class="btn btn-outline btn-primary btn-xs edit" data-toggle="modal" data-target="#userModal"><i class="fa fa-group"></i>设置分组</button>';
                        html += '<button type="button" class="btn btn-outline btn-primary btn-xs edit" data-toggle="modal" data-target="#userModal"><i class="fa fa-pencil"></i>设置备注</button>';
                        html += '<button type="button" class="btn btn-outline btn-primary btn-xs rule" data-toggle="modal" data-target="#ruleModal"><i class="fa fa-pencil"></i>设置标签</button>';
                        if (cellData.isBlock == 1){
                            html += '<button type="button" setBlock=0 class="btn btn-outline btn-success btn-xs del"><i class="fa fa-lock"></i>解锁</button>';
                        }else{
                            html += '<button type="button" setBlock=1 class="btn btn-outline btn-danger btn-xs del"><i class="fa fa-unlock"></i>拉黑</button>';
                        }
                        $(td).html(html);
                    }
                },
            ],
        });
        //表单验证
        var validator = $("#form").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type:'post',
                    dataType:'json',
                    success:function(data) {
                        showToastr(data);
                        if (data.status == 'success'){
                            $('#userModal').modal('hide');
                            table.ajax.reload();
                        }
                    }
                });
            }
        });
        //弹窗
        $(".add").on('click', function () {
            //载入用户组选项
            loadGroupIdOption();
            //清除错误提示
            validator.resetForm();

            $("#form")[0].reset();
            $("#form input[name='id']").val(0);
            $("#form input[name='account']").attr('readonly', false);
            $(".help-password").css("display","block");
            $("#form input[name='password']").attr('required', true);
            $(".modal-title").html('添加用户');
        });
        $("#tableBox").on('click', '.edit', function () {
            //清除错误提示
            validator.resetForm();
            $(".help-password").css("display","none");
            $("#form input[name='account']").attr('readonly', true);
            $("#form input[name='password']").attr('required', false);
            $(".modal-title").html('编辑用户');
            $.ajax({
                type: "get",
                url: "/Admin/SysUser/get",
                data: {
                    'id' : $(this).parents("tr").attr('id'),
                },
                datatype: "json",
                success: function (data) {
                    $("#form input[name='id']").val(data.data.id);
                    $("#form input[name='userName']").val(data.data.userName);
                    $("#form input[name='account']").val(data.data.account);
                    $("#form input[name='email']").val(data.data.email);
                    //载入用户组选项
                    loadGroupIdOption(data.data.groupId);
                }
            });
        });
        $("#tableBox").on('click', '.del', function () {
            var id = $(this).parents("tr").attr('id');
            var setStatus = $(this).attr('setStatus');
            if (setStatus == 1){
                var title = '你确定禁用该账号么？';
                var content = '禁用后该账号将无法正常登录';
            }else{
                var title = '你确定开启该账号么？';
                var content = '开启后该账号可以正常访问';
            }

            $.confirm({
                title: title,
                content: content,
                buttons: {
                    '确定': function () {
                        $.ajax({
                            type: "post",
                            url: "/Admin/SysUser/setStatus",
                            data: {
                                'id' : id,
                                'status' : setStatus
                            },
                            datatype: "json",
                            success: function (data) {
                                showToastr(data);
                                if (data.status == 'success'){
                                    table.ajax.reload();
                                }
                            }
                        });
                    },
                    '取消': function () {
                    },
                }
            });
        });
    });
</script>
<!-- 文档页脚代码结束 -->
<?php echo $this->fetch('common/footer-end.php'); ?>