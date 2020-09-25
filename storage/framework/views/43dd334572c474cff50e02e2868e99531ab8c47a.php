<footer >
    <div class="wrapper">
        <div class="footer_inner">
            <div class="foot_block foot_block_first">
                <div class="foot_title drop1">Top Categories</div>
                <div class="foot_menu block1">
                    <ul>
                        <?php if($globalCategories): ?>
                            <?php $__currentLoopData = $globalCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(URL::to( 'gigs/'.$cat->slug)); ?>"><?php echo $cat->name; ?></a></li>
                                <?php if($loop->iteration == 10): ?>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="foot_block">
                <div class="foot_title drop2">About</div>
                <div class="foot_menu block2">
                    <ul>
                        <li><a href="<?php echo e(URL::to( 'about-us')); ?>">About us</a></li>  
                        <li><a href="<?php echo e(URL::to( 'how-it-works')); ?>">How it works</a></li>  
                        <li><a href="<?php echo e(URL::to( 'privacy-policy')); ?>">Privacy policy</a></li>  
                        <li><a href="<?php echo e(URL::to( 'terms-and-condition')); ?>">Terms of service</a></li> 
                        <li><a href="<?php echo e(URL::to( 'press-and-news')); ?>">Press & News</a></li> 
                    </ul>   
                </div>
            </div>            
            <div class="foot_block">
                <div class="foot_title drop4">Support</div>

                <div class="foot_menu block4">
                    <ul>
                        <li><a href="<?php echo e(URL::to( 'contact-us')); ?>">Contact us</a></li> 
                        <li><a href="<?php echo e(URL::to( 'trust-and-safety')); ?>">Trust & safety</a></li> 
                        <li><a href="<?php echo e(URL::to( 'faqs')); ?>">FAQ</a></li> 
<!--                        <li><a href="#">Email</a></li>-->
                    </ul>   

                </div>

            </div>
            <div class="foot_block ">
                <div class="foot_title drop5">Follow Us</div>
                <div class="foot_menu block5">
                    <ul>
                        <?php if($siteSettings->facebook_link): ?>
                        <li><a href="<?php echo $siteSettings->facebook_link; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> facebook</a></li>
                        <?php endif; ?>
                        <?php if($siteSettings->twitter_link): ?>
                            <li><a href="<?php echo $siteSettings->twitter_link; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> twitter</a></li>
                        <?php endif; ?>
                        <?php if($siteSettings->google_link): ?>
                            <li><a href="<?php echo $siteSettings->google_link; ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i> google+</a></li>
                        <?php endif; ?>
                        <?php if($siteSettings->instagram_link): ?>
                            <li><a href="<?php echo $siteSettings->instagram_link; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> instagram</a></li>
                        <?php endif; ?>
                        <?php if($siteSettings->linkedin_link): ?>
                            <li><a href="<?php echo $siteSettings->linkedin_link; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i> linkedin</a></li>
                        <?php endif; ?>
                        <?php if($siteSettings->pinterest_link): ?>
                            <li><a href="<?php echo $siteSettings->pinterest_link; ?>" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> pinterest</a></li>
                        <?php endif; ?>
                        <?php if($siteSettings->youtube_link): ?>
                            <li><a href="<?php echo $siteSettings->youtube_link; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i> youtube</a></li>
                        <?php endif; ?>
                    </ul>   
                </div>
            </div>
        </div>
    </div>
    <div class="footer_adat"> © Copyright @ <?php echo date('Y'); ?> &nbsp;|&nbsp;  <a href="https://www.preffort.com/" target="_blank">Marketplace Service Platform</a> – Preffort. All Rights Reserved</div>
</footer>
<?php echo e(HTML::script('public/js/front/jquery.lazyload.js')); ?>

<script>
function addtolike(gid, type){
    $.ajax({
        url: "/users/likeunlike",
        type: "POST",
        data: {'gid': gid, 'type': type, _token: '<?php echo e(csrf_token()); ?>'},
        beforeSend: function() {$('#lik'+gid).show();},
        complete: function() {$('#lik'+gid).hide();},
        success: function (result) {
           $('#likeunlikeid'+gid).html(result);
        }
    });
}

<?php if(Session::get('user_id') && Session::get('user_id') > 0): ?>
$(document).ready(function() { 
    getmessage();
});

function getmessage(){
    $.ajax({
        url: "/check-new-notification",
        type: "GET",
        success: function (result) {
            if(result == 1){
                
            }else{
                $('#checkunreadmsg').removeClass('displaynone');
                $('#msgcontaine').removeClass('displaynonenot');
                $("#msgcontaine").html('');
                servers = $.parseJSON(result);
                $.each(servers, function(index, value) {        
                    $("#msgcontaine").append('<li><a href="<?php echo e(HTTP_PATH); ?>/users/view-notification/'+value.url+'"><h3>'+value.message+'</h3><div class="job-tatle">'+value.from_name+'<span> '+value.timeago+'</span></div></a></li>');
                });
            }
        }
    });
}
setInterval(function() { getmessage(); }, 30000);
<?php endif; ?>
$(document).ready(function () {
    $("img.lazy").lazyload();
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.drop1').click(function () {
            if ($('.drop1').hasClass('open1')) {
                $('.drop1').removeClass('open1');
            } else {
                $('.drop1').addClass('open1');
            }
            $(".block1").slideToggle();
        });

        $('.drop2').click(function () {

            if ($('.drop2').hasClass('open2')) {
                $('.drop2').removeClass('open2');
            } else {
                $('.drop2').addClass('open2');
            }
            $(".block2").slideToggle();
        });

        $('.drop3').click(function () {

            if ($('.drop3').hasClass('open3')) {
                $('.drop3').removeClass('open3');
            } else {
                $('.drop3').addClass('open3');
            }

            $(".block3").slideToggle();
        });

        $('.drop4').click(function () {

            if ($('.drop4').hasClass('open4')) {
                $('.drop4').removeClass('open4');
            } else {
                $('.drop4').addClass('open4');
            }
            $(".block4").slideToggle();
        });

        $('.drop5').click(function () {

            if ($('.drop5').hasClass('open5')) {
                $('.drop5').removeClass('open5');
            } else {
                $('.drop5').addClass('open5');
            }
            $(".block5").slideToggle();
        });
    });

</script>
<!--<script src="<?php echo e(asset('/public/js/app.js')); ?>" ></script>--><?php /**PATH /home/seenshop/laravel.seenshop.com/resources/views/elements/footer.blade.php ENDPATH**/ ?>