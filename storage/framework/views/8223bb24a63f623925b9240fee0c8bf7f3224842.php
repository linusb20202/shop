<?php $__env->startSection('content'); ?>
<!--<?php echo e(HTML::script('public/js/front/lightslider.js')); ?>-->
<!--<script src="<?php echo e(asset('/public/js/front/lightslider.js')); ?>" ></script>-->
 <!--<script type="text/javascript" src="<?php echo e(url(config('app.url'))); ?>/public/js/front/bootstrap.min.js"></script>-->
 
<!--<?php echo e(HTML::script('public/js/jquery.raty.min.js'), 'defer'); ?>-->
<!--<?php echo e(HTML::style('public/css/front/lightslider.css')); ?>-->

<div class="main_dashboard">
    <?php echo $__env->make('elements.topcategories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="dashboard-section">
        <div class="container">
            <div class="row" style=" margin-bottom:10px;">
                <div class="col-xs-12 col-md-12 hidden-xs hidden-sm">
                    <div class="top_row_new" style="padding:0px 5px 0px 5px !important">
                        <ul class="nav navbar-nav" style="font-size:14px; ">
                            <li class="dropdown" style="margin-right:25px; margin-left:15px;   border-bottom:3px solid #35A7A7; "><a href="#intro" style="color:#35A7A7 !important;" >Introduction</a></li>
                            <li class="dropdown"  style="margin-right:25px;"><a href="#description" style="color:#35A7A7 !important;" >Proposal Details</a></li>
                            <li class="dropdown"  style="margin-right:25px;"><a href="../public-profile/<?php echo e($recordInfo->User->slug); ?>" style="color:#35A7A7 !important;">Reviews</a></li>
                            <li class="dropdown"  style="margin-right:25px;"><a href="#related" style="color:#35A7A7 !important;">Related Proposals</a></li>
                             <?php if(Session::get('user_id') != $recordInfo->user->id): ?>
                                <li class="dropdown"  style="margin-right:25px;"><a href="javascript:void(0);"  onclick='$("#info12").show();'data-toggle="modal" data-target="#myModal2" style="color:#35A7A7 !important;"><i class="far fa-comments"></i> Message the seller</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>    
            <div class="row" id="app">
                <div class="col-xs-12 col-md-8">
                    <div class="top_row_new">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-xs-12 md-12">
                                <h3 class="left_title"><?php echo e($recordInfo->title); ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 md-7" >
                                <div class="col-xs-12 text-left" style="padding-bottom:10px; padding-left:0px;">
                                    <nav  style="font-size:14px;font-weight:600; color:#777777; padding-left:0px !important; align-content:left">
                                      <a href="../../">Home</a> >
                                      <a href="../gigs/<?php echo e($parentcat->slug); ?>"><?php echo e($parentcat->name); ?></a> >
                                      
                                        <a href="../gigs/<?php echo e($parentcat->slug); ?>/<?php echo e($subcat->slug); ?>"><?php echo e($subcat->name); ?></a>
                                      
                                    </nav>
                                </div>
                                <!--<div class="col-xs-12" style="color:#D0D0D0; font-size:14px;">-->
                                <!--    <i class="fas fa-star " style="color:#D0D0D0;"></i>-->
                                <!--    <i class="fas fa-star " style="color:#D0D0D0;"></i>-->
                                <!--    <i class="fas fa-star " style="color:#D0D0D0;"></i>-->
                                <!--    <i class="fas fa-star " style="color:#D0D0D0;"></i>-->
                                <!--    <i class="fas fa-star " style="color:#D0D0D0;"></i> &nbsp; (0) &nbsp; <span style="font-weight:600">0 Order(s) in Queue.</span>-->
                                <!--</div>-->
                                
                                <!--<div class="about-rating" style="margin-botom:0px;padding:bottom:0px;align-items:end;">-->
                                <!--            <script>-->
                                <!--                        $(function() {-->
                                <!--                        $('#avgRating22').raty({-->
                                <!--                        starOn:    'star-on.png',-->
                                <!--                                starOff:   'star-off.png',-->
                                <!--                                start: <?php echo e($recordInfo -> User -> average_rating); ?>,-->
                                <!--                                readOnly: true-->
                                <!--                        });-->
                                <!--                        });</script>-->
                                <!--            <span class="pprate gigdtlrat" id="avgRating22"></span>-->
                                
                                <!--</div>-->
                                <!--<div class="ratings" style="position: in-line;">-->
                                <!--  <div class="empty-stars"></div>-->
                                <!--  <div class="full-stars" style="width:<?php echo e($recordInfo->User->average_rating * 20); ?>%"> </div>-->
                                <!--</div> (2)-->
                                <div class="col-xs-12 text-left" style="padding-left:0px !important; margin-bottom:10px;">
                                    
                                        <div style="display:flex; flex-direction:row;"><gig-rating :rate="<?php echo e($recordInfo->User->average_rating); ?>"></gig-rating>
                                                    <b style="font-weight:800 !important; padding-left:10px; font-size:14px;vertical-align:bottom;"><?php echo $recordInfo->User->average_rating; ?> </b> &nbsp; <span style="color:#D0D0D0;  font-size:14px;vertical-align:bottom;font-weight:600"> (<?php echo $recordInfo->User->total_review; ?>)</span>&nbsp; <span style="color:#D0D0D0; font-size:14px;vertical-align:bottom;font-weight:600">0 Order(s) in Queue.</span>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="col-xs-5 md-5 text-right" style="padding-bottom:10px; ">
                                <div class="btn btn-success btn-md"  style="display: inline-block; padding-right:10px; padding-left:10px;  margin-bottom:0px; " >
                                  <img alt="whatsapp sharing button" src="https://platform-cdn.sharethis.com/img/whatsapp.svg" style="height:18px; padding-bottom:0px;">
                                </div>
                                <div class="btn btn-primary btn-md"  style="display: inline-block;padding-right:10px; padding-left:10px; ">
                                  <img alt="facebook sharing button" src="https://platform-cdn.sharethis.com/img/facebook.svg" style="height:18px;">
                                </div>
                                <div class="btn btn-md btn-light" data-network="twitter" style="display: inline-block; padding-right:10px; padding-left:10px; background-color:#55ACEE;">
                                  <img alt="twitter sharing button" src="https://platform-cdn.sharethis.com/img/twitter.svg" style="height:18px;">
                                </div>
                                <div class="btn btn-primary btn-md" data-network="linkedin" style="display: inline-block;padding-right:10px; padding-left:10px;">
                                  <img alt="linkedin sharing button" src="https://platform-cdn.sharethis.com/img/linkedin.svg" style="height:18px;">
                                </div>
                                <div class="btn btn-md btn-danger" data-network="pinterest" style="display: inline-block;background-color:#CB2027;padding-right:10px; padding-left:10px;">
                                  <img alt="pinterest sharing button" src="https://platform-cdn.sharethis.com/img/pinterest.svg" style="height:18px;">
                                </div>
                                <div class="btn btn-light btn-md" data-network="sharethis" style="display: inline-block;background-color:#95D03A;padding-right:10px; padding-left:10px;">
                                  <img alt="sharethis sharing button" src="https://platform-cdn.sharethis.com/img/sharethis.svg" style="height:18px;">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix" style="padding:20px; border:1px solid #D0D0D0;">
                            <gig-images :images="<?php echo e($recordInfo->Image); ?>"></gig-images>
                            <!--<carousel-home></carousel-home>-->
                        </div>
                        
                        <div class="image_desp">

                            <div class="detail_img" id="description">
                                <h2>Description</h2>
                                <?php echo nl2br($recordInfo->description); ?>

                            </div>    
                        </div>
                        <?php if(!empty($recordInfo->Gigfaq) && count($recordInfo->Gigfaq) > 0): ?>
                        <div id="four" class="same_box">
                            <div class="table">
                                <h4 class="gig-fancy-header">Frequently Asked Questions</h4>
                            </div>  
                            <div class="accordion">
                                <?php $__currentLoopData = $recordInfo->Gigfaq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gigfaq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-section">
                                    <a class="accordion-section-title" href="#accordion-<?php echo e($key); ?>"><?php echo e($gigfaq->question); ?></a>
                                    <div id="accordion-<?php echo e($key); ?>" class="accordion-section-content">
                                        <p><?php echo e($gigfaq->answer); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($recordInfo->Gigextra) && count($recordInfo->Gigextra) > 0): ?>
                        <div id="four" class="same_box">
                            <div class="table">
                                <h4 class="gig-fancy-header">Gig Extras</h4>
                            </div>  
                            <div class="accordion">
                                <?php global $delivery_days; ?>
                                <?php $__currentLoopData = $recordInfo->Gigextra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gigextraa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion-section">
                                    <a class="accordion-section-title" href="#accordion-<?php echo e($gigextraa->id); ?>"><?php echo e($gigextraa->title); ?></a>
                                    <div id="accordion-<?php echo e($gigextraa->id); ?>" class="accordion-section-content">
                                        <p><?php echo e($gigextraa->description); ?></p>
                                        <p><strong>Delivery Time : </strong><?php echo e($delivery_days[$gigextraa->delivery]); ?></p>
                                        <p><strong>Price : </strong>$<?php echo e($gigextraa->price); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($recordInfo->pdf_doc)): ?>
                        <?php $pdf_doc = explode(',',$recordInfo->pdf_doc) ?>
                        <?php if(count(array_filter($pdf_doc) > 0)): ?>
                        <div id="four" class="same_box">
                            <div class="table">
                                <h4 class="gig-fancy-header">GIG Documents</h4>
                            </div>  
                            <div class="accordion-doc">
                                <ul>
                                    <?php $__currentLoopData = array_filter($pdf_doc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachmental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(file_exists(GIG_DOC_FULL_UPLOAD_PATH.$attachmental) && $attachmental!=""): ?>
                                    <li data-img="<?php echo e($attachmental); ?>" class="portfolio-cc"><?php echo e(substr($attachmental,9)); ?><a href="<?php echo e(GIG_DOC_FULL_DISPLAY_PATH.$attachmental); ?>" class="delete" download><i class="fa fa-download"></i></a></li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        
                        <!--<?php if(!$gigreviews->isEmpty()): ?>-->
                                
                        <!--        <div class="client-rievews gigdtl_pg"> -->
                        <!--            <h3>Reviews</h3>-->
                        <!--            <?php $__currentLoopData = $gigreviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allrecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                        <!--            <div class="client-chat gigdtl_pgin">-->
                        <!--                <div class="clientimg-about">-->
                        <!--                    <?php if($allrecord->Otheruser->profile_image): ?>-->
                        <!--                    <a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Otheruser->slug)); ?>" class=""><?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$allrecord->Otheruser->profile_image, SITE_TITLE)); ?></a>-->
                        <!--                    <?php else: ?>-->
                        <!--                    <a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Otheruser->slug)); ?>" class=""><?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?></a>-->
                        <!--                    <?php endif; ?>-->
                        <!--                </div>-->
                        <!--                <div class="client-rv">-->
                        <!--                    <h3><a href="<?php echo e(URL::to( 'public-profile/'.$allrecord->Otheruser->slug)); ?>" class=""><?php echo e($allrecord->Otheruser->user_name); ?></a></h3>-->
                        <!--                    <span class="review-date"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo e($allrecord->created_at->diffForHumans()); ?></span>-->
                        <!--                    <div class="client-review-reting">-->
                        <!--                        <script>-->
                        <!--                                    $(function() {-->
                        <!--                                    $('#lst<?php echo e($allrecord->id); ?>').raty({-->
                        <!--                                    starOn:    'star-on.png',-->
                        <!--                                            starOff:   'star-off.png',-->
                        <!--                                            start: <?php echo e($allrecord -> rating); ?>,-->
                        <!--                                            readOnly: true-->
                        <!--                                    });-->
                        <!--                                    });</script>-->
                        <!--                        <span class="lstreview lstreview_new" id="lst<?php echo e($allrecord->id); ?>"></span>-->
                        <!--                        <b><?php echo e($allrecord->rating); ?></b>-->
                        <!--                    </div>-->
                        <!--                    <p>-->
                        <!--                        <?php echo e(nl2br($allrecord->comment)); ?>-->
                        <!--                    </p>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                -->
                        <!--        </div>-->
                        <!--        <?php endif; ?>-->

                        
                        
                    </div>
                    <div class="row">
                            <?php if($recordInfo->basic_title != ''): ?>
                                <div class="col-xs-12 md-12 hidden-xs hidden-sm">
                                <div class="gig-page-packages-table"><h3 class="section-title" style="margin-bottom:15px;margin-top:15px;">Compare Packages</h3>
                                <table class="table" style="border-top-style:none; ">
                                  
                                  <tbody>
                                    <tr  style="border-bottom-style:none;">
                                      <td><h4 style="margin-top:10px;">Package</h4></td>
                                      <td>
                                          <h4 style="margin-top:10px;">$<?php echo e($recordInfo->basic_price); ?></h4>
                                      <h3 style="margin-top:15px;">Basic</h3>
                                      <h5 style="margin-top:15px;"><?php echo e($recordInfo->basic_title); ?></h5>
                                      <p style="margin-top:10px;">
                                          <?php echo e($recordInfo->basic_description); ?>

                                      </p>
                                      </td>
                                      <td>
                                          <h4 style="margin-top:10px;">$<?php echo e($recordInfo->standard_price); ?></h4>
                                      <h3 style="margin-top:15px;">Standard</h3>
                                      <h5 style="margin-top:15px;"><?php echo e($recordInfo->standard_title); ?></h5>
                                      <p style="margin-top:10px;">
                                          <?php echo e($recordInfo->standard_description); ?>

                                      </p>
                                      </td>
                                      <td>
                                          <h4 style="margin-top:10px;">$<?php echo e($recordInfo->premium_price); ?></h4>
                                      <h3 style="margin-top:15px;">Premium</h3>
                                      <h5 style="margin-top:15px;"><?php echo e($recordInfo->premium_title); ?></h5>
                                      <p style="margin-top:10px;">
                                          <?php echo e($recordInfo->premium_description); ?>

                                      </p>
                                      </td>
                                    </tr>
                                     <?php if(!empty($recordInfo->GigCustom)): ?>
                                        <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                              <td><?php echo e($customfield->fieldname); ?></td>
                                              <td class="text-center">
                                                <?php if($customfield->check1): ?>
                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                <?php endif; ?>  
                                              </td>
                                              <td class="text-center">
                                                <?php if($customfield->check2): ?>
                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                <?php endif; ?>  
                                              </td>
                                              <td class="text-center">
                                                <?php if($customfield->check3): ?>
                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                <?php endif; ?>  
                                              </td>
                                              
                                            </tr>                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>                                                    
                                     
                                    <tr>
                                      <td>Revisions</td>
                                      <td class="text-center"><?php echo e($recordInfo->basic_revision); ?></td>
                                      <td class="text-center"><?php echo e($recordInfo->standard_revision); ?></td>
                                      <td class="text-center"><?php echo e($recordInfo->premium_revision); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Delivery Time</td>
                                      <td class="text-center"><?php echo e($recordInfo->basic_delivery); ?> day</td>
                                      <td class="text-center"><?php echo e($recordInfo->standard_delivery); ?> days</td>
                                      <td class="text-center"><?php echo e($recordInfo->premium_delivery); ?> days</td>
                                    </tr>
                                    <tr>
                                      <td>Total</td>
                                      <td class="text-center">
                                          <p>$<?php echo e($recordInfo->basic_price); ?></p>
                                           <?php echo e(Form::open(array('method' => 'post', 'id' => 'addggiform1'))); ?>

                                        <input type="hidden" name="type"  value="basic">
                                        <input type="hidden" name="slug"  value="<?php echo e($recordInfo->slug); ?>">
                                       <input type="hidden" name="gigprice"  value="<?php echo e($recordInfo->basic_price); ?>">
                                        <div class="package-footer">
                                            <p class="" >
                                                <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                                <span  onclick="submitform1()" class="btn btn-md btn-success" style="width:200px;">Select
                                                    
                                                </span>
                                                <?php endif; ?>
                                            </p>
                                            
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                          
                                      </td>
                                      <td class="text-center">
                                          <p>$<?php echo e($recordInfo->standard_price); ?></p>
                                          <?php echo e(Form::open(array('method' => 'post', 'id' => 'addggiform2'))); ?>

                                        <input type="hidden" name="type"  value="standard">
                                        <input type="hidden" name="slug"  value="<?php echo e($recordInfo->slug); ?>">
                                       <input type="hidden" name="gigprice"  value="<?php echo e($recordInfo->standard_price); ?>">
                                        <div class="package-footer">
                                            <p class="" >
                                                <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                                <span  onclick="submitform2()" class="btn btn-md btn-success" style="width:200px;">Select
                                                    
                                                </span>
                                                <?php endif; ?>
                                            </p>
                                            
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                      </td>
                                      <td class="text-center">
                                          <p>$<?php echo e($recordInfo->premium_price); ?></p>
                                          <?php echo e(Form::open(array('method' => 'post', 'id' => 'addggiform3'))); ?>

                                        <input type="hidden" name="type"  value="premium">
                                        <input type="hidden" name="slug"  value="<?php echo e($recordInfo->slug); ?>">
                                       <input type="hidden" name="gigprice"  value="<?php echo e($recordInfo->premium_price); ?>">
                                        <div class="package-footer">
                                            <p class="" >
                                                <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                                <span  onclick="submitform3()" class="btn btn-md btn-success" style="width:200px;">Select
                                                    
                                                </span>
                                                <?php endif; ?>
                                            </p>
                                            
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                </div>
                            </div>
                            <?php else: ?>
                            <!--<div class="col-xs-12 md-12" style="margin-bottom:15px;margin-top:15px;">-->
                            <!--    <div class="gig-page-packages-table"><h3 class="section-title" style="margin-bottom:15px;margin-top:15px;">Order Details</h3>-->
                            <!--    </div>-->
                            <!--    <div class="col-sm-12 md-12" style="width: 100%; background: #fff; padding: 15px 25px;">-->
                            <!--        <div class="offer-bxs">-->
                            <!--        <div class="offer-bxs-price">-->
                            <!--            <span class="package-title-text"><?php echo e($recordInfo->title); ?></span>-->
                            <!--            <span class="package-price"><?php echo e(CURR.$recordInfo->gig_fixed_price); ?></span>-->
                            <!--        </div>-->
                            <!--        <p ><?php echo $recordInfo->description; ?></p>-->
                            <!--        <div class="offers-details">-->
                            <!--            <span class="offer-icons">-->
                            <!--                <i class="fa fa-clock-o fa-lg"></i>-->
                            <!--                <span class="delivery-time"><?php echo e($recordInfo->gig_fixed_delivery); ?> days</span>-->
                            <!--                Delivery-->
                            <!--            </span>-->
                            <!--            <span class="offer-icons">-->
                            <!--                <i class="fa fa-refresh fa-lg"></i>-->
                            <!--                <?php echo e($recordInfo->gig_fixed_revision); ?> Revision-->
                            <!--            </span>-->
                            <!--            <ul class="buyables-offer">-->
                                            
                                                                                <!--<?php if(!empty($recordInfo->GigCustom)): ?>-->
                                                                                <!--    <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
                                                                                <!--            <li class="" >-->
                                                                                <!--                <?php if($customfield->check1 == 1): ?>-->
                                                                                <!--                    <i class="fa fa-check" style="color:#5CB85C;">-->
                                                                                <!--                    <?php else: ?> -->
                                                                                <!--                    <i class="fa fa-check" style="color:#D0D0D0;">-->
                                                                                <!--                <?php endif; ?>-->
                                                                                <!--                </i><?php echo e($customfield->fieldname); ?>-->
                                                                                <!--            </li>-->
                                                                                <!--    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        -->
                                                                                <!--<?php endif; ?>            -->
                            <!--                                                                                                   <li class="" >-->
                            <!--                                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>Background Music-->
                            <!--                                                                </li>-->
                            <!--                                                                <li class="">-->
                            <!--                                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>3 Length Variations-->
                            <!--                                                                </li>-->
                            <!--                                                                <li class="">-->
                            <!--                                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>Scriptwriting-->
                            <!--                                                                </li>-->
                            <!--                                                                <li class="">-->
                            <!--                                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>60 Seconds Running Time-->
                            <!--                                                                </li>-->
                            <!--                                                                <li class="">-->
                            <!--                                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>1 Size Orientation-->
                            <!--                                                                </li>-->
                            <!--                                                                <li class="">-->
                            <!--                                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>Video Editing-->
                            <!--                                                                </li>-->
                                                                                
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--        </div>-->
                            <!--        <div class="image_desp">-->

                            <!--    <div class="detail_img" id="description">-->
                            <!--        <div class="col-sm-6 md-6">-->
                            <!--            <h2>Gig Quantity</h2>-->
                            <!--        </div>-->
                            <!--        <div class="col-sm-6 md-6 text-right">-->
                                        
                            <!--            <?php echo e(Form::open(array('method' => 'post', 'id' => 'addggiform'))); ?>-->
                            <!--            <input type="hidden" name="type" id="settype" value="basic">-->
                            <!--            <input type="hidden" name="slug" id="gigslug" value="<?php echo e($recordInfo->slug); ?>">-->
                            <!--            <div class="package-footer">-->
                            <!--                <p class="" id="hidebtn">-->
                            <!--                    <?php if(Session::get('user_id') != $recordInfo->user_id): ?>-->
                            <!--                    <span  onclick="submitform()" class="btn btn-md btn-success" style="background-color:#5CB85C;" >Continue-->
                            <!--                        (<?php echo e(CURR); ?><span class="js-str-currency" id="btnprice"><?php echo e($recordInfo->gig_fixed_price); ?></span>)-->
                            <!--                    </span>-->
                            <!--                    <?php endif; ?>-->
                            <!--                </p>-->
                            <!--                <div class="gigdloader" id="gigdloader"><?php echo e(HTML::image("public/img/loading.gif", SITE_TITLE)); ?></div>-->
                                            
                            <!--            </div>-->
                            <!--            <?php echo e(Form::close()); ?>-->
                                        <!--<button class="btn btn-md btn-success" style="width:200px;">Continue ($<?php echo e($recordInfo->gig_fixed_price); ?>)</button>-->
                            <!--        </div>-->
                            <!--    </div>    -->
                            <!--    </div>-->
                            <!--    </div>-->
                            <!--</div>    -->
                            <?php endif; ?>
                        </div>
                        <div class="row" style="margin-bottom:10px;margin-top:10px;">
                            <div class="col-xs-12 md-12"  >
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="btn btn-light btn-sm" style="border: 1px solid #dddddd;background-color:white;"><?php echo e($tag->name); ?></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 md-12"  >
                                <?php if($othergigs->count() >1): ?>
                                    <div class="gig-page-packages-table" id="related"><h3 class="section-title" style="margin-bottom:15px;margin-top:15px;">
                                        Other Gigs Offered By <span style="color:#5CB85C;"><a href="../public-profile/<?php echo e($recordInfo->User->slug); ?>" style="color:#5CB85C;"><?php echo e($recordInfo->User->user_name); ?></a></span></h3>
                                    </div>
                                <?php endif; ?>
                                <?php $__currentLoopData = $othergigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($gig->id != $recordInfo->id): ?>
                                        <div class="col-md-4 sm-4 xs-12" >
                                        <div class="wrappers" style="margin:0px 0px 10px 0px; padding:0px">
                                            <div class="images_list">
                                            <?php
                                                $gigimgname = '';
                                                if ($gig->Image) {
                                                    foreach ($gig->Image as $gigimage) {
                                                        if (isset($gigimage->name) && !empty($gigimage->name)) {
                                                            $path = GIG_FULL_UPLOAD_PATH . $gigimage->name;
                                                            if (file_exists($path) && !empty($gigimage->name)) {
                                                                $gigimgname = GIG_FULL_DISPLAY_PATH . $gigimage['name'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($gigimgname == '' && $gig->youtube_image) {
                                                    if (file_exists(GIG_FULL_UPLOAD_PATH.$gig->youtube_image)) {
                                                        $gigimgname = GIG_FULL_DISPLAY_PATH . $gig->youtube_image;
                                                    }
                                                }
                                                if ($gigimgname == '') {
                                                    $gigimgname = HTTP_PATH.'/public/img/front/dummy.png';
                                                }
                                            ?>
                                            <!--<a href="<?php echo e(URL::to( 'gig-details/'.$gig->slug)); ?>" class=""><img class="lazy" src="<?php echo e(HTTP_PATH); ?>/public/img/loading2.gif" data-original="<?php echo e($gigimgname); ?>"></a>-->
                                            <a href="<?php echo e(URL::to( 'gig-details/'.$gig->slug)); ?>" class=""><img src="<?php echo e($gigimgname); ?>"></a>
                                        </div>   
                                        <div class="bottom_box">
                                            <div class="profilename" style="display:flex; flex-direction:row;">
                                                <span class="dp">
                                                    <!--<img src="http://laravel.seenshop.com/public/files/users/small/14b4dc49_image.jpg" alt="Freelance website">-->
                                                     <?php if(isset($gig->User->profile_image)): ?>
                                                        <?php if(file_exists(PROFILE_FULL_UPLOAD_PATH . $gig->User->profile_image) && !empty($gig->User->profile_image)): ?>
                                                            <?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH . $gig->User->profile_image, SITE_TITLE)); ?>

                                                        <?php else: ?>
                                                            <?php echo e(HTML::image('public/img/front/dummy.png', SITE_TITLE)); ?>

                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                            <?php echo e(HTML::image('public/img/front/dummy.png', SITE_TITLE)); ?>    
                                                    <?php endif; ?>
                                                </span>
                                                <span style="display:flex; flex-direction:column; margin-top:0px;position: relative;left: 5px;top: -5px;">
                                                    <span><a href="../public-profile/<?php echo e($gig->User->slug); ?>"><?php echo e($gig->User->user_name); ?></a></span>
                                                <span style="color: #b2b2b2;font-weight: 500;">Level 1 Seller</span>
                                                </span>
                                            </div>
                                            <div class="list_con">
                                                <a href="/gig-details/<?php echo e($gig->slug); ?>"><?php echo str_limit($gig->title, $limit = 60, $end = ' ...'); ?></a>
                                                </div><a href="http://laravel.seenshop.com/gig-details/php-developer">
                                            <div class="rating-badges-container" style="display:flex; flex-direction:row;">
                                                <span class="review"><i class="fa fa-star"></i> <?php echo e($gig->User->average_rating); ?> <span style="color: #b2b2b2;font-weight: 500;">(<?php echo e($gig->User->total_review); ?>)</span></span> 
                                                <?php if($gig->User->user_status =='Online'): ?>
                                                <span class="" style="font-size:12px;color:#28a745;background-color:white;  padding-left:3px;padding-right:16px; border-radius:16px;">Online</span>
                                                <?php else: ?>
                                                <span class=" " style="color: white;background-color:white; border: 1px solid white; padding-left:3px;padding-right:3px; border-radius:16px;">Offline</span>
                                                <?php endif; ?>
                                            </div>
                                            </a>
                                            <div class="bottom_row">
                                               <?php if($gig->basic_price != 0): ?>
                                                    <span style="font-size: 14px;color: #666; float:right; ">Starting at <a href="<?php echo e(URL::to( 'gig-details/'.$gig->slug)); ?>" style="font-size:18px;" >$<?php echo e($gig->basic_price); ?></a></span>
                                               <?php else: ?>
                                                    <span style="font-size: 14px;color: #666; float:right; ">Fixed Price <a href="<?php echo e(URL::to( 'gig-details/'.$gig->slug)); ?>" style="font-size:18px;" >$<?php echo e($gig->gig_fixed_price); ?></a></span>
                                               <?php endif; ?>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                                    <?php endif; ?>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                
                            </div>
                        </div>
                </div>
                <div class=" col-xs-12 col-md-4 sticky">
                    <?php if($recordInfo->basic_title != ''): ?>
                        <div class="offer_wrap_top" style="width: 100%; background: #fff; ">

                        <!-- Nav tabs -->
                        <ul class="offer-nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab" onclick="updateprice('<?php echo e($recordInfo->basic_price); ?>', 'basic')">Basic</a></li>
                            <li role="presentation"><a href="#standard" aria-controls="standard" role="tab" data-toggle="tab" onclick="updateprice('<?php echo e($recordInfo->standard_price); ?>', 'standard')">Standard</a></li>
                            <li role="presentation"><a href="#premium" aria-controls="premium" role="tab" data-toggle="tab" onclick="updateprice('<?php echo e($recordInfo->premium_price); ?>', 'premium')">Premium</a></li>  
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="basic">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text"><?php echo e($recordInfo->basic_title); ?></span>
                                        <span class="package-price"><?php echo e(CURR.$recordInfo->basic_price); ?></span>
                                    </div>
                                    <p class="package-description"><?php echo e($recordInfo->basic_description); ?></p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time"><?php echo e($recordInfo->basic_delivery); ?> days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            <?php echo e($recordInfo->basic_revision); ?> Revision
                                        </span>
                                        <ul class="buyables-offer">
                                                                                <?php if(!empty($recordInfo->GigCustom)): ?>
                                                                                    <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li class="" >
                                                                                                <?php if($customfield->check1 == 1): ?>
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    <?php else: ?> 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                <?php endif; ?>
                                                                                                </i><?php echo e($customfield->fieldname); ?>

                                                                                            </li>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                                                                                <?php endif; ?>            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="standard">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text"><?php echo e($recordInfo->standard_title); ?></span>
                                        <span class="package-price"><?php echo e(CURR.$recordInfo->standard_price); ?></span>
                                    </div>
                                    <p class="package-description"><?php echo e($recordInfo->standard_description); ?></p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time"><?php echo e($recordInfo->standard_delivery); ?> days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            <?php echo e($recordInfo->standard_revision); ?> Revision
                                        </span>
                                        <ul class="buyables-offer">
                                                                                <?php if(!empty($recordInfo->GigCustom)): ?>
                                                                                    <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li class="" >
                                                                                                <?php if($customfield->check2 == 1): ?>
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    <?php else: ?> 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                <?php endif; ?>
                                                                                                </i><?php echo e($customfield->fieldname); ?>

                                                                                            </li>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                                                                                <?php endif; ?>      
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="basic">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text"><?php echo e($recordInfo->basic_title); ?></span>
                                        <span class="package-price"><?php echo e(CURR.$recordInfo->basic_price); ?></span>
                                    </div>
                                    <p class="package-description"><?php echo e($recordInfo->basic_description); ?></p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time"><?php echo e($recordInfo->basic_delivery); ?> days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            <?php echo e($recordInfo->basic_revision); ?> Revision
                                        </span>
                                        <ul class="buyables-offer">
                                            <!--                                                <li class="" >
                                                                                                <i class="fa fa-check"></i>Background Music
                                                                                            </li>
                                                                                            <li class="">
                                                                                                <i class="fa fa-check"></i>3 Length Variations
                                                                                            </li>
                                                                                            <li class="">
                                                                                                <i class="fa fa-check"></i>Scriptwriting
                                                                                            </li>
                                                                                            <li class="">
                                                                                                <i class="fa fa-check"></i>60 Seconds Running Time
                                                                                            </li>
                                                                                            <li class="">
                                                                                                <i class="fa fa-check"></i>1 Size Orientation
                                                                                            </li>
                                                                                            <li class="">
                                                                                                <i class="fa fa-check"></i>Video Editing
                                                                                            </li>-->
                                                                                            
                                                                                             <?php if(!empty($recordInfo->GigCustom)): ?>
                                                                                    <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li class="" >
                                                                                                <?php if($customfield->check1 == 1): ?>
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    <?php else: ?> 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                <?php endif; ?>
                                                                                                </i><?php echo e($customfield->fieldname); ?>

                                                                                            </li>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                                                                                <?php endif; ?>   
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="premium">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text"><?php echo e($recordInfo->premium_title); ?></span>
                                        <span class="package-price"><?php echo e(CURR.$recordInfo->premium_price); ?></span>
                                    </div>
                                    <p class="package-description"><?php echo e($recordInfo->premium_description); ?></p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time"><?php echo e($recordInfo->premium_delivery); ?> days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            <?php echo e($recordInfo->premium_revision); ?> Revision
                                        </span>
                                        <ul class="buyables-offer">
                                                                                <?php if(!empty($recordInfo->GigCustom)): ?>
                                                                                    <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li class="" >
                                                                                                <?php if($customfield->check3 == 1): ?>
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    <?php else: ?> 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                <?php endif; ?>
                                                                                                </i><?php echo e($customfield->fieldname); ?>

                                                                                            </li>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                                                                                <?php endif; ?>     
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::open(array('method' => 'post', 'id' => 'addggiform'))); ?>

                            <input type="hidden" name="type" id="settype" value="basic">
                            <input type="hidden" name="slug" id="gigslug" value="<?php echo e($recordInfo->slug); ?>">
                            <div class="package-footer">
                                <p class="" id="hidebtn">
                                    <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                    <span  onclick="submitform()" class="btn-lrg-standard" >Continue
                                        (<?php echo e(CURR); ?><span class="js-str-currency" id="btnprice"><?php echo e($recordInfo->basic_price); ?></span>)
                                    </span>
                                    <?php elseif(Session::get('user_id') == $recordInfo->user->id): ?>
                                                <a class="btn btn-lg btn-block btn-success rounded-0" href="../gigs/edit/<?php echo e($recordInfo->slug); ?>">Edit Gig</a>
                                    
                                    <?php endif; ?>
                                </p>
                                <div class="gigdloader" id="gigdloader"><?php echo e(HTML::image("public/img/loading.gif", SITE_TITLE)); ?></div>
                                <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                <div class="text-center" ><a href="#"  style="color:#5CB85C;font-size:14px;">Send Custom Offer <i class="fa fa-paper-plane"></i></a></div>
                                <?php endif; ?>
                            </div>
                            <?php echo e(Form::close()); ?>

                            
                        </div>
                        
                    </div>
                    <?php else: ?>
                        <div class="col-sm-12 md-12" style="width: 100%; background: #fff; padding: 15px 25px;">
                                    <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text" style="width:85% !important;"><?php echo e($recordInfo->title); ?></span>
                                        <span class="package-price" style=" width:5%; margin-right: 0px; font-size:16px; font-weight:400;"><?php echo e(CURR.$recordInfo->gig_fixed_price); ?></span>
                                    </div>
                                    <!--<p ><?php echo $recordInfo->description; ?></p>-->
                                    <p></p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time"><?php echo e($recordInfo->gig_fixed_delivery); ?> days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            <?php echo e($recordInfo->gig_fixed_revision); ?> Revision
                                        </span>
                                        <ul class="buyables-offer">
                                            
                                                                                <?php if(!empty($recordInfo->GigCustom)): ?>
                                                                                    <?php $__currentLoopData = $recordInfo->GigCustom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li class="" >
                                                                                                <?php if($customfield->check1 == 1): ?>
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    <?php else: ?> 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                <?php endif; ?>
                                                                                                </i><?php echo e($customfield->fieldname); ?>

                                                                                            </li>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                                                                                <?php endif; ?>            
                                                                                            <!--                                   <li class="" >-->
                                                                                            <!--    <i class="fa fa-check" style="color:#5CB85C;"></i>Background Music-->
                                                                                            <!--</li>-->
                                                                                            <!--<li class="">-->
                                                                                            <!--    <i class="fa fa-check" style="color:#5CB85C;"></i>3 Length Variations-->
                                                                                            <!--</li>-->
                                                                                            <!--<li class="">-->
                                                                                            <!--    <i class="fa fa-check" style="color:#5CB85C;"></i>Scriptwriting-->
                                                                                            <!--</li>-->
                                                                                            <!--<li class="">-->
                                                                                            <!--    <i class="fa fa-check" style="color:#5CB85C;"></i>60 Seconds Running Time-->
                                                                                            <!--</li>-->
                                                                                            <!--<li class="">-->
                                                                                            <!--    <i class="fa fa-check" style="color:#5CB85C;"></i>1 Size Orientation-->
                                                                                            <!--</li>-->
                                                                                            <!--<li class="">-->
                                                                                            <!--    <i class="fa fa-check" style="color:#5CB85C;"></i>Video Editing-->
                                                                                            <!--</li>-->
                                                                                
                                        </ul>
                                    </div>
                                    </div>
                                   <?php echo e(Form::open(array('method' => 'post', 'id' => 'addggiform'))); ?>

                                        <input type="hidden" name="type" id="settype" value="fixed">
                                        <input type="hidden" name="slug" id="gigslug" value="<?php echo e($recordInfo->slug); ?>">
                                        <input type="hidden" name="gigprice" id="gigprice" value="<?php echo e($recordInfo->gig_fixed_price); ?>">
                                        <div class="package-footer">
                                            <p class="" id="hidebtn">
                                                <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                                <span  onclick="submitform()" class="btn-lrg-standard" >Continue
                                                    (<?php echo e(CURR); ?><span class="js-str-currency" id="btnprice"><?php echo e($recordInfo->gig_fixed_price); ?></span>)
                                                </span>
                                                <?php elseif(Session::get('user_id') == $recordInfo->user->id): ?>
                                                <a class="btn btn-lg btn-block btn-success rounded-0" href="../gigs/edit/<?php echo e($recordInfo->slug); ?>">Edit Gig</a>
                                                <?php endif; ?>
                                            </p>
                                            <!--<div class="gigdloader" id="gigdloader"><?php echo e(HTML::image("public/img/loading.gif", SITE_TITLE)); ?></div>-->
                                            <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                                            <div class="text-center" ><a href="#"  style="color:#5CB85C;font-size:14px;">Send Custom Offer <i class="fa fa-paper-plane"></i></a></div>
                                            <?php endif; ?>
                                </div>
                                <?php echo e(Form::close()); ?>

                                </div>
                    
                    <?php endif; ?>
                    <div class="about_seller offer_wrap_top"  style="width: 100%;margin-top:15px; background: #fff; padding: 15px 25px;" >
                           
                            <div class="card-body " style="padding:15px;">
                              <center class="mb-4">
                                <img src="/public/files/users/small/<?php echo e($recordInfo->User->profile_image); ?>" width="130" style="border-radius:50%;">
                                </center>
                              <h3 class="text-center h3">
                              <a class="text-success" href="../public-profile/<?php echo e($gig->User->slug); ?>">
                              <?php echo e($recordInfo->User->user_name); ?>  </a> | <span class="divider"> </span> <span class="text-muted">Level 1 Seller</span>
                              </h3>
                              <?php if(Session::get('user_id') != $recordInfo->user_id): ?>
                              <?php if(auth()->guard()->check()): ?>
                                <a href="javascript:void(0);"  onclick='$("#info12").show();'data-toggle="modal" data-target="#myModal2" class="btn btn-lg btn-block btn-success rounded-0">Message me</a>
                              <?php endif; ?>    
                              <?php endif; ?>        
                                <hr>
                              <div class="row">
                              <div class="col-md-6">
                              <p class="text-muted"><i class="fa fa-check pr-1" style="color:#5CB85C;"></i> From</p>
                              </div>
                              <div class="col-md-6">
                                 <?php if($recordInfo->User->Country): ?>
                                    <p><?php echo e($recordInfo->User->Country->name); ?></p>
                                    <?php else: ?>
                                    <p>Unavailable</p>
                              <?php endif; ?>
                              </div>
                              <div class="col-md-6">
                              <p class="text-muted"><i class="fa fa-check pr-1" style="color:#5CB85C;"></i>  Speaks</p>
                              </div>
                              <div class="col-md-6">
                              <p>
                                  
                                <span> 
                                    English, French
                                </span>
                                </p>
                              </div>
                              <div class="col-md-6">
                              <p class="text-muted"><i class="fa fa-check pr-1" style="color:#5CB85C;"></i>  Positive Reviews</p>
                              <p class="text-muted"><i class="fa fa-check pr-1" style="color:#5CB85C;"></i> Recent Delivery</p>
                              </div>
                              <div class="col-md-6">
                              <p> 0% </p>
                              <p> none </p>
                              </div>
                              </div>
                              <hr>
                              <p class="text-left ">  </p>
                              <p class="text-viewer" ><?php echo $recordInfo->User->description; ?></p>
                            </div>
                            
                        </div>
                    
                </div>
            </div>

        </div>
    </section>
    <div class="modal fade publicprofile_modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="nzwh-wrapper">
                <fieldset class="nzwh">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> Send a Message</h4>
                    </div>
                    <div class="drt">
                        <div class="right_pop">
                            <div class="profile-img">
                                <?php if($recordInfo->User->profile_image): ?>
                                <?php echo e(HTML::image(PROFILE_SMALL_DISPLAY_PATH.$recordInfo->User->profile_image, SITE_TITLE, ['id'=> 'pimage'])); ?>

                                <?php else: ?>
                                <?php echo e(HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])); ?>

                                <?php endif; ?>
                            </div>
                            <div class="con_sec">
                                <h4>Please include:</h4>
                                <ul>
                                    <li>Project description</li>
                                    <li>Specific instructions</li>
                                    <li>Relevant files</li>
                                    <li>Your budget</li>
                                </ul>
                            </div>
                        </div>
                        <div class="left_pop">
                            <div class="form_sec">                        
                                <?php echo e(Form::open(array('method' => 'post', 'id' => 'contactmessage','url' => 'users/messageuser', 'enctype' => "multipart/form-data"))); ?>

                                <div class="contact_div">
                                    <?php echo e(Form::textarea('message','', ['class'=>'form-control required', 'placeholder'=>'', 'autocomplete' => 'off', 'minlength' => '0', 'maxlength' => '2500', 'id'=>'messageid','onkeyup'=>"countChar()"])); ?>

                                    <div class="sec_blw_top">
                                        <div class="sec_blw">
                                            <span id="charcount">0/2500</span>
                                            <span class="right_sp">
                                                <?php echo e(Form::file('attachment', ['class'=>'form-control', 'accept'=>'image/png'])); ?>

                                            </span>
                                        </div>
                                        <div class="upbtn">
                                            <?php echo e(Form::hidden('receiver_id', $recordInfo->User->id, ['id'=>'receiver_id'])); ?>

                                            <!--<button type="button" class="succbtn" id="succbtnbtn">Send</button>-->
                                            <?php echo e(Form::submit('Send', ['class' => 'succbtn', 'id'=>'succbtnbtn'])); ?>

                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
    </div>
