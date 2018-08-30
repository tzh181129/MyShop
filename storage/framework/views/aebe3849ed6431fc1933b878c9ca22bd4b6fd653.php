<html>
<head>
    <title>我的评价</title>
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
<body>
<div class="container a">
    <?php $__currentLoopData = $messageRes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="row" style="margin-top:2%;">
            <div class="col-sm-4 col-sm-offset-3">
                <?php if($message->evaluate_text==null): ?>
                    <h4>此用户未填写评价</h4>
                <?php else: ?>
                    <h4><?php echo e($message->evaluate_text); ?></h4>
                <?php endif; ?>
            </div>
            <div class="col-sm-4"><h4><?php echo e($message->evaluate_time); ?></h4></div>
        </div>
    <hr>
    <?php if($message->review_time!=0): ?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <div class="col-sm-12" >
                <?php if(floor((strtotime($message->review_time)-strtotime($message->evaluate_time))/86400)==0): ?>
                <h4 style="color:red;">用户于一天内发表追评</h4>
                    <?php else: ?>
                    <h4 style="color:red;">用户于<?php echo e(floor((strtotime($message->review_time)-strtotime($message->evaluate_time))/86400)); ?>天后追评</h4>
                    <?php endif; ?>
            </div>
            <div class="col-sm-4">
            <h4><?php echo e($message->review_text); ?></h4>
            </div>
        </div>
    </div>

        <?php endif; ?>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-3">
                <img src="<?php echo e($message->image); ?>" style="width:40%;height:20%;">
            </div>
            <div class="col-sm-4">
                <p>商品名：<?php echo e($message->name); ?></p>
                <p>颜色分类：<?php echo e($message->color); ?></p>
                <p style="color:red;margin-top:15%;">￥<?php echo e($message->discount); ?></p>
            </div>
        </div>
    <hr>
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4">
                <?php if($message->evaluate_text==null && $message->review_time==0): ?>
                <h4><a href="http://localhost:8000/review?id=<?php echo e($message->id); ?>" style="margin-top:15%;text-decoration: none;">写追评</a> </h4>
                    <?php endif; ?>
            </div>
            <div class="col-sm-3">
                <h4><a href="http://localhost:8000/evaluatedel?id=<?php echo e($message->id); ?>" style="margin-top:15%;text-decoration: none;">删除评价</a> </h4>
            </div>
        </div>
<hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</body>
</html>