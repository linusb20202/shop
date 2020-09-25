<div id="toTop">{{HTML::image('public/img/front/arrow-top.png', SITE_TITLE)}}</div>

<header class="header">
    <!--<script src="{{ asset('/public/js/app.js') }}" defer></script>-->
    <div class="wrapper">
        <div class="header_inner">
            <div class="logo"><a href="/"> {{HTML::image(LOGO_PATH, SITE_TITLE)}}</a></div>
            <?php //if (\Request::is('gig-details/*')) { ?>
                <div class="search_top">
                    {{ Form::open(array('url' => url('gigs'), 'method' => 'post',  'id' => 'searchform1')) }}
                    <div class="seacrh_top_in"><input type="text" name="title" class="form-control" placeholder="What Service are you looking for"></div>  
                    <div class="search_top_btn"><input class="homesearch_top" type="submit" value="Get Started Now" /></div>
                    {{ Form::close()}}
                </div>
            <?php //}
            ?>

            <div class="menu" id="app2">  <nav id='cssmenu'>
                    <div id="head-mobile"></div>
                    <div class="button"></div>
                    <ul>
                        <li class="left"><a href='{{URL::to('gigs/create')}}'> Post Gig</a></li>
                        <li class="left"><a href='{{URL::to('gigs')}}'>Browse Gigs</a></li>
                        @auth
                        <li class="left notification-b" >
                            <a href='javascript:void();'>Notifications <span id="checkunreadmsg" class="green-dots displaynone"></span></a>
                            <ul class="notification displaynonenot" id="msgcontaine">
                            </ul>
                        </li>
                        
                             <indicator :user="{{auth()->user()}}"></indicator>
                            
                        
                        <li class="has-sub"><a href='{{URL::to( 'users/dashboard')}}'> Dashboard</a>
                            <ul>
                                <li class=""><a href="{{URL::to('users/settings')}}">Settings</a></li>   
                                <li class="has-sub"><a href="{{URL::to('gigs/management')}}">Selling</a>
                                    <ul class="left_open">
                                        <li><a href="{{URL::to('gigs/management')}}">Manage Gigs</a></li>
                                        <li><a href="{{URL::to('gigs/create')}}">Create New Gig</a></li>
                                        <li><a href="{{URL::to('gigs/myofferedgig')}}">My Offered Gigs</a></li>
                                    </ul>
                                </li>   
                                <li class="has-sub"><a href="{{URL::to('services/management')}}">Buying</a>
                                    <ul class="left_open">
                                        <li><a href="{{URL::to('services/management')}}">Manage Requests</a></li>
                                        <li><a href="{{URL::to('services/create-request')}}">Post Request</a></li>
                                        <li><a href="{{URL::to('my-saved-gigs')}}">My Saved Gigs</a></li>
                                        <li><a href="{{URL::to('gigs/offeredgig')}}">Offered Gigs</a></li>
                                    </ul>
                                </li>
                                <li class="has-sub"><a href="{{URL::to('selling-orders')}}">Orders</a>
                                    <ul class="left_open">
                                        <li><a href="{{URL::to('selling-orders')}}">Selling Orders</a></li>
                                        <li><a href="{{URL::to('buying-orders')}}">Buying Orders</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="{{URL::to('earnings')}}">Earnings</a>
                                    <ul class="left_open">
                                        <li><a href="{{URL::to('earnings')}}">Earnings</a></li>
                                        <li><a href="{{URL::to('payments/history')}}">PayPal History</a></li>
                                    </ul>
                                </li>   
                            </ul> 
                        </li>
                        <li class=""><a href='{{URL::to('logout')}}'>Logout</a></li>
                        @endauth
                        @guest
                        <li class=""><a href='{{URL::to('register')}}'>Register</a></li>
                        <li class=""><a href='{{URL::to('login')}}'> Login</a></li>
                        @endguest

                    </ul>
                </nav> 
                <div class="posstt post_icon">
                    <a href="{{URL::to('gigs/create')}}">
                        <b>+</b>  
                        <span>Post Gig</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="menu_drop sdfef">
        <div class="menu_in">
            <div class="wrapper">           
                <ul>
                    @if($globalCategories)
                    @foreach($globalCategories as $cat)
                    <li><a href="{{URL::to( 'gigs/'.$cat->slug)}}">{!! $cat->name !!}</a></li>
                    @if($loop->iteration == 8)
                    @break
                    @endif
                    @endforeach  
                    <li class="more-link"><a href="javascript:void()" class="showhide2">More <span class="caret-arrow"></span></a>
                        <ul class="slidediv2">
                            @foreach($globalCategories as $cat)
                            @if($loop->iteration > 8)
                            <li><a href="{{URL::to( 'gigs/'.$cat->slug)}}">{!! $cat->name !!}</a></li>
                            @endif
                            @endforeach 
                        </ul>
                    </li>
                    @endif

                </ul>    
            </div>
        </div>
    </div>
</header> 


@section('extra-js')


<!--<script src="{{ asset('/public/js/app.js') }}" defer></script>-->
<!--<script src="{{ asset('/public/js/jquery-2.1.0.min.js') }}" defer></script>-->
<!--<script src="{{ asset('/public/js/front/menu.js') }}" ></script>-->
@endsection
<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 5) {
            $(".header").addClass("fixed-me");
        } else {
            $(".header").removeClass("fixed-me");
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.showhide2').click(function () {
            $(".slidediv2").slideToggle();
        });
    });
</script>