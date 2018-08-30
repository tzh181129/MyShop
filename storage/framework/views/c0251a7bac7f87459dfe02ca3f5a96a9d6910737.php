<div class="container " style="position: absolute;top:15%;">
    <div class="row">
        <form action="<?php echo e(url('search')); ?>" method="post" class="form-group">
            <div class="col-sm-5 col-sm-offset-4">
                <div class="input-group ">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="text" class="form-control" name="name" placeholder="iphone">
                    <p class="input-group-addon" style="background: white;border:0;">
                        <button id="submit" class="btn" style="color:black;margin-top:-10%;">搜索</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <ul class="nav nav-pills  col-sm-offset-4">

        <li><a href="<?php echo e(url('shop')); ?>">综合排序</a></li>
        <li><a href="<?php echo e(url('descend')); ?>?name=asc">价格升序</a></li>
        <li><a href="<?php echo e(url('descend')); ?>?name=desc">价格降序</a></li>
        <li><a href="<?php echo e(url('screen')); ?>">筛选</a></li>
    </ul>
    <div class="col-sm-7 col-sm-offset-5">
        <?php if(Session::has('message')): ?>
            <p style="color:red;"><?php echo e(Session::get('message')); ?></p>
        <?php endif; ?>
    </div>
    <br/>
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
                                <a href="http://localhost:8000/myshop?shop_id=<?php echo e($product->shop_id); ?>"
                                   style="text-decoration:none">
                                    <?php else: ?>
                                        <a href="http://localhost:8000/shopshow?shop_id=<?php echo e($product->shop_id); ?>"
                                           style="text-decoration:none">
                                            <?php endif; ?>
                                            <?php echo e($product->shop_name); ?></a></a>
                                <p style="color:red;">￥<?php echo e($product->discount); ?></p>
                        </div> <!-- end caption -->
                    </div> <!-- end thumbnail -->
                </div> <!-- end col-md-3 -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> <!-- end row -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <div class="row" style="margin-top:1%;">
        <div class="col-sm-10 col-sm-offset-2" style="background: #d6d8db;">
            <h4 align="center">于2018年8月25日由哈哈哈设计完成</h4>
        </div>
    </div>
</div>



<?php echo $__env->make('common.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>