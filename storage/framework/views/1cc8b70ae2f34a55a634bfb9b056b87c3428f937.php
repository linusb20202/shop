<?php $__env->startSection('content'); ?>
<div class="main_dashboard">
    <?php echo $__env->make('elements.topcategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="st_pages">
        <div class="st_pages_title"><?php echo $pageInfo->title; ?></div>
        <div class="st_pages_cnt"><?php echo $pageInfo->description; ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/pages/index.blade.php ENDPATH**/ ?>