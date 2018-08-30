<html>
<head>
    <title>店铺订单</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .a {
            position: absolute;
            top: 10%;
        }
    </style>
</head>
<body >
<div class="container a">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-5">
            <?php if(Session::has('message')): ?>
                <h3 style="color:red;"><?php echo e(Session::get('message')); ?></h3>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-sm-offset-3"><a href="<?php echo e(url('delivery')); ?>">未发货</a></div>
        <div class="col-sm-3"><a href="<?php echo e(url('shopalready')); ?>">已发货</a></div>
        <div class="col-sm-3"><a href="<?php echo e(url('shopfinish')); ?>">已完成</a></div>
    </div>
    <div class="row">

        <?php $__currentLoopData = $messageRes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-2" ><a href="http://localhost:8000/myshop?shop_id=<?php echo e($message->shop_id); ?>"> <p style="color:black;"><?php echo e($message->shop_name); ?><span class="glyphicon glyphicon-chevron-right" style="color:#636b6f;" aria-hidden="true"></span></p></a>
                </div>
                <div class="col-sm-6" align="center" style="color:indianred;">买家已确认</div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-2">
                    <a href="http://localhost:8000/product?id=<?php echo e($message->product_id); ?>">
                        <img src="<?php echo e($message->image); ?>" style="height:30%;width:60%;"></a>
                </div>
                <div class="col-sm-6">
                    <h4><?php echo e($message->name); ?></h4><?php echo e($message->title); ?><br/><br/>
                    <br/><br/>
                    <p style="color:red;">购买数量:<?php echo e($message->num); ?>总价:￥<?php echo e($message->total); ?></p>

                    <?php if($message->finish_time!=0): ?>
                        <p>已收货 &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo e(url('orderdelete')); ?>?id=<?php echo e($message->id); ?>" > 删除订单</a></p>
                    <?php else: ?>
                        <form name="form" method="post" action="<?php echo e(url('myorder')); ?>">
                            <input type="hidden" name="id" value="<?php echo e($message->id); ?>">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <button id="submit">确认收货</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>