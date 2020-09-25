@extends('layouts.inner')
@section('content')
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
<script type="text/javascript" src="{{ url(config('app.url')) }}/public/js/front/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("passworreq", function (input) {
            var reg = /[0-9]/; //at least one number
            var reg2 = /[a-z]/; //at least one small character
            var reg3 = /[A-Z]/; //at least one capital character
            //var reg4 = /[\W_]/; //at least one special character
            return reg.test(input) && reg2.test(input) && reg3.test(input);
        }, "Password must be a combination of Numbers, Uppercase & Lowercase Letters.");
        $("#changepassword").validate();
        $("#changeemail").validate();
    });
</script>
{{ HTML::script('public/js/facebox.js')}}
{{ HTML::style('public/css/facebox.css')}}

<script type="text/javascript">
    $(document).ready(function ($) {
        $('.close_image').hide();
        $('a[rel*=facebox]').facebox({
            closeImage: './img/close.png'
        });
    });
</script>
<section class="dashboard-section">
    <div class="container" id="app">
        
            
       
            <div class="row" style="margin-bottom:5px;">
                <div class="col-sm-12 col-md-12 m-1 p-1 border">
                    <div class="row">
                        <div class="col-sm-12 mt-2">
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            @if(is_array(session()->get('success')))
                            
                            @foreach (session()->get('success') as $message)
                            {{ $message }}
                            @endforeach
                            
                            @else
                            {{ session()->get('success') }}
                            @endif
                        </div>
                        @endif
                        @if(count($errors) >0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif
                        </div>
                        <div class="col-sm-10 md-10 text-left">
                            <h3 class="text-left " style="margin-bottom:10px;">Settings</h3>
                            <ul class="nav nav-pills custom" style="padding-top:5px !important; padding-bottom:5px !important">
                                <li class="active"><a data-toggle="pill" href="#account">Account</a></li>
                                <li><a data-toggle="pill" href="#security">Security</a></li>
                                <li><a data-toggle="pill" href="#payments" >Payments</a></li>
                              </ul>
                        </div>
                        <div class="col-sm-2 md-2 text-center">
                            {{ Form::open(array('method' => 'post', 'id' => 'uplaodprofileimg', 'enctype' => "multipart/form-data")) }}
                        <div class="profile-img" style="height:60px !important; width:60px !important;padding-right:15px !important;">
                            @if($recordInfo->profile_image)
                            {{HTML::image(PROFILE_SMALL_DISPLAY_PATH.$recordInfo->profile_image, SITE_TITLE, ['id'=> 'pimage'])}}
                            @else
                            {{HTML::image('./img/front/user-img.png', SITE_TITLE, ['id'=> 'pimage'])}}
                            @endif
                            <div class="new-image-add">
                                {{Form::file('profile_image', ['class'=>'form-control', 'accept'=>IMAGE_EXT, 'id'=>'profile_image'])}}
                                <a href="#"><i class="fa fa-camera" aria-hidden="true"></i></a>
                            </div>
                            <span class="ploader" id="ploader">{{HTML::image('./img/loading.gif', SITE_TITLE)}}</span>
                        </div>
                        {{ Form::close()}}
                        {!! $recordInfo->user_name !!}
                        </div>
                        
                    </div>
                </div>
            </div>
        <div class="your-setting" style="min-height: 700px; margin-top-10px;">
            <div class="your-setting-bx">
                <div class="row">
                    <div class="col-sm-12">
                          <div class="tab-content">
                            <div class="tab-pane fade in active" id="account" role="tabpanel" aria-labelledby="home-tab">
                                <!-- Default form register -->
                            <account-settings :countries="{{$countries}}" :user="{{$recordInfo}}"></account-settings>
                            </div>
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="profile-tab">
                                <change-password></change-password>
                            </div>
                            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="contact-tab">
                                <paypal :user="{{ $recordInfo }}"></paypal>
                                
                                <hr style="margin-right:340px;"/>
                                <payoneer :user="{{ $recordInfo }}"></payoneer>
                                  <hr style="margin-right:340px;"/>
                                  <bank :user="{{ $recordInfo }}"></bank>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $("#passbtn").click(function () {
        if ($("#changepassword").valid()) {
            $.ajax({
                url: "/users/updatesettings",
                type: "POST",
                data: {"old_password": $('#old_password').val(), "newpassword": $('#newpassword').val(), "confirm_password": $('#confirm_password').val(), _token: '{{csrf_token()}}'},
                beforeSend: function () {
                    $("#passloader").show();
                },
                complete: function () {
                    $("#passloader").hide();
                },
                success: function (result) {
                    if (result == 1) {
                        $('#passmsg').html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button> You have successfully changed your account password.</div>');
                    } else {
                        $('#passmsg').html('<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>' + result + '</div>');
                    }
                }
            });
        }
    });
    
     
      
        
        
    
    $("#emailbtn").click(function () {
        if ($("#changeemail").valid()) {
            $.ajax({
                url: "{!! HTTP_PATH !!}/users/updatesettings",
                type: "POST",
                data: {"paypal_email": $('#paypal_email').val(), _token: '{{csrf_token()}}'},
                beforeSend: function () {
                    $("#emailloader").show();
                },
                complete: function () {
                    $("#emailloader").hide();
                },
                success: function (result) {
                    if (result == 1) {
                        $('#emailmsg').html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button> You have successfully changed your account password.</div>');
                    } else {
                        $('#emailmsg').html('<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Something went wrong.</div>');
                    }
                }
            });
        }
    });
    $(document).ready(function () {
        $("#uplaodprofileimg").on('change', function (event) {
            var postData = new FormData(this);
            event.preventDefault();
            $.ajax({
                url: "/users/uploadprofileimage",
                type: "POST",
                data: postData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#ploader').show();
                },
                success: function (imagename) {
                    $('#pimage').attr("src", "{!! PROFILE_SMALL_DISPLAY_PATH !!}" + imagename);
                    $('#ploader').hide();
                }
            });
        });
    });
</script>
<!--<script src="{{ asset('/public/js/app.js') }}"></script>-->
@endsection