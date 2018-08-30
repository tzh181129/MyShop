<html>
<head>

</head>
<body>
<form action="" method="post">
    <input type="text" name="name">
    <input type="text" name="age">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <button>提交</button>
</form>
</body>
</html>