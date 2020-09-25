<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title.TITLE_FOR_LAYOUT}}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{!! FAVICON_PATH !!}" type="image/x-icon"/>
        <link rel="icon" href="{!! FAVICON_PATH !!}" type="image/x-icon"/>

        {{ HTML::style('public/css/front/bootstrap.min.css')}}
        {{ HTML::style('public/css/front/style.css')}}
        {{ HTML::style('public/css/front/media.css')}}
        {{ HTML::style('public/css/front/font-awesome.css')}}

        <!--{{-- <link href="{{ asset('css/front/bootstrap.min.css') }}" rel="stylesheet">-->
        <!--<link href="{{ asset('css/front/style.css') }}" rel="stylesheet">-->
        <!--<link href="{{ asset('css/front/font-awesome.css') }}" rel="stylesheet">-->
        <!--<link href="{{ asset('css/front/media.css') }}" rel="stylesheet"> --}}-->
        
        <!--{{ HTML::script('public/js/jquery-2.1.0.min.js')}}-->
         <!--<script src="{{ asset('/public/js/app.js') }}" ></script> --}}-->
        {{ HTML::script('public/js/jquery.validate.js')}}
        
        <!--{{-- <script src="{{ asset('js/jquery-2.1.0.min.js') }}" ></script>-->
        <!--<script src="{{ asset('js/jquery.validate.js') }}" ></script> --}}-->

        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/jquery.validate.js"></script>
    </head>
    <body>
        @yield('content') 
        
    </body>
</html>