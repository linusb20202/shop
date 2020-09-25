<div id="toTop"><?php echo e(HTML::image('public/img/front/arrow-top.png', SITE_TITLE)); ?></div>

<header class="header">
    <!--<script src="<?php echo e(asset('/public/js/app.js')); ?>" defer></script>-->
    <div class="wrapper">
        <div class="header_inner">
            <div class="logo"><a href="<?php echo HTTP_PATH; ?>"> <?php echo e(HTML::image(LOGO_PATH, SITE_TITLE)); ?></a></div>
            <?php //if (\Request::is('gig-details/*')) { ?>
                <div class="search_top">
                    <?php echo e(Form::open(array('url' => url('gigs'), 'method' => 'post',  'id' => 'searchform1'))); ?>

                    <div class="seacrh_top_in"><input type="text" name="title" class="form-control" placeholder="What Service are you looking for"></div>  
                    <div class="search_top_btn"><input class="homesearch_top" type="submit" value="Get Started Now" /></div>
                    <?php echo e(Form::close()); ?>

                </div>
            <?php //}
            ?>

            <div class="menu" id="app2">  <nav id='cssmenu'>
                    <div id="head-mobile"></div>
                    <div class="button"></div>
                    <ul>
                        <li class="left"><a href='<?php echo e(URL::to('gigs/create')); ?>'> Post Gig</a></li>
                        <li class="left"><a href='<?php echo e(URL::to('gigs')); ?>'>Browse Gigs</a></li>
                        <?php if(auth()->guard()->check()): ?>
                        <li class="left notification-b" >
                            <a href='javascript:void();'>Notifications <span id="checkunreadmsg" class="green-dots displaynone"></span></a>
                            <ul class="notification displaynonenot" id="msgcontaine">
                            </ul>
                        </li>
                        <li class="left notification-b" >
                            <a href='<?php echo e(URL::to( 'messages/message')); ?>'>Message <indicator :user="<?php echo e(auth()->user()); ?>"></indicator></a>
                            
                        </li>
                        <li class="has-sub"><a href='<?php echo e(URL::to( 'users/dashboard')); ?>'> Dashboard</a>
                            <ul>
                                <li class=""><a href="<?php echo e(URL::to('users/settings')); ?>">Settings</a></li>   
                                <li class="has-sub"><a href="<?php echo e(URL::to('gigs/management')); ?>">Selling</a>
                                    <ul class="left_open">
                                        <li><a href="<?php echo e(URL::to('gigs/management')); ?>">Manage Gigs</a></li>
                                        <li><a href="<?php echo e(URL::to('gigs/create')); ?>">Create New Gig</a></li>
                                        <li><a href="<?php echo e(URL::to('gigs/myofferedgig')); ?>">My Offered Gigs</a></li>
                                    </ul>
                                </li>   
                                <li class="has-sub"><a href="<?php echo e(URL::to('services/management')); ?>">Buying</a>
                                    <ul class="left_open">
                                        <li><a href="<?php echo e(URL::to('services/management')); ?>">Manage Requests</a></li>
                                        <li><a href="<?php echo e(URL::to('services/create-request')); ?>">Post Request</a></li>
                                        <li><a href="<?php echo e(URL::to('my-saved-gigs')); ?>">My Saved Gigs</a></li>
                                        <li><a href="<?php echo e(URL::to('gigs/offeredgig')); ?>">Offered Gigs</a></li>
                                    </ul>
                                </li>
                                <li class="has-sub"><a href="<?php echo e(URL::to('selling-orders')); ?>">Orders</a>
                                    <ul class="left_open">
                                        <li><a href="<?php echo e(URL::to('selling-orders')); ?>">Selling Orders</a></li>
                                        <li><a href="<?php echo e(URL::to('buying-orders')); ?>">Buying Orders</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="<?php echo e(URL::to('earnings')); ?>">Earnings</a>
                                    <ul class="left_open">
                                        <li><a href="<?php echo e(URL::to('earnings')); ?>">Earnings</a></li>
                                        <li><a href="<?php echo e(URL::to('payments/history')); ?>">PayPal History</a></li>
                                    </ul>
                                </li>   
                            </ul> 
                        </li>
                        <li class=""><a href='<?php echo e(URL::to('logout')); ?>'>Logout</a></li>
                        <?php endif; ?>
                        <?php if(auth()->guard()->guest()): ?>
                        <li class=""><a href='<?php echo e(URL::to('register')); ?>'>Register</a></li>
                        <li class=""><a href='<?php echo e(URL::to('login')); ?>'> Login</a></li>
                        <?php endif; ?>

                    </ul>
                </nav> 
                <div class="posstt post_icon">
                    <a href="<?php echo e(URL::to('gigs/create')); ?>">
                        <b>+</b>  
                        <span>Post Gig</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="menu_drop sdfef">
        <div class="menu_in">
            <div class="wrapper">           
                <ul>
                    <?php if($globalCategories): ?>
                    <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(URL::to( 'gigs/'.$cat->slug)); ?>"><?php echo $cat->name; ?></a></li>
                    <?php if($loop->iteration == 8): ?>
                    <?php break; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    <li class="more-link"><a href="javascript:void()" class="showhide2">More <span class="caret-arrow"></span></a>
                        <ul class="slidediv2">
                            <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->iteration > 8): ?>
                            <li><a href="<?php echo e(URL::to( 'gigs/'.$cat->slug)); ?>"><?php echo $cat->name; ?></a></li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </ul>
                    </li>
                    <?php endif; ?>

                </ul>    
            </div>
        </div>
    </div>
</header> 


<?php $__env->startSection('extra-js'); ?>


<!--<script src="<?php echo e(asset('/public/js/app.js')); ?>" defer></script>-->
<!--<script src="<?php echo e(asset('/public/js/jquery-2.1.0.min.js')); ?>" defer></script>-->
<!--<script src="<?php echo e(asset('/public/js/front/menu.js')); ?>" ></script>-->
<?php $__env->stopSection(); ?>
<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 5) {
            $(".header").addClass("fixed-me");
        } else {
            $(".header").removeClass("fixed-me");
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.showhide2').click(function () {
            $(".slidediv2").slideToggle();
        });
    });
</script><?php /**PATH /Users/jaimebalatero/Desktop/prozed/laravelvue/09-14-20/resources/views/elements/header.blade.php ENDPATH**/ ?>