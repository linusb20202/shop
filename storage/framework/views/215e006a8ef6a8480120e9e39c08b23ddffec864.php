<?php $__env->startSection('content'); ?>
<?php echo e(HTML::script('public/js/front/bootstrap.min.js')); ?>

<div class="main_dashboard">
    <section class="dashboard-section">
        <div class="container">
            <div class="manage-btn">My Seller Contacts</div>
            <div class="row">
                <?php if(!$allrecords->isEmpty()): ?>
                    <?php $__currentLoopData = $allrecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-5 col-md-3 buycnt">
                        <div class="profile-bx">
                            <div class="profile-img">
                                <?php if($allrecord->Seller->profile_image): ?>
                                    <?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$allrecord->Seller->profile_image, SITE_TITLE, ['id'=> 'pimage'])); ?>

                                <?php else: ?>
                                    <?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?>

                                <?php endif; ?>
                            </div>
                            <h2><?php echo $allrecord->Seller->first_name.' '.$allrecord->Seller->last_name; ?></h2>
                            <p id="contactn" class="showall"> <span id="showcontact"> <?php echo $allrecord->Seller->contact; ?> </span> </p>
                           
                            <div class="preview-btn"><a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Seller->slug)); ?>" class="btn btn-default">View Public Profile</a></div>

                            <div class="user-details">
                                <ul>
                                    <li><label><i class="fa fa-user" aria-hidden="true"></i>Member since</label><span><?php echo $allrecord->Seller->created_at->format('M Y'); ?></span></li>
                                    <li id="countryctn">
                                        <label class="cntry_div"><i class="fa fa-map-marker" aria-hidden="true"></i>From</label>
                                        <span class="cnnnm cntry_right" id="countryid">
                                            <span id="cname">
                                                <?php
                                                $addd = array();
                                                if ($allrecord->Seller->city) {
                                                    $addd[] = $allrecord->Seller->city;
                                                }
                                                if ($allrecord->Seller->country_id) {
                                                    $addd[] = $allrecord->Seller->Country->name;
                                                }
                                                if ($allrecord->Seller->zipcode) {
                                                    $addd[] = $allrecord->Seller->zipcode;
                                                }
                                                echo implode(', ', $addd);
                                                ?>
                                            </span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?> 
                <div class="col-md-12"><div class="management-full no_contact">No requests found. </div></div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/users/sellercontacts.blade.php ENDPATH**/ ?>