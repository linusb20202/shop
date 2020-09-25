<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{$title.TITLE_FOR_LAYOUT}}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{!! FAVICON_PATH !!}" type="image/x-icon"/>
        <link rel="icon" href="{!! FAVICON_PATH !!}" type="image/x-icon"/>
        
        <!--<link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/bootstrap.min.css" rel="stylesheet">-->
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/style.css" rel="stylesheet">-->
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/inner.css" rel="stylesheet">-->
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/stylee.css" rel="stylesheet">-->
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/font-awesome.css" rel="stylesheet">-->
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/media.css" rel="stylesheet">-->
        <!--<link href="{{ url(config('app.url')) }}/public/css/front/linus.css" rel="stylesheet">-->

        {{ HTML::style('public/css/front/bootstrap.min.css')}}
        {{ HTML::style('public/css/front/style.css')}}
        {{ HTML::style('public/css/front/inner.css')}}
        {{ HTML::style('public/css/front/stylee.css')}}
        {{ HTML::style('public/css/front/font-awesome.css')}}
        {{ HTML::style('public/css/front/media.css')}}
        {{ HTML::style('public/css/front/linus.css')}}
        
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/jquery.validate.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/front/menu.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/front/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/ajaxsoringpagging.js"></script>
       
       
        
       
        
    </head>
    <body>
        @include('elements.header')
        <div class="main_dashboard" >
            @include('elements.topmenu')
                @yield('content')
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                $("#maraction").click(function () {
                    $("#offer-show").addClass("offer-div");
                    $(".dashboard-rights-section").removeClass("offer-div");
                });
                
            </script>
        </div>
        @include('elements.footer')
        

    </body>
</html>