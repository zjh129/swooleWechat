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
                        <button type="button" class="btn btn-outline btn-primary btn-sm syncOnline"><i class="fa fa-download"></i>同步线上模板</button>
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
        <!-- 用户分组编辑model -->
        <div class="modal inmodal" id="groupModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">设置使用场景</h4>
                    </div>
                    <div class="modal-body">
                        <form role="setKeyform" id="setKeyform" action="/Admin/WxTemplate/setKey">
                            <input type="hidden" name="ids[]" id="ids" value="0">
                            <div class="form-group">
                                <label>使用场景</label>
                                <select class="form-control m-b __web-inspector-hide-shortcut__" name="groupId" id="groupId" required>
                                    <option value="">不设置</option>

                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="javascript:$('#groupform').submit();">保存</button>
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
                url : '/Admin/WxTemplate/getPageList',
                type : 'POST',
            },
            columns:[
                {data: "templateId",title:"序号",orderable:false,searchable:true,},
                {data: "key",title:"使用KEY",orderable:false,searchable:true,},
                {data: "keyName",title:"使用场景",orderable:false,searchable:true,},
                {data: "title",title: "模板标题",orderable:false, searchable:true,},
                {data: "wxTemplateId",title: "微信模板ID",orderable:false, searchable:true,},
                {data: "primaryIndustry",title: "一级行业",orderable:false, searchable:true,},
                {data: "deputyIndustry",title: "二级行业",orderable:false, searchable:true,},
                {data: "content",title: "模板内容",orderable:false, searchable:false,},
                {data: "example",title: "模板示例",orderable:false, searchable:false,},
                {
                    data:null, title: "操作", orderable:false, searchable:false,
                    createdCell: function (td, cellData, rowData, row, col) {
                        var html = '';
                        html += '<button type="button" class="btn btn-outline btn-primary btn-xs setGroup" data-toggle="modal" data-target="#groupModal"><i class="fa fa-group"></i>设置分组</button>';
                        html += '<button type="button" class="btn btn-outline btn-primary btn-xs setRemark" data-toggle="modal" data-target="#remarkModal"><i class="fa fa-pencil"></i>设置备注</button>';
                        html += '<button type="button" class="btn btn-outline btn-primary btn-xs setTag" data-toggle="modal" data-target="#tagModal"><i class="fa fa-pencil"></i>设置标签</button>';
                        if (cellData.isBlock == 1){
                            html += '<button type="button" setBlock=0 class="btn btn-outline btn-success btn-xs setBlock"><i class="fa fa-lock"></i>解锁</button>';
                        }else{
                            html += '<button type="button" setBlock=1 class="btn btn-outline btn-danger btn-xs setBlock"><i class="fa fa-unlock"></i>拉黑</button>';
                        }
                        $(td).html(html);
                    }
                },
            ],
        });
        //设置分组
        var groupValidator = $("#groupform").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type:'post',
                    dataType:'json',
                    success:function(data) {
                        showToastr(data);
                        if (data.status == 'success'){
                            $('#groupModal').modal('hide');
                            table.ajax.reload();
                        }
                    }
                });
            }
        });
        $("#tableBox").on('click', '.setGroup', function () {
            //清除错误提示
            groupValidator.resetForm();
            $.ajax({
                type: "get",
                url: "/Admin/WxTemplate/get",
                data: {
                    'id' : $(this).parents("tr").attr('id'),
                },
                datatype: "json",
                success: function (data) {
                    $("#groupform input[name='ids[]']").val(data.data.userId);
                    //载入用户组选项
                    loadGroupIdOption(data.data.groupId);
                }
            });
        });
        //同步所有用户信息
        $(".syncOnline").on('click', function(){
            $.confirm({
                title: "同步所有用户数据",
                content: "此同步过程可能比较耗时",
                buttons: {
                    '确定': function () {
                        $.ajax({
                            type: "post",
                            url: "/Admin/WxTemplate/syncOnline",
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