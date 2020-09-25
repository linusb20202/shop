<div id="toTop"><?php echo e(HTML::image('public/img/front/arrow-top.png', SITE_TITLE)); ?></div>
<header class="header">
    <div class="wrapper">
        <div class="header_inner">
            <div class="logo"><a href="<?php echo HTTP_PATH; ?>"> <?php echo e(HTML::image(HOME_LOGO_PATH, SITE_TITLE)); ?></a></div>
           
            <div class="menu">  <nav id='cssmenu'>
                    <div id="head-mobile"></div>
                    <div class="button"></div>
                    <ul>
                        <li class="left"><a href='<?php echo e(URL::to('gigs/create')); ?>'> Post Gig</a></li>
                        <li class="left"><a href='<?php echo e(URL::to('gigs')); ?>'>Browse Gigs</a></li>
                        <?php if(session()->has('user_id')): ?>
                        <li class="left notification-b" >
                            <a href='javascript:void();'>Notifications <span id="checkunreadmsg" class="green-dots displaynone"></span></a>
                            <ul class="notification displaynonenot" id="msgcontaine">
                            </ul>
                        </li>
                        <li class="left notification-b" >
                            <a href='<?php echo e(URL::to( 'messages/message')); ?>'>Message <span id="checkunreadmsgs" class="green-dots displaynone"></span></a>
                            <ul class="notification displaynonenot" id="msgscontaine">
                            </ul>
                        </li>
                        <li class="has-sub"><a href='<?php echo e(URL::to( 'users/dashboard')); ?>'> Dashboard</a>
                            <ul>
                                <li class=""><a href="<?php echo e(URL::to('users/settings')); ?>">Settings</a></li>   
                                <li class="has-sub"><a href="<?php echo e(URL::to('gigs/management')); ?>">Selling</a>
                                    <ul class="left_open">
                                        <li><a href="<?php echo e(URL::to('gigs/management')); ?>">Manage Gigs</a></li>
                                        <li><a href="<?php echo e(URL::to('gigs/create')); ?>">Create New Gig</a></li>
                                    </ul>
                                </li>   
                                <li class="has-sub"><a href="<?php echo e(URL::to('services/management')); ?>">Buying</a>
                                    <ul class="left_open">
                                        <li><a href="<?php echo e(URL::to('services/management')); ?>">Manage Requests</a></li>
                                        <li><a href="<?php echo e(URL::to('services/create-request')); ?>">Post Request</a></li>
                                        <li><a href="<?php echo e(URL::to('my-saved-gigs')); ?>">My Saved Gigs</a></li>
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
                        <?php else: ?> 
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

    <div class="menu_drop">
         <div class="menu_in ">
         <div class="wrapper">           
                <ul>
                   <?php if($globalCategories): ?>
                        <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(URL::to( 'gigs/'.$cat->slug)); ?>"><?php echo $cat->name; ?></a>
                                <?php if(isset($globalSubCategories[$cat->id])): ?>
                                <ul class="sub_category">
                                    <?php $__currentLoopData = $globalSubCategories[$cat->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                
                                        <li><a href="<?php echo e(URL::to( 'gigs/'.$cat->slug.'/'.$subCat->slug)); ?>"><?php echo $subCat->name; ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <?php if($loop->iteration == 8): ?>
                                 <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                        <?php /*<li class="more-link"><a href="javascript:void()" class="showhide2">More <span class="caret-arrow"></span></a>
                            <ul class="sub_category sub_category_right">
                                @foreach($globalCategories as $cat)
                                    @if($loop->iteration > 8)
                                        <li><a href="{{URL::to( 'gigs/'.$cat->slug)}}">{!! $cat->name !!}</a>
                                            @if(isset($globalSubCategories[$cat->id]))
                                                <ul class="sub_more">
                                                    @foreach($globalSubCategories[$cat->id] as $subCat)                                
                                                        <li><a href="{{URL::to( 'gigs/'.$cat->slug.'/'.$subCat->slug)}}">{!! $subCat->name !!}</a>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach 
                            </ul>
                        </li> */?>
                    <?php endif; ?>
                    
                </ul>    
            </div>
        </div>
    </div>
</header> 

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
    $(document).ready(function() { 
        $('.showhide2').click(function() {
            $(".slidediv2").slideToggle();
        });
    });
</script><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/elements/header_inner.blade.php ENDPATH**/ ?>