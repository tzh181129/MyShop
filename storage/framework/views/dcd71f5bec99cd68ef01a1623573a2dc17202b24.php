<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/javascript">

        $(function () {
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('getcart')); ?>",
                success: function (data) {
                    var obj =JSON.parse(data);
                    var str = "";
                    $.each(obj, function (i, n) {
                        str += "<div class='row'>";
                        str += "<div class='col-sm-5 col-sm-offset-2'><img src=" + n.image + " style='width:80%;height:40%'></div>";
                        str += "<div class='col-sm-5'><h3>" + n.name + "</h3><br/><h4>x"+n.num
                            + "</h4><br/><br/><h4 style='color:red'>￥" + n.price + "</h4><br/>" + "<div class='col-sm-3'><a href=<?php echo e(url('order')); ?>?id=" + obj[i]['id'] + ">" + "<h4>购买</h4></a></div><div class='col-sm-3'>" + "<a href=<?php echo e(url('delete')); ?>?id=" + obj[i]['id'] + ">" + "<h4>删除</h4></a></div>" + "</div></div>";
                    });
                    str += "";
                    $("#test").html(str);


                }
            });
        })

    </script>
</head>
<body>
<div class='container' style="position:absolute;top:15%;">
    <div id="test"></div>
    <br/>
    <h4 align="center">--------可能你还喜欢---------</h4>
    <?php $__currentLoopData = $maylike->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <a href="http://localhost:8000/product?id=<?php echo e($product->id); ?>">
                                <img src="<?php echo e($product->image); ?> " style="height:30%;"></a>
                            <a href="http://localhost:8000/product?id=<?php echo e($product->id); ?>">
                                <h3><?php echo e($product->name); ?></h3></a>
                            <?php if(session('business')==1): ?>
                                <a href="http://localhost:8000/myshop?shop_id=<?php echo e($product->shop_id); ?>">
                                    <?php else: ?>
                                        <a href="http://localhost:8000/shopshow?shop_id=<?php echo e($product->shop_id); ?>">
                                            <?php endif; ?>
                                            <?php echo e($product->shop_name); ?></a></a>
                                <p style="color:red;">￥<?php echo e($product->discount); ?></p>
                        </div> <!-- end caption -->
                    </div> <!-- end thumbnail -->
                </div> <!-- end col-md-3 -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> <!-- end row -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</body>


<?php echo $__env->make('common.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>