<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo e($title.TITLE_FOR_LAYOUT); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <link rel="icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <!--<script src="<?php echo e(asset('/public/js/app.js')); ?>" defer></script>-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public/css/front/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public//css/front/media.css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public//css/front/stylee.css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public//css/front/owl.theme.default.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public//css/front/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public//css/front/magnific-popup.min.css">

        
        
        <?php if(isset($fixheader) && $fixheader == 1): ?>
            
            <link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/public/css/front/heraderfix.css">
        <?php endif; ?>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public//js/jquery-2.1.0.min.js" defer></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public//js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public//js/front/menu.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public//js/front/owl.carousel.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public//js/front/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public//js/front/cssua.min.js"></script>
        
        
        <script src="<?php echo e(asset('/public/js/app.js')); ?>" ></script>
<!--        <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/michalsnik/aos/2.0.4/dist/aos.css'>-->
    </head>
    <body>
        <?php echo $__env->make('elements.header_inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?> 
        <?php echo $__env->make('elements.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
<script src="<?php echo e(asset('/public/js/app.js')); ?>" defer></script>
    </body>
</html><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/layouts/home.blade.php ENDPATH**/ ?>