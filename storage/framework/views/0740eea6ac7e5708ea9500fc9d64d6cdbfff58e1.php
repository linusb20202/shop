<?php $__env->startSection('content'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Only letters, numbers and underscore allowed.");
        $("#adminForm").validate();
    });
 </script>
 
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Testimonial</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/admins/dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo e(URL::to('admin/testimonials')); ?>"><i class="fa fa-testimonials"></i> <span>Manage Testimonials</span></a></li>
            <li class="active"> Edit Testimonial</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            <div class="ersu_message"><?php echo $__env->make('elements.admin.errorSuccessMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
            <?php echo e(Form::model($recordInfo, ['method' => 'post', 'id' => 'adminForm', 'enctype' => "multipart/form-data"])); ?>            
            <div class="form-horizontal">
                <div class="box-body">
                
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Task Title <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('title', null, ['class'=>'form-control required', 'placeholder'=>'Title', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client Name <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('client_name', null, ['class'=>'form-control required', 'placeholder'=>'Client Name', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Country <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('country', null, ['class'=>'form-control required', 'placeholder'=>'Country', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::textarea('description', null, ['class'=>'form-control required', 'placeholder'=>'Description', 'autocomplete' => 'off', 'rows'=>4])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::file('image', ['class'=>'form-control required', 'accept'=>IMAGE_EXT])); ?>

                            <span class="help-text"> Supported File Types: jpg, jpeg, png (Max. <?php echo e(MAX_IMAGE_UPLOAD_SIZE_DISPLAY); ?>).</span>
                            <?php if($recordInfo->image != ''): ?>
                                <div class="showeditimage"><?php echo e(HTML::image(TESTIMONIAL_SMALL_DISPLAY_PATH.$recordInfo->image, SITE_TITLE,['style'=>"max-width: 200px"])); ?></div>
                             <?php endif; ?>
                        </div>
                    </div>
                    
                    
                    
                    <div class="box-footer">
                        <label class="col-sm-2 control-label" for="inputPassword3">&nbsp;</label>
                        <?php echo e(Form::submit('Submit', ['class' => 'btn btn-info'])); ?>

                        <a href="<?php echo e(URL::to( 'admin/testimonials')); ?>" title="Cancel" class="btn btn-default canlcel_le">Cancel</a>
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/admin/testimonials/edit.blade.php ENDPATH**/ ?>