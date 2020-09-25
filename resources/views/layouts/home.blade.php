<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title.TITLE_FOR_LAYOUT}}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{!! FAVICON_PATH !!}" type="image/x-icon"/>
        <link rel="icon" href="{!! FAVICON_PATH !!}" type="image/x-icon"/>
        <script src="{{ asset('/public/js/app.js') }}" defer></script>
        <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public/css/front/style.css">-->
        <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public//css/front/media.css">-->
        <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public//css/front/stylee.css">-->
        <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public//css/front/owl.theme.default.min.css">-->
        <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public//css/front/font-awesome.css">-->
        <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public//css/front/magnific-popup.min.css">-->
        
        {{ HTML::style('public/css/front/style.css')}}
        {{ HTML::style('public/css/front/media.css')}}
        {{ HTML::style('public/css/front/stylee.css')}}
        {{ HTML::style('public/css/front/owl.theme.default.min.css')}}
        {{ HTML::style('public/css/front/owl.carousel.min.css')}}
        {{ HTML::style('public/css/front/font-awesome.css')}}
        {{ HTML::style('public/css/front/magnific-popup.min.css')}}
        @if(isset($fixheader) && $fixheader == 1)
            {{ HTML::style('public/css/front/heraderfix.css')}}
            <!--<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public/css/front/heraderfix.css">-->
        @endif
        <!--<script type="text/javascript" src="{{ url(config('app.url')) }}/public//js/jquery-2.1.0.min.js" defer></script>-->
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public//js/jquery.validate.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public//js/front/menu.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public//js/front/owl.carousel.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public//js/front/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public//js/front/cssua.min.js"></script>
       
        
<!--        <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/michalsnik/aos/2.0.4/dist/aos.css'>-->
    </head>
    <body>
        @include('elements.header_inner')
        @yield('content') 
        @include('elements.footer')
      
<script src="{{ asset('/public/js/app.js') }}" ></script>
    </body>
</html>