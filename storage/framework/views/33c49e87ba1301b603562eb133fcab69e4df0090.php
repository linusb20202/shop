<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo e($title.TITLE_FOR_LAYOUT); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <link rel="icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>

        <?php echo e(HTML::style('public/css/front/bootstrap.min.css')); ?>

        <?php echo e(HTML::style('public/css/front/style.css')); ?>

        <?php echo e(HTML::style('public/css/front/media.css')); ?>

        <?php echo e(HTML::style('public/css/front/font-awesome.css')); ?>


        <!---->
        
        <!--<?php echo e(HTML::script('public/js/jquery-2.1.0.min.js')); ?>-->
         <!--<script src="<?php echo e(asset('/public/js/app.js')); ?>" ></script> --}}-->
        <?php echo e(HTML::script('public/js/jquery.validate.js')); ?>

        
        <!---->

        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/jquery.validate.js"></script>
    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?> 
        
    </body>
</html><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/layouts/login.blade.php ENDPATH**/ ?>