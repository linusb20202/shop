<?php $__env->startSection('content'); ?>
<div class="slider_wrap">
    <div class="slider_wrap_inner">
        <div id="container">
            <?php echo e(HTML::image('.public/img/front/a.jpg', SITE_TITLE)); ?>

            <?php echo e(HTML::image('.public/img/front/c.jpg', SITE_TITLE)); ?>

            <?php echo e(HTML::image('.public/img/front/d.jpg', SITE_TITLE)); ?>

            <?php echo e(HTML::image('.public/img/front/b.jpg', SITE_TITLE)); ?>

        </div>public
    </div>    
    <div class="slider_contaent">
        <h1 class="slider_title">be your own boss</h1>  
        <div class="slider_con">It’s a marketplace which helps workers who are seeking for work</div>
        <div class="center_seacrh">
            <div class="search_bar desktop_search">
                <?php echo e(Form::open(array('url' => url('gigs'), 'method' => 'post',  'id' => 'searchform'))); ?>

                <div class="seacrh_in"><input type="text" name="title" class="form-control" placeholder="What Service are you looking for"></div>  
                <div class="search_btn"><input class="homesearch" type="submit" value="Get Started Now" /></div>
                <input type="hidden" value="1" id="pageidd" name="page"> 
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<div class="search_bar mobile_search">
    <?php echo e(Form::open(array('url' => url('gigs'), 'method' => 'post',  'id' => 'searchform'))); ?>

    <div class="seacrh_in"><input type="text" name="title" class="form-control" placeholder="What Service are you looking for"></div>  
    <div class="search_btn"><input class="homesearch_m" type="submit" value="Get Started Now" /></div>
    <input type="hidden" value="1" id="pageidd" name="page"> 
    <?php echo e(Form::close()); ?>

</div>

