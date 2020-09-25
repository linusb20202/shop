@extends('layouts.inner')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ url(config('app.url')) }}/public/css/facebox.css">
<script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/facebox.js"></script>
<script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/front/bootstrap.min.js"></script>
<!--{{-- <script src="{{ asset('/public/js/app.js') }}" defer></script> --}}-->


<script type="text/javascript">
    $(document).ready(function ($) {
    $('.close_image').hide();
            $('a[rel*=facebox]').facebox({
    closeImage: '{!! HTTP_PATH !!}/public/img/close.png'
    });
            $("#message").validate();
            $("#offer").validate();
//        $('#message_part').animate({
//    scrollTop: $('#message_part').offset().top}, 1000);
        //$(document).scrollTop(50);
        $('#message_part').animate({scrollTop: $('#message_part').prop('scrollHeight')});
    });
</script>
<div class="main_dashboard message_dashboard"  id="app">
    <div class="container">
        <div class="message_sections" style="height:600px;">
            
            <div class="row-padding">
                
            <chat-app :user="{{auth()->user()}}" :receiver="{{$receiver}}"></chat-app>
                    
                
                
            </div>
        </div>
    </div>

</div>

<!--<script src="{{ asset('public/js/app.js') }}"></script>-->
@endsection