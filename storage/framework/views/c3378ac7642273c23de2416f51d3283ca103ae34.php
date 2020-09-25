<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo e($title.TITLE_FOR_LAYOUT); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <link rel="icon" href="<?php echo FAVICON_PATH; ?>" type="image/x-icon"/>
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/style.css" rel="stylesheet">
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/inner.css" rel="stylesheet">
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/stylee.css" rel="stylesheet">
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/font-awesome.css" rel="stylesheet">
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/media.css" rel="stylesheet">
        <link href="<?php echo e(url(config('app.url'))); ?>/css/front/linus.css" rel="stylesheet">

        
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/js/front/menu.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/js/front/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/js/ajaxsoringpagging.js"></script>
       
       
        
        
        
        

        

        
        
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
        <script type="text/javascript">window.$zopim || (function (d, s) {
        var z = $zopim = function (c) {
            z._.push(c)
        }, $ = z.s =
                d.createElement(s), e = d.getElementsByTagName(s)[0];
        z.set = function (o) {
            z.set.
                    _.push(o)
        };
        z._ = [];
        z.set._ = [];
        $.async = !0;
        $.setAttribute("charset", "utf-8");
        $.src = "https://v2.zopim.com/?4toXhVRHXOtCLes7sRNCMItG7HdblsBt";
        z.t = +new Date;
        $.
                type = "text/javascript";
        e.parentNode.insertBefore($, e)
    })(document, "script");</script>
<script>
    $zopim(function () {
        $zopim.livechat.bubble.setColor('#F1484A');
    });
</script>
    </body>
</html><?php /**PATH /Users/jaimebalatero/Desktop/prozed/vuelara_seenshop/laravelvue/resources/views/layouts/inner.blade.php ENDPATH**/ ?>