</div>
</div>

<script>
                                    function updateprice(price, ptype){
                                    $('#btnprice').html(price);
                                            $('#settype').val(ptype);
                                    }
//    
                            function submitform(){
                            <?php if(!Session::get('user_id')): ?>
                                    alert('Your must login to place your order.');
                                    <?php else: ?>
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform').serialize(),
                                            //data: { _token: '<?php echo e(csrf_token()); ?>'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            beforeSend: function () {$("#gigdloader").show();  },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    <?php endif; ?>
                            }
                            function submitform1(){
                            <?php if(!Session::get('user_id')): ?>
                                    alert('Your must login to place your order.');
                                    <?php else: ?>
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform1').serialize(),
                                            //data: { _token: '<?php echo e(csrf_token()); ?>'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    <?php endif; ?>
                            }
                            
                            function submitform2(){
                            <?php if(!Session::get('user_id')): ?>
                                    alert('Your must login to place your order.');
                                    <?php else: ?>
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform2').serialize(),
                                            //data: { _token: '<?php echo e(csrf_token()); ?>'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    <?php endif; ?>
                            }
                            function submitform3(){
                            <?php if(!Session::get('user_id')): ?>
                                    alert('Your must login to place your order.');
                                    <?php else: ?>
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform3').serialize(),
                                            //data: { _token: '<?php echo e(csrf_token()); ?>'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    <?php endif; ?>
                            }

                            $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                            });
                                    $("#maraction").click(function () {
                            $("#offer-show").addClass("offer-div");
                                    $(".dashboard-rights-section").removeClass("offer-div");
                            });</script>