<div class="jobs_sction">
    <div class="wrapper">
        <div class="jobs_itle">
             <div class="gifg">
            <div class="job-gigs-ss">
            <h3 class="explore">Recently Added Gigs</h3>    
            <div class="tiltee">Get inspired to build your business</div>
            </div>
            <div class="view-all-but"><a href="<?php echo e(URL::to( 'gigs')); ?>">View all<i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
             </div>
            <div class="home-gigs">
               <?php if(!$gigcatlist->isEmpty()): ?> 
                    <?php $__currentLoopData = $gigcatlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($allrecord->User->slug)): ?>
                        <?php echo $__env->make('elements.gigbox', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="introduce" id="introduce_new">
    <div class="wrapper">
        <div class="introduce_inner">
            <div class="introduce_left">
                <div class="introtite">Introducing <?php echo e(SITE_TITLE); ?></div>  
                <div class="intro_con"> It’s a job marketplace which users can be register as a both poster
                    and worker.Works will be both online and offline.</div>
                <div class="know_more"><a href="<?php echo e(URL::to( 'about-us')); ?>">Know More</a></div>
            </div>
             <div class="introduce_right">
        <?php echo e(HTML::image('public/img/front/dummy.png', SITE_TITLE)); ?>

    </div>
        </div>   
    </div>   
</div>  

<section class="gigs-category">
    <div class="wrapper">
        <div class="jobs_itle">
            <h3 class="explore">Explore Gigs by Categories</h3>
            <div class="tiltee">Find best gig bur category </div>
        </div>
        <div class="gategory-gigs">
            <?php if($globalCategories): ?>
                <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="gigs-category-bx">
                        <div class="thumbnail">
                             <a href="<?php echo e(URL::to( 'gigs/'.$cat->slug)); ?>">
                                <div class="gigs-category-img">
                                    <?php echo e(HTML::image(CATEGORY_FULL_DISPLAY_PATH.$cat->image, SITE_TITLE)); ?>

                                </div>
                                <div class="caption">
                                    <h3><?php echo $cat->name; ?></h3>
                                    <p><?php echo $cat->description; ?></p>
                                </div>
                             </a>
                        </div>
                    </div>
                    <?php if($loop->iteration == 8): ?>
                        <?php break ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
            <?php endif; ?>
            <div class="cate"><a href="<?php echo e(URL::to('categories')); ?>">All Categories</a></div>
         </div>
    </div>
</section>

<div class="slide_section">
    <div class="slide_section_inner">
        <div class="wrapper">
            <div class="slide_box">
                <div class="slide_botm">
                    <div class="slide_title">Your Terms</div> 
                    <div class="slide_con"> Whatever you need to simplify<br> your to do list, no matter your budget.</div>
                </div>
            </div>
            <div class="slide_box">
               
                <div class="slide_botm">
                    <div class="slide_title">Your Timeline</div> 
                    <div class="slide_con"> Find services based on your goals and<br> deadlines, it’s that simple.</div>
                </div>
            </div>
            <div class="slide_box">
               
                <div class="slide_botm">
                    <div class="slide_title">Your Safety</div> 
                    <div class="slide_con">our payment is always secure, Kartick <br>is builtto protect your peace of mind</div>
                </div>
            </div>
            <div class="slide_box">
               
                <div class="slide_botm">
                    <div class="slide_title"> 24/7 Support</div> 
                    <div class="slide_con"> We will provide you 24/7 support <br>so you dont face any problem.</div>
                </div>
            </div>
            <div class="slide_box">
                
                <div class="slide_botm">
                    <div class="slide_title">Quick Results</div> 
                    <div class="slide_con"> Easy to find the services and<br> getting work done quickly.</div>
                </div>
            </div>
            
            <div class="slide_box">               
                <div class="slide_botm">
                    <div class="slide_title">User Friendly </div> 
                    <div class="slide_con">From searching to payment to review, <br>the process is very user friendly</div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>
<?php if(!$testimonils->isEmpty()): ?> 
<div class="cilent_testimonial">
    <div class="wrapper cilent_wrap">
        <div class="cile_head"><h4 class="rece">Client Testimonials</h4></div>
        <div class="sliderr_wrap">
            <div id="testimonial" class="owl-carousel owl-theme owl-loaded">
                <?php $__currentLoopData = $testimonils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="sliderr_wrap_bx">
                        <div class="sliderr_wrap_inner">
                        <div class="sliderr_wrap_left">
                            <?php echo e(HTML::image(TESTIMONIAL_SMALL_DISPLAY_PATH.$allrecord->image, SITE_TITLE)); ?>

                        </div> 
                        <div class="sliderr_wrap_right">
                            <div class="sliderr_wrap_right_top"><?php echo str_limit($allrecord->description, $limit = 120, $end = '...'); ?></div>
                            <div class="sliderr_wrap_right_botm">
                                <div class="botm_name"><b><?php echo e($allrecord->client_name); ?></b>
                                    <span class="simple_name"><?php echo e($allrecord->country); ?></span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>               
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(!$recentCompletedlist->isEmpty()): ?> 
    <div class="completed_task">
    <div class="wrapper">
        <div class="completed_task"><h4 class="rece">Recently Completed Gigs</h4></div>    
        <div class="Recently">
            <div class="Recently_mid_row">               
                <?php $__currentLoopData = $recentCompletedlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($allrecord->Seller)): ?>
                    <div class="rec_block">
                        <div class="rec_block_inner">
                            <div class="rec_img_top">
                                <div class="rec_img">
                                    <?php if($allrecord->Seller->profile_image): ?>
                                    <a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Seller->slug)); ?>"><?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$allrecord->Seller->profile_image, SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                    <?php else: ?>
                                    <a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Seller->slug)); ?>"><?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="_date"><?php echo e($allrecord->updated_at->format('d F Y')); ?></div>                                
                            </div>
                            <div class="img_con_btm_bx">
                                <div class="img_con"><?php echo e($allrecord->Gig->title); ?></div>
                                <div class="img_con_btm">
                                    <?php if($allrecord->package == 'basic'): ?>
                                        <?php echo str_limit($allrecord->Gig->basic_description, $limit = 90, $end = '...'); ?>

                                    <?php elseif($allrecord->package == 'standard'): ?>
                                        <?php echo str_limit($allrecord->Gig->basic_standard, $limit = 90, $end = '...'); ?>

                                    <?php else: ?>
                                        <?php echo str_limit($allrecord->Gig->basic_premium, $limit = 90, $end = '...'); ?>

                                    <?php endif; ?>    
                                </div>
                            </div>
                        </div>    
                    </div> 
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
<!--        <div class="cate cate_new"><a href="#">Browse more tasks</a></div>-->
    </div>
</div>
<?php endif; ?>
<?php echo e(HTML::script('public/js/front/pageScript.js')); ?>

<script type="text/javascript">
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $('#toTop').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    });
</script>

<script type="text/javascript">
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 1100) {
            $('.menu_in').addClass('fixedmenu').fadeIn();
        } else {
            $('.menu_in').removeClass('fixedmenu').fadeOut();
        }
    });
</script>
<!--<script src='https://cdn.rawgit.com/michalsnik/aos/2.0.4/dist/aos.js'></script>
<script type="text/javascript">
    AOS.init({
        duration: 1200
    });
</script>-->
<script type="text/javascript">
    $('#videoLink')
            .magnificPopup({
                type: 'inline',
                midClick: true
            })

    $(document).ready(function () {
        $('.dropp').click(function () {
            $(".openn").slideToggle();
        });
    });

    $('#offerslider').owlCarousel({
        rtl: false,
        loop: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 1000,
        smartSpeed: 1000,
        slideSpeed: 1000,
        autoplayHoverPause: true,
        responsive: {
            0: {items: 1},
            479: {items: 1},
            640: {items: 2},
            766: {items: 2},
            900: {items: 3},
            1100: {items: 3},
            1280: {items: 3}
        }

    })

    $(document).ready(function () {
        $("#login").click(function () {
            $("#forget_pop_up").toggle();
        });
        $(".close_div").click(function () {
            $("#forget_pop_up").hide();
        });
    });

    $(document).ready(function () {

        $(".close_div").click(function () {
            $("#forget_pop_up").hide();

        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/homes/index.blade.php ENDPATH**/ ?>