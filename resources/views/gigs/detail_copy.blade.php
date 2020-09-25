@extends('layouts.dashboard')
@section('content')
{{ HTML::script('public/js/front/lightslider.js')}}
<!--<script src="{{ asset('/public/js/front/lightslider.js') }}" ></script>-->
<script type="text/javascript">
    var img_path = "{!! HTTP_PATH !!}/public/img";
            $(document).ready(function () {
    $('#image-gallery').lightSlider({
    gallery: true,
            item: 1,
            thumbItem: 9,
            slideMargin: 0,
            speed: 500,
            auto: true,
            loop: true,
            onSliderLoad: function () {
            $('#image-gallery').removeClass('cS-hidden');
            }
    });
    });
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
            height: '390',
                    width: '640',
                    videoId: 'M7lc1UVf-VE',
                    events: {
                    'onReady': onPlayerReady,
                            'onStateChange': onPlayerStateChange
                    }
            });
            }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
    event.target.playVideo();
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
            function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
            setTimeout(stopVideo, 6000);
                    done = true;
            }
            }
    function stopVideo() {
    player.stopVideo();
    }
</script>
{{ HTML::script('public/js/jquery.raty.min.js')}}
{{ HTML::style('public/css/front/lightslider.css')}}
<div class="main_dashboard">
    @include('elements.topcategories')
    <section class="dashboard-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="top_row_new">
                        <h3 class="left_title">{{$recordInfo->title}}</h3>
                        <div class="clearfix" id="galleryddd">
                            @php $isanyimage = 0; @endphp
                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                @if($recordInfo->youtube_url!='')
                                <li data-thumb="{{GIG_FULL_DISPLAY_PATH.$recordInfo->youtube_image}}" alt=""> 
                                    <iframe src="{{App\Models\Gig::get_video_code($recordInfo->youtube_url)}}" width="580" height="350" frameborder="0" allowfullscreen  border="0" id="player"></iframe>
                                </li> 
                                @php $isanyimage = 1; @endphp
                                @endif
                                @foreach($recordInfo->Image as $gigimage) 
                                @if (isset($gigimage->name) && !empty($gigimage->name))
                                @php $path = GIG_FULL_UPLOAD_PATH . $gigimage->name; @endphp
                                @if (file_exists($path) && !empty($gigimage->name))
                                @php $isanyimage = 1; @endphp
                                <li data-thumb="{{GIG_FULL_DISPLAY_PATH.$gigimage->name}}" alt="{{$recordInfo->title}}"> 
                                    {{HTML::image(GIG_FULL_DISPLAY_PATH.$gigimage->name, SITE_TITLE,['title'=>$recordInfo->title])}}
                                </li>
                                @endif 
                                @endif 
                                @endforeach
                            </ul>
                        </div>
                        @if($isanyimage == 0)
                        <script> $('#galleryddd').hide();</script>
                        <!--                        {{HTML::image('public/img/front/no_image.png', SITE_TITLE)}}-->
                        @endif
                        <div class="image_desp">

                            <div class="detail_img">
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

                        <div class="about_seller">
                            <h5>About the Seller</h5>
                            <div class="profile-about">
                                <div class="dpimg-about">
                                    @if (file_exists(PROFILE_FULL_UPLOAD_PATH . $recordInfo->User->profile_image) && !empty($recordInfo->User->profile_image))
                                    <a href="{{ URL::to( 'public-profile/'.$recordInfo->User->slug)}}">{{HTML::image(PROFILE_SMALL_DISPLAY_PATH . $recordInfo->User->profile_image, SITE_TITLE)}}</a>
                                    @else
                                    <a href="{{ URL::to( 'public-profile/'.$recordInfo->User->slug)}}">{{HTML::image('public/img/front/dummy.png', SITE_TITLE)}}</a>
                                    @endif
                                </div>
                                <div class="dp_details-about"><h3><a href="{{ URL::to( 'public-profile/'.$recordInfo->User->slug)}}">{{$recordInfo->User->first_name?$recordInfo->User->first_name.' '.$recordInfo->User->last_name:''}} </a></h3>
                                    <p>{{$recordInfo->User->address}}</p>
                                    <div class="about-rating">
                                        <script>
                                                    $(function() {
                                                    $('#avgRating22').raty({
                                                    starOn:    'star-on.png',
                                                            starOff:   'star-off.png',
                                                            start: {{$recordInfo -> User -> average_rating}},
                                                            readOnly: true
                                                    });
                                                    });</script>
                                        <span class="pprate gigdtlrat" id="avgRating22"></span>
                                        <span><b><?php echo $recordInfo->User->average_rating; ?></b> (<?php echo $recordInfo->User->total_review; ?> reviews)</span>
                                    </div>
                                    <!--                                <a href="#" class="btn btn-default">Contact Me</a>-->
                                </div>

                                <div class="client-reviews">
                                    <div class="client-reviews-left">
                                        <h3>About me</h3>
                                        <p class="text-viewer"><?php echo $recordInfo->User->description; ?></p>
                                    </div>
                                    <div class="client-reviews-right">
                                        <h3>General Info</h3>
                                        <ul class="general-info">
                                            <li>
                                                <label><i class="fa fa-map-marker" aria-hidden="true"></i>From</label>
                                                <span>
                                                    <?php
                                                    $farray = array();
                                                    if (isset($recordInfo->User->city) && $recordInfo->User->city != '') {
                                                        $farray[] = $recordInfo->User->city;
                                                    }
                                                    if (isset($recordInfo->User->Country->name) && $recordInfo->User->Country->name != '') {
                                                        $farray[] = $recordInfo->User->Country->name;
                                                    }
                                                    echo implode(', ', $farray);
                                                    ?>
                                                </span>
                                            </li>
                                            <li>
                                                <label><i class="fa fa-user" aria-hidden="true"></i>Member since</label>
                                                <span><?php echo date('F Y', strtotime($recordInfo->User->created_at)); ?></span>
                                            </li>
                                            @if($recordInfo->User->languages)
                                            <li>
                                                <label><i class="fa fa-language" aria-hidden="true"></i>Languages</label>
                                                <span>
                                                    @foreach(json_decode($recordInfo->User->languages) as $key => $lang)
                                                    @if(!$loop->first), @endif{!!$lang->lang_name!!}
                                                    @endforeach
                                                </span>
                                            </li>
                                            @endif
                                            <!--                                        <li>
                                                                                        <label><i class="fa fa-clock-o" aria-hidden="true"></i>Avg. Response Time</label>
                                                                                        <span>3 hours</span>
                                                                                    </li>-->
                                            <!--                                        <li>
                                                                                        <label><i class="fa fa-send" aria-hidden="true"></i>Recent Delivery</label>
                                                                                        <span>about 4 hours</span>
                                                                                    </li>-->

                                        </ul>
                                    </div>
                                </div>
                                @if(!$gigreviews->isEmpty())
                                <div class="client-rievews gigdtl_pg">                                
                                    @foreach($gigreviews as $allrecord)
                                    <div class="client-chat gigdtl_pgin">
                                        <div class="clientimg-about">
                                            @if($allrecord->Otheruser->profile_image)
                                            <a href="{{ URL::to( 'public-profile/'.$allrecord->Otheruser->slug)}}" class="">{{HTML::image(PROFILE_SMALL_DISPLAY_PATH.$allrecord->Otheruser->profile_image, SITE_TITLE)}}</a>
                                            @else
                                            <a href="{{ URL::to( 'public-profile/'.$allrecord->Otheruser->slug)}}" class="">{{HTML::image('public/img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])}}</a>
                                            @endif
                                        </div>
                                        <div class="client-rv">
                                            <h3><a href="{{ URL::to( 'public-profile/'.$allrecord->Otheruser->slug)}}" class="">{{$allrecord->Otheruser->first_name.' '.$allrecord->Otheruser->last_name}}</a></h3>
                                            <span class="review-date"><i class="fa fa-calendar" aria-hidden="true"></i>{{$allrecord->created_at->diffForHumans()}}</span>
                                            <div class="client-review-reting">
                                                <script>
                                                            $(function() {
                                                            $('#lst{{$allrecord->id}}').raty({
                                                            starOn:    'star-on.png',
                                                                    starOff:   'star-off.png',
                                                                    start: {{$allrecord -> rating}},
                                                                    readOnly: true
                                                            });
                                                            });</script>
                                                <span class="lstreview lstreview_new" id="lst{{$allrecord->id}}"></span>
                                                <b>{{$allrecord->rating}}</b>
                                            </div>
                                            <p>
                                                {{nl2br($allrecord->comment)}}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach                                
                                </div>
                                @endif
                            </div>
                        </div>                    
                    </div>
                </div>
                <div class=" col-xs-12 col-md-4 sticky">
                    <div class="offer_wrap_top">

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
                                    @endif
                                </p>
                                <div class="gigdloader" id="gigdloader">{{HTML::image("public/img/loading.gif", SITE_TITLE)}}</div>
                            </div>
                            {{ Form::close()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
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
                                    url: "{!! HTTP_PATH !!}/payments/addtocart",
                                            type: "POST",
                                            data: $('#addggiform').serialize(),
                                            //data: { _token: '{{csrf_token()}}'},
                                            beforeSend: function () {$("#gigdloader").show(); $("#hidebtn").hide(); },
                                            success: function (result) {
                                        
                                         window.location = "{!! HTTP_PATH !!}/order-summary/" + result;

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