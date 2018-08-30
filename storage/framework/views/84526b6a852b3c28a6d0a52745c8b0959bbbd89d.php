<div class="container " style="position: absolute;top:15%;">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-5">
            <?php if(Session::has('message')): ?>
                <h3 style="color:red;"><?php echo e(Session::get('message')); ?></h3>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo e($messageRes['array']['image']); ?>" alt="product" class="img-responsive" style="width:95%;height:38%;">
        </div>
        <div class="col-sm-8">
            <h3 style="color:red;">￥<?php echo e($messageRes['array']['discount']); ?></h3>
            <p>原价:<s>￥<?php echo e($messageRes['array']['price']); ?></s></p>
            <h4><?php echo e($messageRes['array']['name']); ?></h4>
            <p><?php echo e($messageRes['array']['title']); ?></p>
            <p><?php echo e($messageRes['array']['description']); ?></p>

            <div class="col-sm-2">
                <a href="<?php echo e(url('shopshow')); ?>?shop_id=<?php echo e($messageRes['array']['shop_id']); ?>" class="btn btn-primary " role="button">店铺</a></div>
                <div class="col-sm-2">
           <?php if($messageRes['arr']['already']==0): ?>
                <form name="form" action="<?php echo e(url('collectionpost')); ?>" method="post">
                    <input type="hidden" name="product_id" value="<?php echo e($messageRes['array']['id']); ?>">
                    <input type="hidden" name="shop_id" value="<?php echo e($messageRes['array']['shop_id']); ?>">
                    <input type="hidden" name="name" value="<?php echo e($messageRes['array']['name']); ?>">
                    <input type="hidden" name="collection" value="<?php echo e($messageRes['array']['collection']); ?>">
                    <input type="hidden" name="price" value="<?php echo e($messageRes['array']['price']); ?>">
                    <input type="hidden" name="discount" value="<?php echo e($messageRes['array']['discount']); ?>">
                    <input type="hidden" name="title" value="<?php echo e($messageRes['array']['title']); ?>">
                    <input type="hidden" name="image" value="<?php echo e($messageRes['array']['image']); ?>">
                    <input type="hidden" name="description" value="<?php echo e($messageRes['array']['collection']); ?>">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <button id="submit" class="btn btn-primary ">收藏</button>
                </form>
            <?php else: ?>
                    <p style="margin-top:10%;">已收藏</p>
            <?php endif; ?>
                </div>
            <div class="col-sm-3">
            <form name="form" action="" method="post">
                <input type="hidden" name="id" value="<?php echo e($messageRes['array']['id']); ?>">
                <input type="hidden" name="user_id" value="<?php echo e($messageRes['array']['user_id']); ?>">
                <input type="hidden" name="shop_id" value="<?php echo e($messageRes['array']['shop_id']); ?>">
                <input type="hidden" name="shop_name" value="<?php echo e($messageRes['array']['shop_name']); ?>">
                <input type="hidden" name="name" value="<?php echo e($messageRes['array']['name']); ?>">
                <input type="hidden" name="price" value="<?php echo e($messageRes['array']['price']); ?>">
                <input type="hidden" name="image" value="<?php echo e($messageRes['array']['image']); ?>">
                <input type="hidden" name="description" value="<?php echo e($messageRes['array']['description']); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <button id="submit" class="btn btn-primary ">加入购物车</button>
            </form>
            </div>
            <div class="col-sm-3">
            <form name="form" action="<?php echo e(url('form')); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo e($messageRes['array']['id']); ?>">
                <input type="hidden" name="shop_id" value="<?php echo e($messageRes['array']['shop_id']); ?>">
                <input type="hidden" name="shop_name" value="<?php echo e($messageRes['array']['shop_name']); ?>">
                <input type="hidden" name="name" value="<?php echo e($messageRes['array']['name']); ?>">
                <input type="hidden" name="title" value="<?php echo e($messageRes['array']['title']); ?>">
                <input type="hidden" name="price" value="<?php echo e($messageRes['array']['price']); ?>">
                <input type="hidden" name="discount" value="<?php echo e($messageRes['array']['discount']); ?>">
                <input type="hidden" name="address" value="<?php echo e($messageRes['array']['address']); ?>">
                <input type="hidden" name="image" value="<?php echo e($messageRes['array']['image']); ?>">
                <input type="hidden" name="color" value="<?php echo e($messageRes['array']['color']); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <button id="submit" class="btn btn-primary " >立即购买</button>
            </form>
            </div>

        </div>
    </div>
  <h4 align="center">--------推荐---------</h4>
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


<?php echo $__env->make('common.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>