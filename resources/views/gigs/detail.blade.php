@extends('layouts.dashboard')
@section('content')
<!--{{ HTML::script('public/js/front/lightslider.js')}}-->
<!--<script src="{{ asset('/public/js/front/lightslider.js') }}" ></script>-->
 <!--<script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/front/bootstrap.min.js"></script>-->
 
<!--{{ HTML::script('public/js/jquery.raty.min.js'), 'defer'}}-->
<!--{{ HTML::style('public/css/front/lightslider.css')}}-->

<div class="main_dashboard">
    @include('elements.topcategories')
    <section class="dashboard-section">
        <div class="container">
            <div class="row" style=" margin-bottom:10px;">
                <div class="col-xs-12 col-md-12 hidden-xs hidden-sm">
                    <div class="top_row_new" style="padding:0px 5px 0px 5px !important">
                        <ul class="nav navbar-nav" style="font-size:14px; ">
                            <li class="dropdown" style="margin-right:25px; margin-left:15px;   border-bottom:3px solid #35A7A7; "><a href="#intro" style="color:#35A7A7 !important;" >Introduction</a></li>
                            <li class="dropdown"  style="margin-right:25px;"><a href="#description" style="color:#35A7A7 !important;" >Proposal Details</a></li>
                            <li class="dropdown"  style="margin-right:25px;"><a href="../public-profile/{{$recordInfo->User->slug}}" style="color:#35A7A7 !important;">Reviews</a></li>
                            <li class="dropdown"  style="margin-right:25px;"><a href="#related" style="color:#35A7A7 !important;">Related Proposals</a></li>
                             @if(Session::get('user_id') != $recordInfo->user->id)
                                <li class="dropdown"  style="margin-right:25px;"><a href="javascript:void(0);"  onclick='$("#info12").show();'data-toggle="modal" data-target="#myModal2" style="color:#35A7A7 !important;"><i class="far fa-comments"></i> Message the seller</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>    
            <div class="row" id="app">
                <div class="col-xs-12 col-md-8">
                    <div class="top_row_new">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-xs-12 md-12">
                                <h3 class="left_title">{{$recordInfo->title}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 md-7" >
                                <div class="col-xs-12 text-left" style="padding-bottom:10px; padding-left:0px;">
                                    <nav  style="font-size:14px;font-weight:600; color:#777777; padding-left:0px !important; align-content:left">
                                      <a href="../../">Home</a> >
                                      <a href="../gigs/{{$parentcat->slug}}">{{$parentcat->name}}</a> >
                                      
                                        <a href="../gigs/{{$parentcat->slug}}/{{$subcat->slug}}">{{$subcat->name}}</a>
                                      
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
                                <!--                                start: {{$recordInfo -> User -> average_rating}},-->
                                <!--                                readOnly: true-->
                                <!--                        });-->
                                <!--                        });</script>-->
                                <!--            <span class="pprate gigdtlrat" id="avgRating22"></span>-->
                                
                                <!--</div>-->
                                <!--<div class="ratings" style="position: in-line;">-->
                                <!--  <div class="empty-stars"></div>-->
                                <!--  <div class="full-stars" style="width:{{ $recordInfo->User->average_rating * 20 }}%"> </div>-->
                                <!--</div> (2)-->
                                <div class="col-xs-12 text-left" style="padding-left:0px !important; margin-bottom:10px;">
                                    
                                        <div style="display:flex; flex-direction:row;"><gig-rating :rate="{{ $recordInfo->User->average_rating }}"></gig-rating>
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
                            <gig-images :images="{{ $recordInfo->Image }}"></gig-images>
                            <!--<carousel-home></carousel-home>-->
                        </div>
                        
                        <div class="image_desp">

                            <div class="detail_img" id="description">
                                <h2>Description</h2>
                                {!! nl2br($recordInfo->description) !!}
                            </div>    
                        </div>
                        @if(!empty($recordInfo->Gigfaq) && count($recordInfo->Gigfaq) > 0)
                        <div id="four" class="same_box">
                            <div class="table">
                                <h4 class="gig-fancy-header">Frequently Asked Questions</h4>
                            </div>  
                            <div class="accordion">
                                @foreach ($recordInfo->Gigfaq as $key => $gigfaq)
                                <div class="accordion-section">
                                    <a class="accordion-section-title" href="#accordion-{{$key}}">{{$gigfaq->question}}</a>
                                    <div id="accordion-{{$key}}" class="accordion-section-content">
                                        <p>{{$gigfaq->answer}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(!empty($recordInfo->Gigextra) && count($recordInfo->Gigextra) > 0)
                        <div id="four" class="same_box">
                            <div class="table">
                                <h4 class="gig-fancy-header">Gig Extras</h4>
                            </div>  
                            <div class="accordion">
                                <?php global $delivery_days; ?>
                                @foreach ($recordInfo->Gigextra as $key => $gigextraa)
                                <div class="accordion-section">
                                    <a class="accordion-section-title" href="#accordion-{{$gigextraa->id}}">{{$gigextraa->title}}</a>
                                    <div id="accordion-{{$gigextraa->id}}" class="accordion-section-content">
                                        <p>{{$gigextraa->description}}</p>
                                        <p><strong>Delivery Time : </strong>{{$delivery_days[$gigextraa->delivery]}}</p>
                                        <p><strong>Price : </strong>${{$gigextraa->price}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(!empty($recordInfo->pdf_doc))
                        @php $pdf_doc = explode(',',$recordInfo->pdf_doc) @endphp
                        @if(count(array_filter($pdf_doc) > 0))
                        <div id="four" class="same_box">
                            <div class="table">
                                <h4 class="gig-fancy-header">GIG Documents</h4>
                            </div>  
                            <div class="accordion-doc">
                                <ul>
                                    @foreach (array_filter($pdf_doc) as $attachmental)
                                    @if(file_exists(GIG_DOC_FULL_UPLOAD_PATH.$attachmental) && $attachmental!="")
                                    <li data-img="{{$attachmental}}" class="portfolio-cc">{{substr($attachmental,9)}}<a href="{{GIG_DOC_FULL_DISPLAY_PATH.$attachmental}}" class="delete" download><i class="fa fa-download"></i></a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @endif
                        
                        <!--@if(!$gigreviews->isEmpty())-->
                                
                        <!--        <div class="client-rievews gigdtl_pg"> -->
                        <!--            <h3>Reviews</h3>-->
                        <!--            @foreach($gigreviews as $allrecord)-->
                        <!--            <div class="client-chat gigdtl_pgin">-->
                        <!--                <div class="clientimg-about">-->
                        <!--                    @if($allrecord->Otheruser->profile_image)-->
                        <!--                    <a href="{{ URL::to( 'public-profile/'.$allrecord->Otheruser->slug)}}" class="">{{HTML::image(PROFILE_SMALL_DISPLAY_PATH.$allrecord->Otheruser->profile_image, SITE_TITLE)}}</a>-->
                        <!--                    @else-->
                        <!--                    <a href="{{ URL::to( 'public-profile/'.$allrecord->Otheruser->slug)}}" class="">{{HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])}}</a>-->
                        <!--                    @endif-->
                        <!--                </div>-->
                        <!--                <div class="client-rv">-->
                        <!--                    <h3><a href="{{ URL::to( 'public-profile/'.$allrecord->Otheruser->slug)}}" class="">{{$allrecord->Otheruser->user_name}}</a></h3>-->
                        <!--                    <span class="review-date"><i class="fa fa-calendar" aria-hidden="true"></i>{{$allrecord->created_at->diffForHumans()}}</span>-->
                        <!--                    <div class="client-review-reting">-->
                        <!--                        <script>-->
                        <!--                                    $(function() {-->
                        <!--                                    $('#lst{{$allrecord->id}}').raty({-->
                        <!--                                    starOn:    'star-on.png',-->
                        <!--                                            starOff:   'star-off.png',-->
                        <!--                                            start: {{$allrecord -> rating}},-->
                        <!--                                            readOnly: true-->
                        <!--                                    });-->
                        <!--                                    });</script>-->
                        <!--                        <span class="lstreview lstreview_new" id="lst{{$allrecord->id}}"></span>-->
                        <!--                        <b>{{$allrecord->rating}}</b>-->
                        <!--                    </div>-->
                        <!--                    <p>-->
                        <!--                        {{nl2br($allrecord->comment)}}-->
                        <!--                    </p>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            @endforeach                                -->
                        <!--        </div>-->
                        <!--        @endif-->

                        
                        
                    </div>
                    <div class="row">
                            @if($recordInfo->basic_title != '')
                                <div class="col-xs-12 md-12 hidden-xs hidden-sm">
                                <div class="gig-page-packages-table"><h3 class="section-title" style="margin-bottom:15px;margin-top:15px;">Compare Packages</h3>
                                <table class="table" style="border-top-style:none; ">
                                  
                                  <tbody>
                                    <tr  style="border-bottom-style:none;">
                                      <td><h4 style="margin-top:10px;">Package</h4></td>
                                      <td>
                                          <h4 style="margin-top:10px;">${{$recordInfo->basic_price}}</h4>
                                      <h3 style="margin-top:15px;">Basic</h3>
                                      <h5 style="margin-top:15px;">{{$recordInfo->basic_title}}</h5>
                                      <p style="margin-top:10px;">
                                          {{$recordInfo->basic_description}}
                                      </p>
                                      </td>
                                      <td>
                                          <h4 style="margin-top:10px;">${{$recordInfo->standard_price}}</h4>
                                      <h3 style="margin-top:15px;">Standard</h3>
                                      <h5 style="margin-top:15px;">{{$recordInfo->standard_title}}</h5>
                                      <p style="margin-top:10px;">
                                          {{$recordInfo->standard_description}}
                                      </p>
                                      </td>
                                      <td>
                                          <h4 style="margin-top:10px;">${{$recordInfo->premium_price}}</h4>
                                      <h3 style="margin-top:15px;">Premium</h3>
                                      <h5 style="margin-top:15px;">{{$recordInfo->premium_title}}</h5>
                                      <p style="margin-top:10px;">
                                          {{$recordInfo->premium_description}}
                                      </p>
                                      </td>
                                    </tr>
                                     @if(!empty($recordInfo->GigCustom))
                                        @foreach($recordInfo->GigCustom as $customfield)
                                            <tr>
                                              <td>{{$customfield->fieldname}}</td>
                                              <td class="text-center">
                                                @if($customfield->check1)
                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>
                                                @else
                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                @endif  
                                              </td>
                                              <td class="text-center">
                                                @if($customfield->check2)
                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>
                                                @else
                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                @endif  
                                              </td>
                                              <td class="text-center">
                                                @if($customfield->check3)
                                                    <i class="fa fa-check" style="color:#5CB85C;"></i>
                                                @else
                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                @endif  
                                              </td>
                                              
                                            </tr>                                        
                                        @endforeach
                                     @endif                                                    
                                     
                                    <tr>
                                      <td>Revisions</td>
                                      <td class="text-center">{{$recordInfo->basic_revision}}</td>
                                      <td class="text-center">{{$recordInfo->standard_revision}}</td>
                                      <td class="text-center">{{$recordInfo->premium_revision}}</td>
                                    </tr>
                                    <tr>
                                      <td>Delivery Time</td>
                                      <td class="text-center">{{$recordInfo->basic_delivery}} day</td>
                                      <td class="text-center">{{$recordInfo->standard_delivery}} days</td>
                                      <td class="text-center">{{$recordInfo->premium_delivery}} days</td>
                                    </tr>
                                    <tr>
                                      <td>Total</td>
                                      <td class="text-center">
                                          <p>${{$recordInfo->basic_price}}</p>
                                           {{ Form::open(array('method' => 'post', 'id' => 'addggiform1')) }}
                                        <input type="hidden" name="type"  value="basic">
                                        <input type="hidden" name="slug"  value="{{$recordInfo->slug}}">
                                       <input type="hidden" name="gigprice"  value="{{$recordInfo->basic_price}}">
                                        <div class="package-footer">
                                            <p class="" >
                                                @if(Session::get('user_id') != $recordInfo->user_id)
                                                <span  onclick="submitform1()" class="btn btn-md btn-success" style="width:200px;">Select
                                                    
                                                </span>
                                                @endif
                                            </p>
                                            
                                            </div>
                                            {{ Form::close()}}
                                          
                                      </td>
                                      <td class="text-center">
                                          <p>${{$recordInfo->standard_price}}</p>
                                          {{ Form::open(array('method' => 'post', 'id' => 'addggiform2')) }}
                                        <input type="hidden" name="type"  value="standard">
                                        <input type="hidden" name="slug"  value="{{$recordInfo->slug}}">
                                       <input type="hidden" name="gigprice"  value="{{$recordInfo->standard_price}}">
                                        <div class="package-footer">
                                            <p class="" >
                                                @if(Session::get('user_id') != $recordInfo->user_id)
                                                <span  onclick="submitform2()" class="btn btn-md btn-success" style="width:200px;">Select
                                                    
                                                </span>
                                                @endif
                                            </p>
                                            
                                            </div>
                                            {{ Form::close()}}
                                      </td>
                                      <td class="text-center">
                                          <p>${{$recordInfo->premium_price}}</p>
                                          {{ Form::open(array('method' => 'post', 'id' => 'addggiform3')) }}
                                        <input type="hidden" name="type"  value="premium">
                                        <input type="hidden" name="slug"  value="{{$recordInfo->slug}}">
                                       <input type="hidden" name="gigprice"  value="{{$recordInfo->premium_price}}">
                                        <div class="package-footer">
                                            <p class="" >
                                                @if(Session::get('user_id') != $recordInfo->user_id)
                                                <span  onclick="submitform3()" class="btn btn-md btn-success" style="width:200px;">Select
                                                    
                                                </span>
                                                @endif
                                            </p>
                                            
                                            </div>
                                            {{ Form::close()}}
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                </div>
                            </div>
                            @else
                            <!--<div class="col-xs-12 md-12" style="margin-bottom:15px;margin-top:15px;">-->
                            <!--    <div class="gig-page-packages-table"><h3 class="section-title" style="margin-bottom:15px;margin-top:15px;">Order Details</h3>-->
                            <!--    </div>-->
                            <!--    <div class="col-sm-12 md-12" style="width: 100%; background: #fff; padding: 15px 25px;">-->
                            <!--        <div class="offer-bxs">-->
                            <!--        <div class="offer-bxs-price">-->
                            <!--            <span class="package-title-text">{{$recordInfo->title}}</span>-->
                            <!--            <span class="package-price">{{CURR.$recordInfo->gig_fixed_price}}</span>-->
                            <!--        </div>-->
                            <!--        <p >{!! $recordInfo->description !!}</p>-->
                            <!--        <div class="offers-details">-->
                            <!--            <span class="offer-icons">-->
                            <!--                <i class="fa fa-clock-o fa-lg"></i>-->
                            <!--                <span class="delivery-time">{{$recordInfo->gig_fixed_delivery}} days</span>-->
                            <!--                Delivery-->
                            <!--            </span>-->
                            <!--            <span class="offer-icons">-->
                            <!--                <i class="fa fa-refresh fa-lg"></i>-->
                            <!--                {{$recordInfo->gig_fixed_revision}} Revision-->
                            <!--            </span>-->
                            <!--            <ul class="buyables-offer">-->
                                            
                                                                                <!--@if(!empty($recordInfo->GigCustom))-->
                                                                                <!--    @foreach($recordInfo->GigCustom as $customfield)-->
                                                                                <!--            <li class="" >-->
                                                                                <!--                @if($customfield->check1 == 1)-->
                                                                                <!--                    <i class="fa fa-check" style="color:#5CB85C;">-->
                                                                                <!--                    @else -->
                                                                                <!--                    <i class="fa fa-check" style="color:#D0D0D0;">-->
                                                                                <!--                @endif-->
                                                                                <!--                </i>{{$customfield->fieldname}}-->
                                                                                <!--            </li>-->
                                                                                <!--    @endforeach        -->
                                                                                <!--@endif            -->
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
                                        
                            <!--            {{ Form::open(array('method' => 'post', 'id' => 'addggiform')) }}-->
                            <!--            <input type="hidden" name="type" id="settype" value="basic">-->
                            <!--            <input type="hidden" name="slug" id="gigslug" value="{{$recordInfo->slug}}">-->
                            <!--            <div class="package-footer">-->
                            <!--                <p class="" id="hidebtn">-->
                            <!--                    @if(Session::get('user_id') != $recordInfo->user_id)-->
                            <!--                    <span  onclick="submitform()" class="btn btn-md btn-success" style="background-color:#5CB85C;" >Continue-->
                            <!--                        ({{CURR}}<span class="js-str-currency" id="btnprice">{{$recordInfo->gig_fixed_price}}</span>)-->
                            <!--                    </span>-->
                            <!--                    @endif-->
                            <!--                </p>-->
                            <!--                <div class="gigdloader" id="gigdloader">{{HTML::image("public/img/loading.gif", SITE_TITLE)}}</div>-->
                                            
                            <!--            </div>-->
                            <!--            {{ Form::close()}}-->
                                        <!--<button class="btn btn-md btn-success" style="width:200px;">Continue (${{$recordInfo->gig_fixed_price }})</button>-->
                            <!--        </div>-->
                            <!--    </div>    -->
                            <!--    </div>-->
                            <!--    </div>-->
                            <!--</div>    -->
                            @endif
                        </div>
                        <div class="row" style="margin-bottom:10px;margin-top:10px;">
                            <div class="col-xs-12 md-12"  >
                                @foreach($tags as $tag)
                                    <button class="btn btn-light btn-sm" style="border: 1px solid #dddddd;background-color:white;">{{$tag->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 md-12"  >
                                @if($othergigs->count() >1)
                                    <div class="gig-page-packages-table" id="related"><h3 class="section-title" style="margin-bottom:15px;margin-top:15px;">
                                        Other Gigs Offered By <span style="color:#5CB85C;"><a href="../public-profile/{{$recordInfo->User->slug}}" style="color:#5CB85C;">{{ $recordInfo->User->user_name}}</a></span></h3>
                                    </div>
                                @endif
                                @foreach($othergigs as $gig)
                                    @if($gig->id != $recordInfo->id)
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
                                            <!--<a href="{{ URL::to( 'gig-details/'.$gig->slug)}}" class=""><img class="lazy" src="{{HTTP_PATH}}/public/img/loading2.gif" data-original="{{$gigimgname}}"></a>-->
                                            <a href="{{ URL::to( 'gig-details/'.$gig->slug)}}" class=""><img src="{{$gigimgname}}"></a>
                                        </div>   
                                        <div class="bottom_box">
                                            <div class="profilename" style="display:flex; flex-direction:row;">
                                                <span class="dp">
                                                    <!--<img src="http://laravel.seenshop.com/public/files/users/small/14b4dc49_image.jpg" alt="Freelance website">-->
                                                     @if (isset($gig->User->profile_image))
                                                        @if (file_exists(PROFILE_FULL_UPLOAD_PATH . $gig->User->profile_image) && !empty($gig->User->profile_image))
                                                            {{HTML::image(PROFILE_SMALL_DISPLAY_PATH . $gig->User->profile_image, SITE_TITLE)}}
                                                        @else
                                                            {{HTML::image('public/img/front/dummy.png', SITE_TITLE)}}
                                                        @endif
                                                    @else
                                                            {{HTML::image('public/img/front/dummy.png', SITE_TITLE)}}    
                                                    @endif
                                                </span>
                                                <span style="display:flex; flex-direction:column; margin-top:0px;position: relative;left: 5px;top: -5px;">
                                                    <span><a href="../public-profile/{{$gig->User->slug}}">{{$gig->User->user_name}}</a></span>
                                                <span style="color: #b2b2b2;font-weight: 500;">Level 1 Seller</span>
                                                </span>
                                            </div>
                                            <div class="list_con">
                                                <a href="/gig-details/{{$gig->slug}}">{!! str_limit($gig->title, $limit = 60, $end = ' ...') !!}</a>
                                                </div><a href="http://laravel.seenshop.com/gig-details/php-developer">
                                            <div class="rating-badges-container" style="display:flex; flex-direction:row;">
                                                <span class="review"><i class="fa fa-star"></i> {{ $gig->User->average_rating}} <span style="color: #b2b2b2;font-weight: 500;">({{ $gig->User->total_review}})</span></span> 
                                                @if($gig->User->user_status =='Online')
                                                <span class="" style="font-size:12px;color:#28a745;background-color:white;  padding-left:3px;padding-right:16px; border-radius:16px;">Online</span>
                                                @else
                                                <span class=" " style="color: white;background-color:white; border: 1px solid white; padding-left:3px;padding-right:3px; border-radius:16px;">Offline</span>
                                                @endif
                                            </div>
                                            </a>
                                            <div class="bottom_row">
                                               @if($gig->basic_price != 0)
                                                    <span style="font-size: 14px;color: #666; float:right; ">Starting at <a href="{{ URL::to( 'gig-details/'.$gig->slug)}}" style="font-size:18px;" >${{$gig->basic_price}}</a></span>
                                               @else
                                                    <span style="font-size: 14px;color: #666; float:right; ">Fixed Price <a href="{{ URL::to( 'gig-details/'.$gig->slug)}}" style="font-size:18px;" >${{$gig->gig_fixed_price}}</a></span>
                                               @endif
                                            </div>
                                        </div>
                                        </div>
                                </div>
                                    @endif
                                    
                                @endforeach
                                    
                                
                            </div>
                        </div>
                </div>
                <div class=" col-xs-12 col-md-4 sticky">
                    @if($recordInfo->basic_title != '')
                        <div class="offer_wrap_top" style="width: 100%; background: #fff; ">

                        <!-- Nav tabs -->
                        <ul class="offer-nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab" onclick="updateprice('{{$recordInfo->basic_price}}', 'basic')">Basic</a></li>
                            <li role="presentation"><a href="#standard" aria-controls="standard" role="tab" data-toggle="tab" onclick="updateprice('{{$recordInfo->standard_price}}', 'standard')">Standard</a></li>
                            <li role="presentation"><a href="#premium" aria-controls="premium" role="tab" data-toggle="tab" onclick="updateprice('{{$recordInfo->premium_price}}', 'premium')">Premium</a></li>  
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="basic">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text">{{$recordInfo->basic_title}}</span>
                                        <span class="package-price">{{CURR.$recordInfo->basic_price}}</span>
                                    </div>
                                    <p class="package-description">{{$recordInfo->basic_description}}</p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time">{{$recordInfo->basic_delivery}} days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            {{$recordInfo->basic_revision}} Revision
                                        </span>
                                        <ul class="buyables-offer">
                                                                                @if(!empty($recordInfo->GigCustom))
                                                                                    @foreach($recordInfo->GigCustom as $customfield)
                                                                                            <li class="" >
                                                                                                @if($customfield->check1 == 1)
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    @else 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                @endif
                                                                                                </i>{{$customfield->fieldname}}
                                                                                            </li>
                                                                                    @endforeach        
                                                                                @endif            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="standard">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text">{{$recordInfo->standard_title}}</span>
                                        <span class="package-price">{{CURR.$recordInfo->standard_price}}</span>
                                    </div>
                                    <p class="package-description">{{$recordInfo->standard_description}}</p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time">{{$recordInfo->standard_delivery}} days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            {{$recordInfo->standard_revision}} Revision
                                        </span>
                                        <ul class="buyables-offer">
                                                                                @if(!empty($recordInfo->GigCustom))
                                                                                    @foreach($recordInfo->GigCustom as $customfield)
                                                                                            <li class="" >
                                                                                                @if($customfield->check2 == 1)
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    @else 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                @endif
                                                                                                </i>{{$customfield->fieldname}}
                                                                                            </li>
                                                                                    @endforeach        
                                                                                @endif      
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="basic">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text">{{$recordInfo->basic_title}}</span>
                                        <span class="package-price">{{CURR.$recordInfo->basic_price}}</span>
                                    </div>
                                    <p class="package-description">{{$recordInfo->basic_description}}</p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time">{{$recordInfo->basic_delivery}} days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            {{$recordInfo->basic_revision}} Revision
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
                                                                                            
                                                                                             @if(!empty($recordInfo->GigCustom))
                                                                                    @foreach($recordInfo->GigCustom as $customfield)
                                                                                            <li class="" >
                                                                                                @if($customfield->check1 == 1)
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    @else 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                @endif
                                                                                                </i>{{$customfield->fieldname}}
                                                                                            </li>
                                                                                    @endforeach        
                                                                                @endif   
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="premium">
                                <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text">{{$recordInfo->premium_title}}</span>
                                        <span class="package-price">{{CURR.$recordInfo->premium_price}}</span>
                                    </div>
                                    <p class="package-description">{{$recordInfo->premium_description}}</p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time">{{$recordInfo->premium_delivery}} days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            {{$recordInfo->premium_revision}} Revision
                                        </span>
                                        <ul class="buyables-offer">
                                                                                @if(!empty($recordInfo->GigCustom))
                                                                                    @foreach($recordInfo->GigCustom as $customfield)
                                                                                            <li class="" >
                                                                                                @if($customfield->check3 == 1)
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    @else 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                @endif
                                                                                                </i>{{$customfield->fieldname}}
                                                                                            </li>
                                                                                    @endforeach        
                                                                                @endif     
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{ Form::open(array('method' => 'post', 'id' => 'addggiform')) }}
                            <input type="hidden" name="type" id="settype" value="basic">
                            <input type="hidden" name="slug" id="gigslug" value="{{$recordInfo->slug}}">
                            <div class="package-footer">
                                <p class="" id="hidebtn">
                                    @if(Session::get('user_id') != $recordInfo->user_id)
                                    <span  onclick="submitform()" class="btn-lrg-standard" >Continue
                                        ({{CURR}}<span class="js-str-currency" id="btnprice">{{$recordInfo->basic_price}}</span>)
                                    </span>
                                    @elseif(Session::get('user_id') == $recordInfo->user->id)
                                                <a class="btn btn-lg btn-block btn-success rounded-0" href="../gigs/edit/{{$recordInfo->slug}}">Edit Gig</a>
                                    
                                    @endif
                                </p>
                                <div class="gigdloader" id="gigdloader">{{HTML::image("public/img/loading.gif", SITE_TITLE)}}</div>
                                @if(Session::get('user_id') != $recordInfo->user_id)
                                <div class="text-center" ><a href="#"  style="color:#5CB85C;font-size:14px;">Send Custom Offer <i class="fa fa-paper-plane"></i></a></div>
                                @endif
                            </div>
                            {{ Form::close()}}
                            
                        </div>
                        
                    </div>
                    @else
                        <div class="col-sm-12 md-12" style="width: 100%; background: #fff; padding: 15px 25px;">
                                    <div class="offer-bxs">
                                    <div class="offer-bxs-price">
                                        <span class="package-title-text" style="width:85% !important;">{{$recordInfo->title}}</span>
                                        <span class="package-price" style=" width:5%; margin-right: 0px; font-size:16px; font-weight:400;">{{CURR.$recordInfo->gig_fixed_price}}</span>
                                    </div>
                                    <!--<p >{!! $recordInfo->description !!}</p>-->
                                    <p></p>
                                    <div class="offers-details">
                                        <span class="offer-icons">
                                            <i class="fa fa-clock-o fa-lg"></i>
                                            <span class="delivery-time">{{$recordInfo->gig_fixed_delivery}} days</span>
                                            Delivery
                                        </span>
                                        <span class="offer-icons">
                                            <i class="fa fa-refresh fa-lg"></i>
                                            {{$recordInfo->gig_fixed_revision}} Revision
                                        </span>
                                        <ul class="buyables-offer">
                                            
                                                                                @if(!empty($recordInfo->GigCustom))
                                                                                    @foreach($recordInfo->GigCustom as $customfield)
                                                                                            <li class="" >
                                                                                                @if($customfield->check1 == 1)
                                                                                                    <i class="fa fa-check" style="color:#5CB85C;">
                                                                                                    @else 
                                                                                                    <i class="fa fa-check" style="color:#D0D0D0;">
                                                                                                @endif
                                                                                                </i>{{$customfield->fieldname}}
                                                                                            </li>
                                                                                    @endforeach        
                                                                                @endif            
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
                                   {{ Form::open(array('method' => 'post', 'id' => 'addggiform')) }}
                                        <input type="hidden" name="type" id="settype" value="fixed">
                                        <input type="hidden" name="slug" id="gigslug" value="{{$recordInfo->slug}}">
                                        <input type="hidden" name="gigprice" id="gigprice" value="{{$recordInfo->gig_fixed_price}}">
                                        <div class="package-footer">
                                            <p class="" id="hidebtn">
                                                @if(Session::get('user_id') != $recordInfo->user_id)
                                                <span  onclick="submitform()" class="btn-lrg-standard" >Continue
                                                    ({{CURR}}<span class="js-str-currency" id="btnprice">{{$recordInfo->gig_fixed_price}}</span>)
                                                </span>
                                                @elseif(Session::get('user_id') == $recordInfo->user->id)
                                                <a class="btn btn-lg btn-block btn-success rounded-0" href="../gigs/edit/{{$recordInfo->slug}}">Edit Gig</a>
                                                @endif
                                            </p>
                                            <!--<div class="gigdloader" id="gigdloader">{{HTML::image("public/img/loading.gif", SITE_TITLE)}}</div>-->
                                            @if(Session::get('user_id') != $recordInfo->user_id)
                                            <div class="text-center" ><a href="#"  style="color:#5CB85C;font-size:14px;">Send Custom Offer <i class="fa fa-paper-plane"></i></a></div>
                                            @endif
                                </div>
                                {{ Form::close()}}
                                </div>
                    
                    @endif
                    <div class="about_seller offer_wrap_top"  style="width: 100%;margin-top:15px; background: #fff; padding: 15px 25px;" >
                           
                            <div class="card-body " style="padding:15px;">
                              <center class="mb-4">
                                <img src="/public/files/users/small/{{$recordInfo->User->profile_image}}" width="130" style="border-radius:50%;">
                                </center>
                              <h3 class="text-center h3">
                              <a class="text-success" href="../public-profile/{{$gig->User->slug}}">
                              {{$recordInfo->User->user_name}}  </a> | <span class="divider"> </span> <span class="text-muted">Level 1 Seller</span>
                              </h3>
                              @if(Session::get('user_id') != $recordInfo->user_id)
                              @auth
                                <a href="javascript:void(0);"  onclick='$("#info12").show();'data-toggle="modal" data-target="#myModal2" class="btn btn-lg btn-block btn-success rounded-0">Message me</a>
                              @endauth    
                              @endif        
                                <hr>
                              <div class="row">
                              <div class="col-md-6">
                              <p class="text-muted"><i class="fa fa-check pr-1" style="color:#5CB85C;"></i> From</p>
                              </div>
                              <div class="col-md-6">
                                 @if($recordInfo->User->Country)
                                    <p>{{$recordInfo->User->Country->name}}</p>
                                    @else
                                    <p>Unavailable</p>
                              @endif
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
                                @if($recordInfo->User->profile_image)
                                {{HTML::image(PROFILE_SMALL_DISPLAY_PATH.$recordInfo->User->profile_image, SITE_TITLE, ['id'=> 'pimage'])}}
                                @else
                                {{HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])}}
                                @endif
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
                                {{ Form::open(array('method' => 'post', 'id' => 'contactmessage','url' => 'users/messageuser', 'enctype' => "multipart/form-data")) }}
                                <div class="contact_div">
                                    {{Form::textarea('message','', ['class'=>'form-control required', 'placeholder'=>'', 'autocomplete' => 'off', 'minlength' => '0', 'maxlength' => '2500', 'id'=>'messageid','onkeyup'=>"countChar()"])}}
                                    <div class="sec_blw_top">
                                        <div class="sec_blw">
                                            <span id="charcount">0/2500</span>
                                            <span class="right_sp">
                                                {{Form::file('attachment', ['class'=>'form-control', 'accept'=>'image/png'])}}
                                            </span>
                                        </div>
                                        <div class="upbtn">
                                            {{Form::hidden('receiver_id', $recordInfo->User->id, ['id'=>'receiver_id'])}}
                                            <!--<button type="button" class="succbtn" id="succbtnbtn">Send</button>-->
                                            {{Form::submit('Send', ['class' => 'succbtn', 'id'=>'succbtnbtn'])}}
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close()}}
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
                            @if (!Session::get('user_id'))
                                    alert('Your must login to place your order.');
                                    @else
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform').serialize(),
                                            //data: { _token: '{{csrf_token()}}'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            beforeSend: function () {$("#gigdloader").show();  },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    @endif
                            }
                            function submitform1(){
                            @if (!Session::get('user_id'))
                                    alert('Your must login to place your order.');
                                    @else
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform1').serialize(),
                                            //data: { _token: '{{csrf_token()}}'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    @endif
                            }
                            
                            function submitform2(){
                            @if (!Session::get('user_id'))
                                    alert('Your must login to place your order.');
                                    @else
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform2').serialize(),
                                            //data: { _token: '{{csrf_token()}}'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    @endif
                            }
                            function submitform3(){
                            @if (!Session::get('user_id'))
                                    alert('Your must login to place your order.');
                                    @else
                                    $.ajax({
                                    url: "/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform3').serialize(),
                                            //data: { _token: '{{csrf_token()}}'},
                                            // beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "/order-summary/" + result;

                                            }
                                    });
                                    @endif
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
@endsection