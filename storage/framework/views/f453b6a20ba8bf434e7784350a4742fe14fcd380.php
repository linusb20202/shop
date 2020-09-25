<?php $__env->startSection('content'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[a-z&,<br> ]+$/i.test(value);
        }, "Letters only please");
        $("#adminForm").validate();
        CKEDITOR.replace( 'full_description', {
            toolbar :
                [
                    ['ajaxsave'],
                    
                    
                    ['Cut','Copy','Paste','PasteText'],
                    ['Undo','Redo','-','RemoveFormat'],
                    ['TextColor','BGColor','TextSize','TextSize'],
                    ['Maximize',  'Table','Link', 'Unlink'],
                    ['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
                    ['Format']
                    
            ],
            // filebrowserUploadUrl : '<?php echo HTTP_PATH;?>/admin/pages/pageimages',
            language: '',
            height: 300,
            format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;div',
            
            //uiColor: '#884EA1'
        });
    });
 </script>
  <?php echo e(HTML::script('public/js/ckeditor/ckeditor.js')); ?>

 
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Category</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/admins/dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo e(URL::to('admin/categories')); ?>"><i class="fa fa-sitemap"></i> <span>Manage Categories</span></a></li>
            <li class="active"> Add Category</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            <?php if(count($errors) > 0 || Session::has('error_message') || isset($error_message)): ?>
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                    <?php if(isset($error_message)): ?> <?php echo e($error_message); ?> <?php endif; ?>
                    
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php echo e($error); ?><br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    
                    <?php if(Session::has('error_message')): ?> <?php echo e(Session::get('error_message')); ?> <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if(Session::has('success_message')): ?> 
                <div class="alert alert-success fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
                    <?php echo e(Session::get('success_message')); ?> 
                    <?php echo e(Session::forget('success_message')); ?>

                </div>
            <?php endif; ?>
            <?php echo e(Form::open(array('method' => 'post', 'id' => 'adminForm', 'enctype' => "multipart/form-data"))); ?>

            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('name', null, ['class'=>'form-control required', 'placeholder'=>'Name', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Full Description <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::textarea('full_description', null, ['minlength' => 120, 'maxlength' => 1200, 'class'=>'form-contorl required', 'placeholder'=>"Full description for Category"])); ?>

                            <!--<span class="help-text">Full description for Category</span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Short Description <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('description', null, ['class'=>'form-control alpha', 'placeholder'=>'Short description', 'autocomplete' => 'off'])); ?>

                            <span class="help-text">Short description for home page</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Profile Image <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::file('image', ['class'=>'form-control required', 'accept'=>IMAGE_EXT])); ?>

                            <span class="help-text"> Supported File Types: jpg, jpeg, png (Max. <?php echo e(MAX_IMAGE_UPLOAD_SIZE_DISPLAY); ?>) (must be 64 x 64 pixels)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Meta title <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('meta_title', null, ['class'=>'form-control ', 'placeholder'=>'Meta title', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Meta description <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('meta_description', null, ['class'=>'form-control ', 'placeholder'=>'Meta description', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Meta keyword <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('meta_keyword', null, ['class'=>'form-control ', 'placeholder'=>'Meta keyword', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="box-footer">
                        <label class="col-sm-2 control-label" for="inputPassword3">&nbsp;</label>
                        <?php echo e(Form::submit('Submit', ['class' => 'btn btn-info'])); ?>

                        <?php echo e(Form::reset('Reset', ['class' => 'btn btn-default canlcel_le'])); ?>

                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/admin/categories/add.blade.php ENDPATH**/ ?>