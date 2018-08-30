<html>
<head>
    <title>已发布的商品</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    .a{
        position:absolute;
        top:15%;
    }
</style>
</head>
<body>
<div class="container a">
    <?php $__currentLoopData = $messageRes->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <a href="http://localhost:8000/product?id=<?php echo e($product->id); ?>">
                                <img src="<?php echo e($product->image); ?> " style="height:30%;"></a>
                            <a href="http://localhost:8000/product?id=<?php echo e($product->id); ?>" style="text-decoration:none">
                                <h3><?php echo e($product->name); ?></h3></a>
                            <?php if(session('business')==1): ?>
                                <a href="http://localhost:8000/myshop?shop_id=<?php echo e($product->shop_id); ?>" style="text-decoration:none">
                                    <?php else: ?>
                                        <a href="http://localhost:8000/shopshow?shop_id=<?php echo e($product->shop_id); ?>" style="text-decoration:none">
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
</html>
<?php echo $__env->make('common.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>