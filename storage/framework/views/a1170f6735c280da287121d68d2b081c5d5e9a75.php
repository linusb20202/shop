<?php if(Session::get('user_id')): ?> 
    <?php if(in_array($gid, $mysavegigs)): ?>
         <button type="button" class="btn btn-secondary" title="Remove From Saved" onclick="addtolike(<?php echo e($gid); ?>, 0)">
             <i class="fa fa-heart"></i>
         </button>
     <?php else: ?> 
     <button type="button" class="btn btn-secondary" title="Add to Saved" onclick="addtolike(<?php echo e($gid); ?>, 1)">
             <i class="fa fa-heart-o"></i>
         </button>
     <?php endif; ?>
 <?php else: ?>
     <button type="button" class="btn btn-secondary" title="Add to Saved" onclick="javascript:alert('You must login to save this gig in your favourite list.')">
         <i class="fa fa-heart-o"></i>
     </button>
 <?php endif; ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/elements/likeunlikeinner.blade.php ENDPATH**/ ?>