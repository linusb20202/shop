<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo e($title.TITLE_FOR_LAYOUT); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <link rel="icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>

        

        <link href="<?php echo e(asset('css/front/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/front/style.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/front/font-awesome.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/front/media.css')); ?>" rel="stylesheet">
        
        
        
        <script src="<?php echo e(asset('js/jquery-2.1.0.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('js/jquery.validate.js')); ?>" ></script>

        
    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?> 
        
    </body>
</html><?php /**PATH /Users/jaimebalatero/Desktop/prozed/laravelvue/09-14-20/resources/views/layouts/login.blade.php ENDPATH**/ ?>