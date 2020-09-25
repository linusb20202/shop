<?php if(!$allrecords->isEmpty()): ?> 
                <?php global $serviceDays; ?>
                <?php $__currentLoopData = $allrecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <div class="project-img">
                            <?php 
                            $gigimgname='';
                            if($allrecord->Image){
                                foreach($allrecord->Image as $gigimage){
                                    if (isset($gigimage->name) && !empty($gigimage->name)) {
                                        $path = GIG_FULL_UPLOAD_PATH . $gigimage->name;
                                        if (file_exists($path) && !empty($gigimage->name)) {
                                            $gigimgname = GIG_FULL_DISPLAY_PATH.$gigimage['name'];
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
                                $gigimgname = 'public/img/front/dummy.png';
                            }
                            ?>
                            <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" class=""><?php echo e(HTML::image($gigimgname, SITE_TITLE,['title'=>$allrecord->title])); ?></a>
                        </div>
                        <div class="caption">
                            <h3><a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" class=""><?php echo e($allrecord->title); ?></a></h3>
                            <div class="pro-bottm">
                                <div class="pro-bottm-left"><a id="maraction-<?php echo e($allrecord->id); ?>" class="maraction" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Gig Actions"><?php echo e(HTML::image('public/img/front/ellipsis.png', SITE_TITLE)); ?></a></div>
                                <div class="pro-bottm-right">
                               <?php if($allrecord->basic_price != 0): ?>
                                <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>"><small>Starting at</small><?php echo e(CURR.$allrecord->basic_price); ?></a>
                               <?php else: ?>
                                <span style="font-size: 14px;color: #666; float:right; ">Fixed Price <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" style="font-size:18px;" >$<?php echo e($allrecord->gig_fixed_price); ?></a></span>
                               <?php endif; ?>                         
                                </div>
                            </div>
                        </div>
                        <div id="offer-show-<?php echo e($allrecord->id); ?>" class="show-adwanv">
                            <ul>
                                <li>
                                    <a href="<?php echo e(URL::to( 'gigs/edit/'.$allrecord->slug)); ?>" class=""><i class="fa fa-pencil" aria-hidden="true"></i><span>Edit</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(URL::to( 'gig-details/'.$allrecord->slug)); ?>" class=""><i class="fa fa-eye" aria-hidden="true"></i><span>View Detail</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(URL::to( 'gigs/delete/'.$allrecord->slug)); ?>" class="" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash" aria-hidden="true"></i><span>Delete</span></a>
                                </li>
                                
                                <li class="advanced-setting">
                                    <a href="javascript:void(0);" class="clsstng" id="close-<?php echo e($allrecord->id); ?>"><i class="fa fa-close" aria-hidden="true"></i><span>Close</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == 1): ?>
            </div>
        </div>
    <?php endif; ?>
    <script>$('#reqloaddiv').show();</script>
<?php else: ?>
<?php if($page == 1): ?>
    <script>$('#reqloaddiv').hide();</script>
    <div class="col-md-12"><div class="management-full">No gigs found. </div></div>
<?php else: ?>
<script>$('#reqloaddiv').hide();</script>
<?php endif; ?>
<?php endif; ?><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/elements/gigs/management.blade.php ENDPATH**/ ?>