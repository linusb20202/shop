<div class="likeunlike">
    <div class="liukeloader" id="lik<?php echo e($gid); ?>"><?php echo e(HTML::image("public/img/loading.gif", SITE_TITLE)); ?></div>
    <div class="likeunlike_in" id="likeunlikeid<?php echo e($gid); ?>">
        <?php echo $__env->make('elements.likeunlikeinner', ['gid'=>$gid], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH /Users/jaimebalatero/Desktop/prozed/laravelvue/09-14-20/resources/views/elements/likeunlike.blade.php ENDPATH**/ ?>