<?php if($status=='1'): ?>
    <a href="<?php echo e(URL::to($action)); ?>" title="Deactivate" class="deactivate"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
<?php else: ?>
    <a href="<?php echo e(URL::to($action)); ?>" title="Activate" class="activate"><button class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></button></a>
<?php endif; ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/elements/admin/update_status.blade.php ENDPATH**/ ?>