<script>
                                    $(function () {
                                    // here the code for text minimiser and maxmiser by faisal khan
                                    var minimized_elements = $('p.text-viewer');
                                            minimized_elements.each(function () {
                                            var t = $(this).text();
                                                    if (t.length < 200)
                                                    return;
                                                    $(this).html(
                                                    t.slice(0, 200) + '<span>... </span><a href="#" class="more"> + See More </a>' +
                                                    '<span style="display:none;">' + t.slice(200, t.length) + ' <a href="#" class="less"> - See Less </a></span>'
                                                    );
                                            });
                                            $('a.more', minimized_elements).click(function (event) {
                                    event.preventDefault();
                                            $(this).hide().prev().hide();
                                            $(this).next().show();
                                    });
                                            $('a.less', minimized_elements).click(function (event) {
                                    event.preventDefault();
                                            $(this).parent().hide().prev().show().prev().show();
                                    });
                                    });</script>
<script>
                            jQuery(document).ready(function () {
                            function close_accordion_section() {
                            jQuery('.accordion .accordion-section-title').removeClass('active');
                                    jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
                            }

                            jQuery('.accordion-section-title').click(function (e) {
                            // Grab current anchor value
                            var currentAttrValue = jQuery(this).attr('href');
                                    if (jQuery(e.target).is('.active')) {
                            close_accordion_section();
                            } else {
                            close_accordion_section();
                                    // Add active class to section title
                                    jQuery(this).addClass('active');
                                    // Open up the hidden content panel
                                    jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
                            }

                            e.preventDefault();
                            });
                            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seenshop/laravelvue.seenshop.com/resources/views/gigs/detail.blade.php ENDPATH**/ ?>