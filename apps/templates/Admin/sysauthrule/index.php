<!-- 头部开始部分代码 -->
<?php echo $this->fetch('common/header-start.php'); ?>
<!-- Gritter -->
<link href="//static.tudouyu.cn/jsTree/3.3.4/themes/default/style.min.css" rel="stylesheet">
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
                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-outline btn-primary btn-sm add"><i class="fa fa-plus"></i>新增</button>
                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-outline btn-primary btn-sm add"><i class="fa fa-pencil"></i>编辑</button>
                        <button type="button" class="btn btn-outline btn-primary btn-sm add"><i class="fa fa-trash-o"></i>删除</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>用户组列表</h5>
                        </div>
                        <div class="ibox-content">
                            <p class="m-b-lg">
                                你可以通过拖拽来调整权限所属层级及顺序。
                            </p>
                            <div id="jstree1">
                                <ul>
                                    <li class="jstree-open">Admin theme
                                        <ul>
                                            <li>css
                                                <ul>
                                                    <li data-jstree='"type":"css"}'>animate.css</li>
                                                    <li data-jstree='"type":"css"}'>bootstrap.css</li>
                                                    <li data-jstree='"type":"css"}'>style.css</li>
                                                </ul>
                                            </li>
                                            <li>email-templates
                                                <ul>
                                                    <li data-jstree='"type":"html"}'>action.html</li>
                                                    <li data-jstree='"type":"html"}'>alert.html</li>
                                                    <li data-jstree='"type":"html"}'>billing.html</li>
                                                </ul>
                                            </li>
                                            <li>fonts
                                                <ul>
                                                    <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.eot</li>
                                                    <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.svg</li>
                                                    <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.ttf</li>
                                                    <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.woff</li>
                                                </ul>
                                            </li>
                                            <li class="jstree-open">img
                                                <ul>
                                                    <li data-jstree='"type":"img"}'>profile_small.jpg</li>
                                                    <li data-jstree='"type":"img"}'>angular_logo.png</li>
                                                    <li class="text-navy" data-jstree='"type":"img"}'>html_logo.png</li>
                                                    <li class="text-navy" data-jstree='"type":"img"}'>mvc_logo.png</li>
                                                </ul>
                                            </li>
                                            <li class="jstree-open">js
                                                <ul>
                                                    <li data-jstree='"type":"js"}'>inspinia.js</li>
                                                    <li data-jstree='"type":"js"}'>bootstrap.js</li>
                                                    <li data-jstree='"type":"js"}'>jquery-2.1.1.js</li>
                                                    <li data-jstree='"type":"js"}'>jquery-ui.custom.min.js</li>
                                                    <li  class="text-navy" data-jstree='"type":"js"}'>jquery-ui-1.10.4.min.js</li>
                                                </ul>
                                            </li>
                                            <li data-jstree='"type":"html"}'> affix.html</li>
                                            <li data-jstree='"type":"html"}'> dashboard.html</li>
                                            <li data-jstree='"type":"html"}'> buttons.html</li>
                                            <li data-jstree='"type":"html"}'> calendar.html</li>
                                            <li data-jstree='"type":"html"}'> contacts.html</li>
                                            <li data-jstree='"type":"html"}'> css_animation.html</li>
                                            <li  class="text-navy" data-jstree='"type":"html"}'> flot_chart.html</li>
                                            <li  class="text-navy" data-jstree='"type":"html"}'> google_maps.html</li>
                                            <li data-jstree='"type":"html"}'> icons.html</li>
                                            <li data-jstree='"type":"html"}'> invoice.html</li>
                                            <li data-jstree='"type":"html"}'> login.html</li>
                                            <li data-jstree='"type":"html"}'> mailbox.html</li>
                                            <li data-jstree='"type":"html"}'> profile.html</li>
                                            <li  class="text-navy" data-jstree='"type":"html"}'> register.html</li>
                                            <li data-jstree='"type":"html"}'> timeline.html</li>
                                            <li data-jstree='"type":"html"}'> video.html</li>
                                            <li data-jstree='"type":"html"}'> widgets.html</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">添加用户组</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="form" action="/admin/SysUserGroup/save">
                            <input type="hidden" name="groupId" id="groupId" value="0">
                            <div class="form-group">
                                <label>用户组名称</label>
                                <input type="text" placeholder="输入用户组名称" class="form-control" name="groupName" id="groupName" required>
                            </div>
                            <div class="form-group">
                                <label>父级分组</label>
                                <select class="form-control m-b __web-inspector-hide-shortcut__" name="parentId">
                                    <option value="0">顶级分组</option>
                                    <?php //echo $treeOption; ?>
                                </select>
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

<script>
    $(document).ready(function(){
        $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });
        //表单验证
        $("#form").validate({
            rules: {
                groupName:{
                    required: true,
                },
            },
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type:'post',
                    dataType:'json',
                    success:function(data) {
                        showToastr(data, true);
                    }
                });
            }
        });
        //弹窗
        $(".add").on('click', function () {
            $("#form")[0].reset();
            $("#form input[name='groupId']").val(0);
            $(".modal-title").html('添加用户组');
        });
        $(".edit").on('click', function () {
            $(".modal-title").html('编辑用户组');
            $.ajax({
                type: "get",
                url: "/Admin/SysUserGroup/get",
                data: {
                    'id' : $(this).parents("li").attr('data-id'),
                },
                datatype: "json",
                success: function (data) {
                    $("#form input[name='groupId']").val(data.data.groupId);
                    $("#form input[name='groupName']").val(data.data.groupName);
                    $("#form select[name='parentGroupId']").val(data.data.parentGroupId);
                }
            });
        });
        $(".del").on('click', function () {
            var id = $(this).parents("li").attr('data-id');
            $.confirm({
                title: '你确定删除么？',
                content: '删除后将无法恢复',
                buttons: {
                    '确定': function () {
                        $.ajax({
                            type: "post",
                            url: "/Admin/SysUserGroup/del",
                            data: {
                                'id' : id,
                            },
                            datatype: "json",
                            success: function (data) {
                                showToastr(data, true);
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