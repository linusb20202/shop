<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo e($title.TITLE_FOR_LAYOUT); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <link rel="icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        
        <!--<link href="<?php echo e(asset('/public/css/app.css')); ?>" rel="stylesheet">-->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/bootstrap.min.css" rel="stylesheet">-->
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/style.css" rel="stylesheet">-->
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/inner.css" rel="stylesheet">-->
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/stylee.css" rel="stylesheet">-->
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/font-awesome.css" rel="stylesheet">-->
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/media.css" rel="stylesheet">-->
        <!--<link href="<?php echo e(url(config('app.url'))); ?>/public/css/front/linus.css" rel="stylesheet">-->

        <?php echo e(HTML::style('public/css/front/bootstrap.min.css')); ?>

        <?php echo e(HTML::style('public/css/front/style.css')); ?>

        <?php echo e(HTML::style('public/css/front/inner.css')); ?>

        <?php echo e(HTML::style('public/css/front/stylee.css')); ?>

        <?php echo e(HTML::style('public/css/front/font-awesome.css')); ?>

        <?php echo e(HTML::style('public/css/front/media.css')); ?>

        <?php echo e(HTML::style('public/css/front/linus.css')); ?>

        
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/front/menu.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/front/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/ajaxsoringpagging.js"></script>
       
       
        
       
        
    </head>
    <body>
        <?php echo $__env->make('elements.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main_dashboard" >
            <?php echo $__env->make('elements.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                $("#maraction").click(function () {
                    $("#offer-show").addClass("offer-div");
                    $(".dashboard-rights-section").removeClass("offer-div");
                });
                
            </script>
        </div>
        <?php echo $__env->make('elements.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

    </body>
</html><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/layouts/inner2.blade.php ENDPATH**/ ?>