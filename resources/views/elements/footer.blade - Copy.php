<footer >
    <div class="wrapper">
        <div class="footer_inner">
            <div class="foot_block foot_block_first">
                <div class="foot_title drop1">Top Categories</div>
                <div class="foot_menu block1">
                    <ul>
                        @if($globalCategories)
                            @foreach($globalCategories as $cat)
                                <li><a href="{{URL::to( 'gigs/'.$cat->slug)}}">{!! $cat->name !!}</a></li>
                                @if($loop->iteration == 10)
                                    @break
                                @endif
                            @endforeach                    
                        @endif
                    </ul>
                </div>
            </div>
            <div class="foot_block">
                <div class="foot_title drop2">About</div>
                <div class="foot_menu block2">
                    <ul>
                        <li><a href="{{URL::to( 'about-us')}}">About us</a></li>  
                        <li><a href="{{URL::to( 'how-it-works')}}">How it works</a></li>  
                        <li><a href="{{URL::to( 'privacy-policy')}}">Privacy policy</a></li>  
                        <li><a href="{{URL::to( 'terms-and-condition')}}">Terms of service</a></li> 
                        <li><a href="{{URL::to( 'press-and-news')}}">Press & News</a></li> 
                    </ul>   
                </div>
            </div>            
            <div class="foot_block">
                <div class="foot_title drop4">Support</div>

                <div class="foot_menu block4">
                    <ul>
                        <li><a href="{{URL::to( 'contact-us')}}">Contact us</a></li> 
                        <li><a href="{{URL::to( 'trust-and-safety')}}">Trust & safety</a></li> 
                        <li><a href="{{URL::to( 'faqs')}}">FAQ</a></li> 
<!--                        <li><a href="#">Email</a></li>-->
                    </ul>   

                </div>

            </div>
            <div class="foot_block ">
                <div class="foot_title drop5">Follow Us</div>
                <div class="foot_menu block5">
                    <ul>
                        @if($siteSettings->facebook_link)
                        <li><a href="{!! $siteSettings->facebook_link !!}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> facebook</a></li>
                        @endif
                        @if($siteSettings->twitter_link)
                            <li><a href="{!! $siteSettings->facebook_link !!}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> twitter</a></li>
                        @endif
                        @if($siteSettings->google_link)
                            <li><a href="{!! $siteSettings->google_link !!}" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i> google+</a></li>
                        @endif
                        @if($siteSettings->instagram_link)
                            <li><a href="{!! $siteSettings->instagram_link !!}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> instagram</a></li>
                        @endif
                        @if($siteSettings->linkedin_link)
                            <li><a href="{!! $siteSettings->linkedin_link !!}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i> linkedin</a></li>
                        @endif
                        @if($siteSettings->pinterest_link)
                            <li><a href="{!! $siteSettings->pinterest_link !!}" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> pinterest</a></li>
                        @endif
                        @if($siteSettings->youtube_link)
                            <li><a href="{!! $siteSettings->youtube_link !!}" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i> youtube</a></li>
                        @endif
                    </ul>   
                </div>
            </div>
        </div>
    </div>
    <div class="footer_adat"> © Copyright @ {!! date('Y') !!} &nbsp;|&nbsp;  <a href="https://www.logicspice.com/" target="_blank">Mobile App Development Company</a> – Logicspice. All Rights Reserved</div>
</footer>
{{HTML::script('public/js/front/jquery.lazyload.js')}}
<script>
function addtolike(gid, type){
    $.ajax({
        url: "{!! HTTP_PATH !!}/users/likeunlike",
        type: "POST",
        data: {'gid': gid, 'type': type, _token: '{{csrf_token()}}'},
        beforeSend: function() {$('#lik'+gid).show();},
        complete: function() {$('#lik'+gid).hide();},
        success: function (result) {
           $('#likeunlikeid'+gid).html(result);
        }
    });
}

@if(Session::get('user_id') && Session::get('user_id') > 0)
$(document).ready(function() { 
    getmessage();
});

function getmessage(){
    $.ajax({
        url: "{!! HTTP_PATH !!}/check-new-notification",
        type: "GET",
        success: function (result) {
            if(result == 1){
                
            }else{
                $('#checkunreadmsg').removeClass('displaynone');
                $('#msgcontaine').removeClass('displaynonenot');
                $("#msgcontaine").html('');
                servers = $.parseJSON(result);
                $.each(servers, function(index, value) {        
                    $("#msgcontaine").append('<li><a href="{{HTTP_PATH}}/users/view-notification/'+value.url+'"><h3>'+value.message+'</h3><div class="job-tatle">'+value.from_name+'<span> '+value.timeago+'</span></div></a></li>');
                });
            }
        }
    });
}
setInterval(function() { getmessage(); }, 30000);
@endif
$(document).ready(function () {
    $("img.lazy").lazyload();
});
</script>