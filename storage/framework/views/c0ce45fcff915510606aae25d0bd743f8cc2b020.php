<?php $__env->startSection('content'); ?>
<script type="text/javascript">
    var img_path = "<?php echo HTTP_PATH; ?>/public/img";
</script>
<?php echo e(HTML::script('public/js/jquery.raty.min.js')); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#requestform").validate();
    });    
 </script>
<div class="main_dashboard">
    <section class="dashboard-section">
        <div class="container">
            <div class="workplace">
                <div class="manage-btn">Gig Work Place
                    <?php if($orderInfo->seller_id == Session::get('user_id')): ?>
                    <a href="<?php echo e(URL::to( 'selling-orders')); ?>" class="btn btn-primary">Back</a>                
                    <?php else: ?> 
                    <a href="<?php echo e(URL::to( 'buying-orders')); ?>" class="btn btn-primary">Back</a>
                    <?php endif; ?>
                </div>
                <div class="req_dtl">
                    <div class="req_dtl_head">Order Information</div>
                    <div class="req_row">
                        <label>Gig Title: </label> <span><?php echo e($gigInfo->title); ?></span>
                    </div>
                    <div class="req_row">
                        <label>Package: </label> <span><?php echo e(ucfirst($orderInfo->package)); ?></span>
                    </div>
                    <div class="req_row">
                        <label>OrderID: </label> <span>
                            <?php if($orderInfo->pay_type === 'Wallet'): ?>
                                <?php echo e($orderInfo->wallet_trn_id); ?>

                            <?php else: ?> 
                                <?php echo e($orderInfo->paypal_trn_id); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="req_row">
                        <label>Amount: </label> <span><?php echo e(CURR.$orderInfo->revenue); ?></span>
                    </div>
                    <div class="req_row">
                        <label>Payment Type: </label> <span><?php echo e($orderInfo->pay_type); ?></span>
                    </div>
                    <div class="req_row">
                        <label>Order Date: </label> <span><?php echo e($orderInfo->created_at->format('d M, Y')); ?></span>
                    </div>
                    <div id="sentmessages" class="req_row"></div>
                </div>

                <div class="management-bx">
                    <div class="message_chat">
                        <div class="req_dtl_head">Messages</div>
                        <div class="comment-form-bx sendmesg">
                            <div class="comment-form">
                                <div class="ee er_msg postfrm"><?php echo $__env->make('elements.errorSuccessMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                                <?php echo e(Form::open(array('method' => 'post', 'id' => 'requestform', 'enctype' => "multipart/form-data"))); ?>

                                    <div class="input textarea">
                                        <?php echo e(Form::textarea('message', null, ['class'=>'form-control textarea_box required', 'placeholder'=>"Write your message here", 'autocomplete' => 'off', 'rows'=>5, 'id'=>'description'])); ?>

                                    </div>   
                                    <div class="send_msgg">
                                        <div class="send_file">
                                            <?php echo e(Form::file('attachment', ['class'=>'form-control', 'accept'=>IMAGE_EXT.' ,application/pdf, application/msword, text/plain'])); ?>

                                            <span class="help-text"> Supported File Types: jpg, jpeg, png, doc, docx, pdf  (Max. <?php echo e(MAX_IMAGE_UPLOAD_SIZE_DISPLAY); ?>).</span>
                                        </div>
                                        <div class="send_file"><input class="btn btn-success" value="Send" type="submit"></div>
                                    </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                        <div class="all_msgg">
                            <?php if(!$gigmessages->isEmpty()): ?>
                                <?php $__currentLoopData = $gigmessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="messages-bx <?php if($allrecord->receiver_id == Session::get('user_id')): ?> messages-bx-right <?php endif; ?>">
                                            <div class="user-profile-message">
                                                <?php if($allrecord->Sender->profile_image): ?>
                                                <a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Sender->slug)); ?>"><?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$allrecord->Sender->profile_image, SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                                <?php else: ?>
                                                <a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Sender->slug)); ?>"><?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="meassages-txt">
                                                <h2><a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Sender->slug)); ?>"><?php echo e($allrecord->Sender->first_name.' '.$allrecord->Sender->last_name); ?></a></h2>
                                                <div class="message-date"><i class="fa fa-calendar" aria-hidden="true"></i><span><?php echo e($allrecord->created_at->diffForHumans()); ?></span></div>
                                                <p>
                                                    <?php echo e(nl2br($allrecord->message)); ?>

                                                </p>
                                                <?php if($allrecord->attachment && file_exists(GIG_MSG_FULL_UPLOAD_PATH.$allrecord->attachment)): ?>
                                                    <a class="ggimsgat" href="<?php echo e(URL::to( 'myorders/download/'.$orderInfo->slug.'/'.$allrecord->attachment)); ?>"><?php echo e(substr($allrecord->attachment, 9)); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>                            
                        </div>
                    </div>
                    <div class="workplace-seller sticky">
                        <div class="offer_dtl" >
                            <?php if($orderInfo->seller_id == Session::get('user_id')): ?>
                            <div class="req_dtl_head">About the Buyer</div>
                            <div class="dpimg-about_right">
                                <div class="buy_row">
                                    <div class="buy_img">
                                        <?php if($orderInfo->Buyer->profile_image): ?>
                                        <a href="<?php echo e(URL::to( 'public-profile/'.$orderInfo->Buyer->slug)); ?>"><?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$orderInfo->Buyer->profile_image, SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                        <?php else: ?>
                                        <a href="<?php echo e(URL::to( 'public-profile/'.$orderInfo->Buyer->slug)); ?>"><?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="buy_name">
                                        <span><a href="<?php echo e(URL::to( 'public-profile/'.$orderInfo->Buyer->slug)); ?>"><?php echo e($orderInfo->Buyer->user_name); ?></a></span>
                                        <div class="about-rating">
                                            <script>
                                                $(function() {
                                                    $('#avgRating22').raty({
                                                        starOn:    'star-on.png',
                                                        starOff:   'star-off.png',
                                                        start: <?php echo e($orderInfo->Buyer->average_rating); ?>,
                                                        readOnly: true
                                                    });
                                                });
                                            </script>
                                            <span class="pprate" id="avgRating22"></span>
                                            <span class="rating-view"><b><?php echo e($orderInfo->Buyer->average_rating); ?></b> (<?php echo e($orderInfo->Buyer->total_review); ?> reviews)</span>
                                        </div>
                                     </div>
                                </div>
                                <div class="buy_row">
                                    <ul class="general-info">
                                        <li>
                                            <label><i class="fa fa-map-marker" aria-hidden="true"></i>From</label>
                                            <span><?php if(isset($orderInfo->Buyer->Country->name)): ?> <?php echo e($orderInfo->Buyer->Country->name); ?> <?php endif; ?></span>
                                        </li>
                                        <li>
                                            <label><i class="fa fa-user" aria-hidden="true"></i>Member since</label>
                                            <span><?php echo e($orderInfo->Buyer->created_at->format('M Y')); ?></span>
                                        </li>
                                        <li>
                                            <label><i class="fa fa-language" aria-hidden="true"></i>Languages</label>
                                            <span>
                                                <?php if($orderInfo->Buyer->languages): ?>
                                                    <?php $__currentLoopData = json_decode($orderInfo->Buyer->languages); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                      
                                                    <?php if(!$loop->first): ?>, <?php endif; ?><?php echo $lang->lang_name; ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?> 
                                                    N/A
                                                <?php endif; ?>                                                 
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <?php else: ?> 
                            <div class="req_dtl_head">About the Seller</div>
                            <div class="dpimg-about_right">
                                <div class="buy_row">
                                    <div class="buy_img">
                                        <?php if($orderInfo->Seller->profile_image): ?>
                                        <a href="<?php echo e(URL::to( 'public-profile/'.$orderInfo->Seller->slug)); ?>"><?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$orderInfo->Seller->profile_image, SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                        <?php else: ?>
                                        <a href="<?php echo e(URL::to( 'public-profile/'.$orderInfo->Seller->slug)); ?>"><?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="buy_name">
                                        <span><a href="<?php echo e(URL::to( 'public-profile/'.$orderInfo->Seller->slug)); ?>"><?php echo e($orderInfo->Seller->user_name); ?></a></span>
                                        <div class="about-rating">
                                            <script>
                                                $(function() {
                                                    $('#avgRating22').raty({
                                                        starOn:    'star-on.png',
                                                        starOff:   'star-off.png',
                                                        start: <?php echo e($orderInfo->Seller->average_rating); ?>,
                                                        readOnly: true
                                                    });
                                                });
                                            </script>
                                            <span class="pprate" id="avgRating22"></span>
                                            <span class="rating-view"><b><?php echo e($orderInfo->Seller->average_rating); ?></b> (<?php echo e($orderInfo->Seller->total_review); ?> reviews)</span>
                                        </div>
                                     </div>
                                </div>
                                <div class="buy_row">
                                    <ul class="general-info">
                                        <li>
                                            <label><i class="fa fa-map-marker" aria-hidden="true"></i>From</label>
                                            <span><?php if(isset($orderInfo->Seller->Country->name)): ?> <?php echo e($orderInfo->Seller->Country->name); ?> <?php endif; ?></span>
                                        </li>
                                        <li>
                                            <label><i class="fa fa-user" aria-hidden="true"></i>Member since</label>
                                            <span><?php echo e($orderInfo->Seller->created_at->format('M Y')); ?></span>
                                        </li>
                                        <li>
                                            <label><i class="fa fa-language" aria-hidden="true"></i>Languages</label>
                                            <span>
                                                <?php if($orderInfo->Seller->languages): ?>
                                                    <?php $__currentLoopData = json_decode($orderInfo->Seller->languages); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                      
                                                    <?php if(!$loop->first): ?>, <?php endif; ?><?php echo $lang->lang_name; ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?> 
                                                    N/A
                                                <?php endif; ?>                                                 
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/myorders/workplace.blade.php ENDPATH**/ ?>