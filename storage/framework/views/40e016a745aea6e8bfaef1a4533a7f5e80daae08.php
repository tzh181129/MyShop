<html>
<head>
    <title><?php echo e($data->shop_name); ?></title>
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
    <div id="test"></div>
    <div class="row">
        <div class="col-sm-11 col-sm-offset-1" style="background:#FFFAFA">
            <div class="col-sm-4 col-sm-offset-2">
                <img src="<?php echo e($data->image); ?>" alt="product" class="img-responsive">
            </div>
            <div class="col-sm-4">
                <h4><?php echo e($data->name); ?></h4>
                <p><?php echo e($data->description); ?></p>
                <br/><br/>
                <h3 style="color:red;">￥<?php echo e($data->discount); ?></h3>
            </div>
            <div class="col-sm-4 col-sm-offset-5" style="margin-top:1%;">
                <form name="form" action="<?php echo e(url('#')); ?>" method="post">
                    <input type="hidden" name="user_image" value="<?php echo e($dta['user_image']); ?>">
                    <input type="hidden" name="shop_image" value="<?php echo e($dta['shop_image']); ?>">
                    <input type="hidden" name="shop_id" value="<?php echo e($data->shop_id); ?>">
                    <input type="hidden" name="name" value="<?php echo e($data->name); ?>">
                    <input type="hidden" name="discount" value="<?php echo e($data->discount); ?>">
                    <input type="hidden" name="image" value="<?php echo e($data->image); ?>">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <button id="submit" class="btn " style="border-color: orangered;background: white;color:orangered;">
                        发送宝物
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row" style="position:fixed;left:0px;bottom:5%;">
        <form action="<?php echo e(url('#')); ?>" method="post" class="form-group">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="input-group ">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="text" class="form-control" name="ask"  >
                    <p  class="input-group-addon" style="background: white;border:0;"><button id="submit" class="btn" style="color:black;margin-top:-10%;">确认</button></p>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>