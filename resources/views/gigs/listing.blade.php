@extends('layouts.dashboard')
@section('content')
<div class="main_dashboard" id="backtotop">
    @include('elements.topcategories')
    <section class="dashboard-section">
        <div class="container">
            {{ Form::open(array('method' => 'post', 'id' => 'searchform')) }}
            <div class="top-headers">
                <div class="col-sm-6">
                    <h2>
                
                    @if(!empty($catInfo))
                        <a href="{{URL::to( 'gigs')}}">Gigs</a> > 
                        {{$catInfo->name}}
                    @else  
                        Refine Result
                    @endif                    
                </h2>
                </div>
                
                <div class="col-sm-3 text-center">
                <!--    <span style="font-size:18px;" id="refresh">-->
                   
                   <!--@if($subcatslug != '')-->
                   <!--       {{ $subdesc }}-->
                   <!--      @elseif(!empty($catInfo))-->
                   <!--         {{$catInfo->full_description}}-->
                            
                   <!-- @endif  -->
                  <!--SubCat-->
                <!--</span>-->
                </div>
                <div class="col-sm-3">
                    <div class="sortby">
                    <label>Sort by</label>
                    <div class="market-select">
                        <span>
                            <?php global $searcFilterArray; ?>
                            {{Form::select('filter_type', $searcFilterArray, null, ['class' => 'form-control', 'onchange'=>'updateresult()'])}}
                        </span>
                    </div>
                </div>
                </div>
            </div>
            <div class="row-listing">
                @include('elements.gigs.filters')
                <div class="right_listing">
                    <div class="searchloader displaynone" id="searchloader">{{HTML::image("public/img/website_load.svg", SITE_TITLE)}}</div>
                    <div class="loadgigs" id="loadgigs">
                        @include('elements.gigs.listing')
                    </div>
                </div>   
            </div>
            <input type="hidden" value="1" id="pageidd" name="page"> 
            {{ Form::close()}}
            
            
                <div class="top-headers" style="margin-top: 10px;">
                    <div class="row">
                        <div class="col-sm-12 md-12 par" id="refresh">
                            @if($subcatslug != '')
                              {!! $subdesc !!}
                                 @elseif(!empty($catInfo))
                                    {!! $catInfo->full_description !!}
                                    
                            @endif  
                        </div>
                        
                        <!--<div class="col-sm-12 md-12">-->
                        <!--    <h1 style="font-weight:700;">Hire a Writer or Translator</h1>-->
                            
                        <!--    <h3 style="color:grey; margin-top:10px;">Hire people to do creative and targeted advertising, online and offline.</h3>-->
                        <!--</div>-->
                        <!--<div class="col-sm-12 md-12" style="margin-top:25px;">-->
                        <!--    <p style="column-count:2; font-size:14px;">-->
                        <!--        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. -->
                        <!--        Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum -->
                        <!--        iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio -->
                        <!--        dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil -->
                        <!--        imperdiet doming id quod mazim placerat facer possim assum.-->
                        <!--    </p>-->
                        <!--</div>-->
                    </div>
                </div>
            
        </div>
    </section>
</div>

<script type="text/javascript">
    
    $(document).ready(function () {
        
        $(".deltime").click('change', function (event) {
            updateresult ();
        });
        $(".deltimesub").click('change', function (event) {
            updateresult ();
        });
        $(".langg").click('change', function (event) {
            updateresult ();
        });
        $(document).on('click', '.ajaxpagee a', function () {
            
            var npage = $(this).html();
            if ($(this).html() == '»') {
                npage = $('.ajaxpagee .active').html() * 1 + 1;
            } else if ($(this).html() == '«') {
                npage = $('.ajaxpagee .active').html() * 1 - 1;
            }
            $('#pageidd').val(npage);
            updateresult ();
            return false;
        });
        
        $(".numbrreg").keypress(function (event) {
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault(); //stop character from entering input
            }
        });
       
    });
    
     function applyfilter(){ 
       // updateresult()
    }
    
    function updateresult(){ 
        var thisHref = $(location).attr('href');
        
        $.ajax({
            url: thisHref,
            type: "POST",
            data: $('#searchform').serialize(),
            beforeSend: function () { $("#searchloader").show();},
            complete: function () {$("#searchloader").hide(); 
            
              },
            
            success: function (result) {
                // location.reload();
                
                
                
               $('#loadgigs').html(result.view);
               $('#refresh').html(result.subdesc);
            //   console.log(result.subdesc);
               
              
            },
            
        });
        
    }  
    
    function clearfilter(){
        window.location.href = window.location.protocol;
    }
    
    
</script>
<!--<script src="{{ asset('/public/js/app.js') }}"></script>-->
@endsection