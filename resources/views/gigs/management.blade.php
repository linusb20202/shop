@extends('layouts.inner')
@section('content')

{{ HTML::script('public/js/front/bootstrap.min.js')}}
<div class="main_dashboard">
    <section class="dashboard-section">
        <div class="container">
            <div class="manage-btn">Manage Gigs 
                @if($allrecords->isEmpty())
                    <a href="{{ URL::to( 'gigs/create')}}" class="btn btn-primary">Create New Gig</a>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-rights-section">
                        <div class="row">
                            @if(!$allrecords->isEmpty())
                            <div class="col-sm-4 col-md-3">
                                <div class="thumbnail">
                                    <div class="creat-new">
                                        <a href="{{ URL::to( 'gigs/create')}}" class="">
                                            <i> {{HTML::image('public/img/front/plus.png', SITE_TITLE)}}</i>
                                            <span>Create a new gig</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{ Form::open(array('method' => 'post', 'id' => 'gigmanagementform')) }}
                            {{Form::hidden('page', $page, ['id'=>'gigpage'])}}
                            {{ Form::close()}}
                            <div class="main_loader" id="loaderID">{{HTML::image("public/img/website_load.svg", SITE_TITLE)}}</div>
                            <div class="mng_gig" id="mng_gig">
                                @include('elements.gigs.management')
                            </div>
                            @if(!$allrecords->isEmpty() && count($allrecords) >= $limit)
                                <div class="loadmore" id="reqloaddiv">
                                    <span class="loadmorebtn" id="loadmorebtn" onclick="gigloadmore()">Load more...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function filterrequest(){
        $('#buyerpage').val('1')
        updaterecords();
    }
    function gigloadmore(){
        $('#gigpage').val($('#gigpage').val()*1 + 1*1);
        updaterecords();
    }
    
    function updaterecords(){
        $.ajax({
            url: "{!! HTTP_PATH !!}/gigs/management",
            type: "POST",
            data: $('#gigmanagementform').serialize(),
            beforeSend: function () { $("#loaderID").show();},
            complete: function () {$("#loaderID").hide();},
            success: function (result) {
                if($('#gigpage').val() == 1){
                    $('#mng_gig').html(result);    
                }else{ 
                    $('#mng_gig').append(result);
                }
            }
        });
    }
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(document).ready(function () {
        $(".maraction").click(function () {
            thisid = this.id;
            var id = thisid.split('-');
            $("#offer-show-"+id[1]).addClass("offer-div");
//            $(".dashboard-rights-section").removeClass("offer-div");
        });
        $(".clsstng").click(function () {
            thisid = this.id;
            var id = thisid.split('-');
            $("#offer-show-"+id[1]).removeClass("offer-div");
        });
    });
</script>
@endsection