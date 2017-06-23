<!-- 头部开始部分代码 -->
<?php echo $this->fetch('common/header-start.php');?>
<!-- Toastr style -->
<link href="//static.tudouyu.cn/AdminInspinia/2.7.1/css/plugins/toastr/toastr.min.css" rel="stylesheet">

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
        <div class="wrapper wrapper-content">
            <!-- Info boxes -->
            <div class="row">
                <?php foreach ($systemInfo as $k => $v): ?>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo $v['name'] ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $v['value'] ?></h1>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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

<!-- Flot -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/flot/jquery.flot.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/peity/jquery.peity.min.js"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/inspinia.js?v=2.0"></script>
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/sparkline/jquery.sparkline.min.js"></script>


<!-- ChartJS-->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="//static.tudouyu.cn/AdminInspinia/2.7.1/js/plugins/toastr/toastr.min.js"></script>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

        }, 1300);
        var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [300,50,100],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        } ;
        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };
        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        var doughnutData = {
            labels: ["App","Software","Laptop" ],
            datasets: [{
                data: [70,27,85],
                backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
            }]
        };
        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            }
        };
        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

    });
</script>
    <!-- 文档页脚代码结束 -->
<?php echo $this->fetch('common/footer-end.php');?>