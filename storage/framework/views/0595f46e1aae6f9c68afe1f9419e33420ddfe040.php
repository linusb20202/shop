<?php if(isset($allrecord->User->slug)): ?>
<div class="list_box searchlist">
    <div class="images_list">
        <?php
            $gigimgname = '';
            if ($allrecord->Image) {
                foreach ($allrecord->Image as $gigimage) {
                    if (isset($gigimage->name) && !empty($gigimage->name)) {
                        $path = GIG_FULL_UPLOAD_PATH . $gigimage->name;
                        if (file_exists($path) && !empty($gigimage->name)) {
                            $gigimgname = GIG_FULL_DISPLAY_PATH . $gigimage['name'];
                            break;
                        }
                    }
                }
            }
            if ($gigimgname == '' && $allrecord->youtube_image) {
                if (file_exists(GIG_FULL_UPLOAD_PATH.$allrecord->youtube_image)) {
                    $gigimgname = GIG_FULL_DISPLAY_PATH . $allrecord->youtube_image;
                }
            }
            if ($gigimgname == '') {
                $gigimgname = HTTP_PATH.'/public/img/front/dummy.png';
            }
        ?>
        <!--<a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" class=""><img class="lazy" src="<?php echo e(HTTP_PATH); ?>/public/img/loading2.gif" data-original="<?php echo e($gigimgname); ?>"></a>-->
        <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" class=""><img src="<?php echo e($gigimgname); ?>"></a>
    </div>    
    <div class="bottom_box">
        <div class="profilename" style="display:flex; flex-direction:row;">
            <span class="dp">
                <!--<img src="public/files/users/small/<?php echo e($allrecord->User->profile_image); ?>" />-->
                <?php if(isset($allrecord->User->profile_image)): ?>
                    <?php if(file_exists(PROFILE_FULL_UPLOAD_PATH . $allrecord->User->profile_image) && !empty($allrecord->User->profile_image)): ?>
                        <?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH . $allrecord->User->profile_image, SITE_TITLE)); ?>

                    <?php else: ?>
                        <?php echo e(HTML::image('public/img/front/dummy.png', SITE_TITLE)); ?>

                    <?php endif; ?>
                <?php else: ?>
                        <?php echo e(HTML::image('public/img/front/dummy.png', SITE_TITLE)); ?>    
                <?php endif; ?>
            </span>
            <span style="display:flex; flex-direction:column; margin-top:0px;position: relative;left: 5px;top: -5px;">
                <span ><a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->User->slug)); ?>"><?php echo e($allrecord->User->user_name); ?></a></span>
            <span style="color: #b2b2b2;font-weight: 500;">Level 1 Seller</span>
            </span>
        </div>
        <div class="list_con">
            <!--<a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>"><?php echo e(mb_substr($allrecord->title,0,40)); ?> </a>-->
            <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>"><?php echo str_limit($allrecord->title, $limit = 40, $end = ' ...'); ?>

        </div>
        <div class="rating-badges-container" style="display:flex; flex-direction:row;">
            <span class="review"><i class="fa fa-star"></i> <?php echo e($allrecord->User->average_rating); ?> <span style="color: #b2b2b2;font-weight: 500;">(<?php echo e($allrecord->User->total_review); ?>)</span></span> 
            <?php if($allrecord->User->user_status =='Online'): ?>
            <span class=" " style="color:#28a745;background-color:white; border:1px solid #28a745; padding-left:3px;padding-right:3px; border-radius:16px;">Online</span>
            <?php else: ?>
            <span class=" " style="color: white;background-color:white; border: 1px solid white; padding-left:3px;padding-right:3px; border-radius:16px;">Offline</span>
            <?php endif; ?>
        </div>
        <div class="bottom_row">
            <?php echo $__env->make('elements.likeunlike', ['gid'=>$allrecord->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></a>
           <?php if($allrecord->basic_price != 0): ?>
                <span style="font-size: 14px;color: #666; float:right; ">Starting at <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" style="font-size:18px;" >$<?php echo e($allrecord->basic_price); ?></a></span>
           <?php else: ?>
                <span style="font-size: 14px;color: #666; float:right; ">Fixed Price <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" style="font-size:18px;" >$<?php echo e($allrecord->gig_fixed_price); ?></a></span>
           <?php endif; ?>
        </div>
    </div>
</div> 
<?php endif; ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/elements/gigbox.blade.php ENDPATH**/ ?>