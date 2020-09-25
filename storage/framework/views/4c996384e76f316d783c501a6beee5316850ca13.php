<?php $__env->startSection('content'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(url(config('app.url'))); ?>/css/facebox.css">
<script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/js/facebox.js"></script>


<script type="text/javascript">
    $(document).ready(function ($) {
    $('.close_image').hide();
            $('a[rel*=facebox]').facebox({
    closeImage: '<?php echo HTTP_PATH; ?>/public/img/close.png'
    });
            $("#message").validate();
            $("#offer").validate();
//        $('#message_part').animate({
//    scrollTop: $('#message_part').offset().top}, 1000);
        //$(document).scrollTop(50);
        $('#message_part').animate({scrollTop: $('#message_part').prop('scrollHeight')});
    });
</script>
<div class="main_dashboard message_dashboard"  id="app">
    <div class="container">
        <div class="message_sections" style="height:600px;">
            <div class="row-padding">
            <chat-app :user="<?php echo e(auth()->user()); ?>"></chat-app>
                    
                
                
            </div>
        </div>
    </div>

</div>
<?php if($user): ?>
<div class="modal fade publicprofile_modal" id="offerModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <?php echo e(Form::open(array('method' => 'post', 'id' => 'offer','url' => 'gigs/createoffer', 'enctype' => "multipart/form-data"))); ?>

    <div class="modal-dialog" role="document" id="gigs_section">
        <div class="modal-content">
            <div class="nzwh-wrapper">
                <fieldset class="nzwh">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> Select A Gig To Offer</h4>
                    </div>
                    <div class="drt_bx"> 
                        <div class="drt_bx_auto"> 
                            <?php if(!$mygigs->isEmpty()): ?>
                            <?php $__currentLoopData = $mygigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="gig_lst_g">
                                <input type="radio" id="gig_<?php echo $allrecord->id ?>" value="<?php echo $allrecord->id ?>" name="select_gig">
                                <div class="gig_lst">
                                    <div class="gig_img">                                
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
                                            if (file_exists(GIG_FULL_UPLOAD_PATH . $allrecord->youtube_image)) {
                                                $gigimgname = GIG_FULL_DISPLAY_PATH . $allrecord->youtube_image;
                                            }
                                        }
                                        if ($gigimgname == '') {
                                            $gigimgname = 'public/img/front/dummy.png';
                                        }
                                        ?>
                                        <?php echo e(HTML::image($gigimgname, SITE_TITLE,['title'=>$allrecord->title])); ?>

                                    </div>
                                    <div class="gig_title">
                                        <?php echo e($allrecord->title); ?>

                                    </div>
                                </div>

                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="$('#offer_section').show();
                                                $('#gigs_section').hide();">Send</a>
                        </div>
                        <?php else: ?> 
                        <div class="not_found"><div class="management-full">No gig posted by this user yet.</div></div>
                        <?php endif; ?>

                    </div>

                </fieldset>
            </div>
        </div>
    </div>
    <div class="modal-dialog" role="document" id="offer_section" style="display:none;">
        <div class="modal-content">
            <div class="nzwh-wrapper">
                <fieldset class="nzwh">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> Create A Custom Offer</h4>
                    </div>
                    <div class="modal-body">
                        <div class="cot_offer">
                            <h3>I will provide certified german translation service</h3>
                            <div class="offer_user_imges">
                                <?php if($senderUser->profile_image): ?>
                                <?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$senderUser->profile_image, SITE_TITLE, ['id'=> 'uimage'])); ?>

                                <?php else: ?>
                                <?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?>

                                <?php endif; ?>
                            </div>
                            <div class="offer_user_input">
                                <?php echo e(Form::textarea('description', null, ['class'=>'form-control textarea_box required', 'placeholder'=>"", 'autocomplete' => 'off', 'rows'=>5, 'id'=>'description_offer'])); ?>

                            </div>
                        </div>
                        <div class="one_delivery">
                            <input type="radio" name="onedelivery" id="onedelivery" checked>
                            <label>One Delivery:<span>Delivery a finished project</span></label>
                        </div>
                        <div class="total_amount_bx">
                            <div class="total_amount">
                                <label>Total Offer Amount</label>
                                <div class="offer-market-select">
<!--                                    <div class="market-select">
                                        <span>-->
                                            <?php global $package_price; ?>
                                            <?php echo e(Form::text('basic_price', '', ['class'=>'form-control required', 'placeholder'=>'$5000'])); ?>

                                            

<!--                                        </span>
                                    </div>-->
                                </div>
                                <!--                                <div class="offer-market-select">
                                                                    <?php echo e(Form::text('total_offer', '', [ 'class'=>'form-control required', 'placeholder'=>'$5000 max.', 'autocomplete'=>'OFF'])); ?>

                                                                    <input type="text" class="form-control" placeholder="$5000 max.">
                                                                </div>-->
                            </div>
                            <div class="total_amount">
                                <label>Delivery Time</label>
                                <div class="offer-market-select">
                                    <div class="market-select">
                                        <span>
                                            <?php global $delivery_days; ?>
                                            <?php echo e(Form::select('basic_delivery', $delivery_days,null, ['class' => 'form-control required','placeholder' => 'Delivery Time'])); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="expiration_time">
                            <label>Expiration Time (optional)</label>
                            <div class="offer-market-select">
                                <div class="market-select">
                                    <span>
                                        <?php global $expry;//$expry = array('1 day'=>'1 day','2 day'=>'2 day','3 day'=>'3 day') ?>
                                            <?php echo e(Form::select('expiry', $expry,null, ['class' => 'form-control','placeholder' => 'Expiration Time'])); ?>

<!--                                        <select class="form-control">
                                            <option>Select time</option>
                                            <option>1 day</option>
                                            <option>2 day</option>
                                            <option>3 day</option>
                                        </select>-->
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer offer-footer">
                        <a href="javascript:void(0);" class="btn btn-default" onclick="$('#offer_section').hide()
                                            ; $('#gigs_section').show();">Back</a>
                        <?php //echo $user->id;?>
<?php echo e(Form::hidden('offer_user', $user->id, ['class'=>'form-control required', 'id'=>'offer_user'])); ?>

                        <?php echo e(Form::submit('Submit Offer', ['class' => 'succbtn', 'id'=>'succoffer'])); ?>

                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/jaimebalatero/Desktop/prozed/vuelara_seenshop/laravelvue/resources/views/messages/message.blade.php ENDPATH**/ ?>