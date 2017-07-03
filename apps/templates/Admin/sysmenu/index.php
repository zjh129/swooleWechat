<!-- 头部开始部分代码 -->
<?php echo $this->fetch('common/header-start.php');?>
<!-- jsTree style -->
<link href="//static.tudouyu.cn/AdminInspinia/2.7.1/css/plugins/jsTree/style.min.css" rel="stylesheet">
<!-- Gritter -->
<link href="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<!-- 头部结束部分代码 -->
<?php echo $this->fetch('common/header-end.php');?>
<body>
<div id="wrapper">
    <!-- 主体内容导航栏 -->
    <?php echo $this->fetch('common/main-left-navbar.php');?>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- 主体顶部导航 -->
        <?php echo $this->fetch('common/main-top-navbar.php');?>
        <!-- 主体内容 -->
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="col-md-2">
                                <select class="form-control" name="moduleType" id="moduleType">
                                    <?php foreach ($moduleTypeList as $moduleK => $moduleV){?>
                                        <option value="<?php echo $moduleK;?>" <?php echo $moduleType == $moduleK ? 'selected':''?>><?php echo $moduleV;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-outline btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="javascript:$('#form')[0].reset();"><i class="fa fa-plus"></i>添加菜单</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="nestable-menu">
                        <div class="col-md-4">
                            <select class="form-control" name="moduleType" id="moduleType">
                                <?php foreach ($moduleTypeList as $moduleK => $moduleV){?>
                                <option value="<?php echo $moduleK;?>" <?php echo $moduleType == $moduleK ? 'selected':''?>><?php echo $moduleV;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <button type="button" data-action="expand-all" class="btn btn-white btn-sm">全部展开</button>
                        <button type="button" data-action="collapse-all" class="btn btn-white btn-sm">全部收缩</button>
                        <button type="button" class="btn btn-outline btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="javascript:$('#form')[0].reset();"><i class="fa fa-plus"></i>添加菜单</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>菜单列表</h5>
                        </div>
                        <div class="ibox-content">

                            <p class="m-b-lg">
                                你可以通过拖拽来调整菜单所属层级和菜单顺序。
                            </p>

                            <div id="jstree1">
                                <ul>
                                    <li class="jstree-open">Admin theme
                                        <ul>
                                            <li>css
                                                <ul>
                                                    <li data-jstree='"type":"css"}'>
                                                        animate.cssasd
                                                        <button type="button" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-pencil"></i>编辑</button>
                                                        <button type="button" class="btn btn-outline btn-danger btn-xs pull-right"><i class="fa fa-trash-o"></i>删除</button>
                                                    </li>
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
                        <h4 class="modal-title">Modal title</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="form">
                            <input type="hidden" name="moduleType" id="moduleType" value="<?php echo $moduleType;?>">
                            <div class="form-group">
                                <label>菜单名称</label>
                                <input type="text" placeholder="输入菜单名称" class="form-control" name="menuName" id="menuName" required>
                            </div>
                            <div class="form-group">
                                <label>父级菜单</label>
                                <select class="form-control m-b __web-inspector-hide-shortcut__" name="account">
                                    <?php echo $menuTreeOption;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>访问链接</label>
                                <input type="text" placeholder="例如：/Admin/Index/index" class="form-control" name="url">
                            </div>
                            <div class="form-group">
                                <label>菜单图标样式</label>
                                <input type="text" placeholder="例如：fa fa-sitemap" class="form-control" name="iconClass" id="iconClass">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="javascript:$('#form').submit();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 主体页脚 -->
        <?php echo $this->fetch('common/main-footer.php');?>
    </div>
    <!-- 聊天窗口 -->
    <?php echo $this->fetch('common/small-chat-box.php');?>
    <!-- 右侧边栏 -->
    <?php echo $this->fetch('common/right-sidebar.php');?>
</div>
<!-- 文档页脚代码开始 -->
<?php echo $this->fetch('common/footer-start.php');?>
<!-- jsTree List -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/jsTree/jstree.min.js"></script>
<style>
    .jstree-open > .jstree-anchor > .fa-folder:before {
        content: "\f07c";
    }

    .jstree-default .jstree-icon.none {
        width: 0;
    }
</style>
<!-- Jquery Validate -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/validate/jquery.validate.min.js"></script>

<script>
    $(document).ready(function(){
        //模块选择
        $("#moduleType").on('change', function () {
            window.location.href = '<?php echo $this->currentUrl?>?moduleType='+$(this).val();
        });
        //jsTree
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
                password: {
                    required: true,
                    minlength: 3
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                min: {
                    required: true,
                    minlength: 6
                },
                max: {
                    required: true,
                    maxlength: 4
                }
            }
        });
    });
</script>
<!-- 文档页脚代码结束 -->
<?php echo $this->fetch('common/footer-end.php');?>