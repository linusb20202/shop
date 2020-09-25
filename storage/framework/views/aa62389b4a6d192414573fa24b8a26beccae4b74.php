<?php $__env->startSection('content'); ?>
<div class="main_dashboard">
    <?php echo $__env->make('elements.topcategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="gigs-category">
    <div class="wrapper">
        <div class="jobs_itle">
            <div class="jobs_itl catpage">
                <h3 class="explore">Explore Gigs by Categories</h3>
                <div class="tiltee">Find best gig by category </div>
            </div>  
            <div class="exploree">
                <div class="exploree_mid_row">
                    <?php if($globalCategories): ?>
                        <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="gigs-category-bx">
                                <div class="thumbnail">
                                     <a href="<?php echo e(URL::to( 'gigs/'.$cat->slug)); ?>">
                                        <div class="gigs-category-img">
                                            <img src="/public/files/categories/full/<?php echo e($cat->image); ?>" />
                                        </div>
                                        <div class="caption">
                                            <h3><?php echo $cat->name; ?></h3>
                                            <p><?php echo $cat->description; ?></p>
                                        </div>
                                     </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/homes/categories.blade.php ENDPATH**/ ?>