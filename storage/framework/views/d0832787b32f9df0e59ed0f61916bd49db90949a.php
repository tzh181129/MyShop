<div class="container " style="position: absolute;top:15%;">
    <div class="col-sm-7 col-sm-offset-5">
        <?php if(Session::has('message')): ?>
            <p style="color:red;"><?php echo e(Session::get('message')); ?></p>
        <?php endif; ?>
    </div>
    <?php $__currentLoopData = $informationRes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $information): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row" style="margin-top:2%;">
            <div class="col-sm-4 col-sm-offset-2"><img src="<?php echo e($information->register_image); ?>" class="img-circle"
                                                       style="width:30%;height:15%;"></div>
            <div class="col-sm-4"><br/><h4><?php echo e($information->register_name); ?></h4>
                <p style="color:red;">
                    <?php if($information->business==1): ?>
                        商家
                    <?php endif; ?></p>
            </div>
            <div class="col-sm-2"><br/><br/><br/><a href="<?php echo e(url('update')); ?>">修改密码</a></div>
        </div>
        <div class="row " style="margin-top:5%;">
            <div class="col-sm-3 col-sm-offset-4"><p>我的邮箱</p></div>
            <div class="col-sm-3"><?php echo e($information->register_email); ?></div>
            <div class="col-sm-3 col-sm-offset-4"><p>我的电话号码</p></div>
            <div class="col-sm-3"><?php echo e($information->register_phone); ?></div>
            <div class="col-sm-3 col-sm-offset-4"><p>我的密码</p></div>
            <div class="col-sm-3"><?php echo e($information->register_pwd); ?></div>
        </div>
        <div class="row " style="margin-top:5%;">
            <div class="col-sm-3 col-sm-offset-6">
                <?php if($information->business==1): ?>
                    <a href="<?php echo e(url('myshop')); ?>">我的店铺</a>
                <?php endif; ?>
            </div>
            <div class="col-sm-3 col-sm-offset-6">
                <?php if($information->business==1): ?>
                    <a href="<?php echo e(url('released')); ?>?user_id=<?php echo e($information->id); ?>">已发布的商品</a>
                <?php endif; ?>
            </div>

        </div>
        <div class="row" style="margin-top:5%;">
            <div class="col-sm-2  col-sm-offset-3"><a href="<?php echo e(url('collection')); ?>">我的收藏</a></div>
            <div class="col-sm-2"><a href="<?php echo e(url('myfollow')); ?>">我的关注</a></div>
            <div class="col-sm-2"><a href="<?php echo e(url('order')); ?>">我的订单</a></div>
            <div class="col-sm-2"><a href="<?php echo e(url('evaluateshow')); ?>">我的评价</a></div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <br/>
    <div class="row">
        <div class="login_action col-sm-4  col-sm-offset-5">
            <a role="button" class="btn btn-primary  btn-block">退出登录</a>
        </div>
    </div>
</div>
</body>
</html>

<?php echo $__env->make('common.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>