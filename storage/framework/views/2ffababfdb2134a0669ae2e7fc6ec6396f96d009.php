<?php $__env->startSection('content'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#requestform").validate();
    });
    
    function postform(){
        if($("#requestform").valid()){
            $('#ddbuton').hide();
            $('#btnloader').show();
            $("#requestform").submit();
        }
    }
 </script>
<div class="main_dashboard">
    <?php echo $__env->make('elements.topcategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="dashboard-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="pull-left topcreate">Edit you service request</h3>    
                </div>
                <?php echo e(Form::model($recordInfo, ['method' => 'post', 'id' => 'requestform', 'enctype' => "multipart/form-data"])); ?>

                <div class="col-md-12">
                    <div class="form-post-request">
                        <div class="ee er_msg postfrm"><?php echo $__env->make('elements.errorSuccessMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                        <div class="form-row post-request-describe js-pr-describe cf titlebox">
                            <label for="request[message]">
                                Title for your service
                            </label>
                            <div class="input-wrap write-wrap request-desc m-b-30 cf select_row">
                                <?php echo e(Form::text('title', null, ['class'=>'form-control required', 'placeholder'=>'Title', 'autocomplete' => 'off'])); ?>

                            </div>
                            <aside class="post-request-tooltip titleboxhover">
                                <figure>
                                    <div class="icn"><i class="fa fa-lightbulb-o"></i></div>
                                    <h3>Title for your service</h3>
                                    <p>Give best suitable title for you service request, so that seller can easily understand your request.</p>
                                </figure>
                            </aside>
                        </div>


                        <div class="form-row post-request-describe js-pr-describe cf textareahover">
                            <label for="request[message]">
                                Describe the service in detail as possible
                            </label>
                            <div class="input-wrap write-wrap request-desc m-b-30 cf select_row textarea ">
                                <?php echo e(Form::textarea('description', null, ['class'=>'js-br-description required', 'placeholder'=>"I'm looking for...", 'autocomplete' => 'off', 'rows'=>5, 'id'=>'description'])); ?>

<!--                                <div class="char-count"><em>0</em> / 2500 Characters Max</div>-->
                            </div>
                            <aside class="post-request-tooltip textareahoverbox">
                                <figure>
                                    <div class="icn"><i class="fa fa-lightbulb-o"></i></div>
                                    <h3>Describe service</h3>
                                    <p>Please describe your service request as much as possible to get best offer.</p>
                                </figure>
                            </aside>
                        </div>

                        <div class=" input-wrap write-wrap request-desc m-b-30 cf form-row walletbox">
                            <label for="request[category]">
                                Select a category
                            </label>
                            <div class="select_row wallet">
                                <div class="form-group">
                                    <div class="market-select">
                                        <span>
                                    <?php echo e(Form::select('category_id', $catList,null, ['class' => 'form-control required','placeholder' => 'Select category', 'onchange'=>'updateSubCategory()', 'id'=>'service_category_id'])); ?>

                                        </span>
                                    </div>
                                    </div>
                                <div class="catloader" id="catloader"><?php echo e(HTML::image("public/img/loading.gif", SITE_TITLE)); ?></div>
                                <div class="form-group" id="subcat">
                                    <div class="market-select">
                                        <span>
                                    <?php echo e(Form::select('subcategory_id', $subcatList,null, ['class' => 'form-control required','placeholder' => 'Select sub category'])); ?> 
                                        </span>
                                    </div>
                                    </div>
                            </div>
                            <aside class="post-request-tooltip walletboxhover">
                                <figure>
                                    <div class="icn"><i class="fa fa-lightbulb-o"></i></div>
                                    <h3>Refine your Request</h3>
                                    <p>Select category and sub category suitable for your service request.</p>
                                    <p>These category and sub category considered for searching as seller end.</p>
                                </figure>
                            </aside>
                        </div>
                        <div class=" input-wrap write-wrap request-desc m-b-30 cf form-row hours">
                            <label >
                                Once you place your order, when would you like your service delivered?
                            </label>
                            <div class="select_row hours">
                                <?php 
                                    global $serviceDays; 
                                    $dd = 2;
                                    if(old('day')){
                                        $dd = old('day');
                                    }
                                ?> 
                                <?php $__currentLoopData = $serviceDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span id="d<?php echo e($key); ?>" class="dddset btn btn-default <?php if($key == $dd): ?> active <?php endif; ?>"  onclick="setday(<?php echo e($key); ?>)" ><?php echo e($val); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e(Form::hidden('day', null, ['class'=>'required', 'id' => 'dayid', 'value'=>$dd])); ?>

                            </div>
                            
                            <aside class="post-request-tooltip hourshover">
                                <figure>
                                    <div class="icn"><i class="fa fa-lightbulb-o"></i></div>
                                    <h3>Set a Delivery Time</h3>
                                    <p>This is the amount of time the seller has to work on your order. Please note that a request for faster delivery may impact.</p>
                                </figure>
                            </aside>
                        </div>
                        <div class=" input-wrap write-wrap request-desc m-b-30 cf form-row ">
                            <label >
                                What is your budget for this service? (Optional)
                            </label>
                            <div class="select_row opion">
                                <?php echo e(Form::text('price', null, ['class'=>'form-control optional deigits', 'min'=>5, 'placeholder' => CURR.'5 minimum'])); ?>

                            </div>
                        </div>
                        <div class=" input-wrap write-wrap request-desc m-b-30 cf form-row ">
                            <label >
                                Upload attachment? (Optional)
                            </label>
                            <div class="select_row image">
                                <?php echo e(Form::file('attachment', ['class'=>'form-control', 'accept'=>IMAGE_EXT.' ,application/pdf, application/msword, text/plain'])); ?>

                                <span class="help-text"> Supported File Types: jpg, jpeg, png, doc, docx, pdf  (Max. <?php echo e(MAX_IMAGE_UPLOAD_SIZE_DISPLAY); ?>).</span>
                                <?php if($recordInfo->attachment != '' && file_exists(SERVICE_FULL_UPLOAD_PATH.$recordInfo->attachment)): ?>
                                    <?php 
                                        $fnameArray =  explode('.', $recordInfo->attachment);
                                        $imgext = array_pop($fnameArray);
                                        $extArray = array('jpg', 'jpeg', 'png');
                                    ?>   
                                    <?php if(in_array($imgext, $extArray)): ?>
                                        <div class="showeditimage"><?php echo e(HTML::image(SERVICE_FULL_DISPLAY_PATH.$recordInfo->attachment, SITE_TITLE,['style'=>"max-width: 200px"])); ?></div>
                                    <?php else: ?>
                                        <div class="showeditimage"> <a download href="<?php echo e(SERVICE_FULL_DISPLAY_PATH.$recordInfo->attachment); ?>"> <?php echo e(substr($recordInfo->attachment, 9)); ?></a></div>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class=" input-wrap write-wrap request-desc m-b-30 cf form-row text-right ">
                            <a href="<?php echo e(URL::to( 'services/management')); ?>" title="Cancel" class="btn btn-default canlcel_le">Cancel</a>
                            <button id="ddbuton" type="button" class="btn btn-primary postbtn" onclick="postform()">Post</button>
                            <div class="btnloader" id="btnloader"><?php echo e(HTML::image("public/img/loading.gif", SITE_TITLE)); ?></div>
                        </div>
                    </div>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
</div>
</section>
</div>
<script>
    function setday(day){
        $('.dddset').removeClass('active');
        $('#d'+day).addClass('active');
        $('#dayid').val(day);
    }
    function updateSubCategory(){
        $.ajax({
            url: "<?php echo HTTP_PATH; ?>/services/updatesubcategory/"+$('#service_category_id').val(),
            type: "GET",
            beforeSend: function () { $("#catloader").show();},
            complete: function () {$("#catloader").hide();},
            success: function (result) {
               $('#subcat').html(result);
            }
        });
    }    
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $("#maraction").click(function () {
        $("#offer-show").addClass("offer-div");
        $(".dashboard-rights-section").removeClass("offer-div");
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/services/editrequest.blade.php ENDPATH**/ ?>