<html>
<head>
    <title>哈哈网主页</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript">

        $(function () {
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('cartcount')); ?>",
                success: function (data) {
                    var html="购物车("+data+")";
                    $("#text").html(html);
                }
            });
        })

    </script>

</head>
<body>
<?php $__env->startSection('content'); ?>
<nav class="navbar navbar-default" style="background:#d6d8db;font-weight: bold;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <img src="image/p.gif" style="width:50px; height:50px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo e(url('shop')); ?>">商品总寨 <span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo e(url('cart')); ?>"><p id="text"></p></a></li>
                <li><a href="<?php echo e(url('information')); ?>">个人中心</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span>
                               <?php if(Session::has('register_name')): ?>
                                <?php echo e(Session::get('register_name')); ?>

                            <?php endif; ?>
                        </span> <span  class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="<?php echo e(url('loginout')); ?>">退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
    <?php echo $__env->yieldSection(); ?>
</body>
</html>