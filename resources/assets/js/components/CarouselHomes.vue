<template>
<carousel class="custom-pag" :per-page="1" paginationSize="12" :navigate-to="someLocalProperty" autoplay :mouse-drag="true" :loop="true" :paginationEnabled="true" paginationPosition="bottom-overlay"  paginationActiveColor="#fe423d" paginationPadding="5" easing="all ease-in-out"  :speed="2000"  :autoplayTimeout="6000">
    <slide>
        <div class="custom_overlay_wrapper"><img src="/public/img/front/banner-home.jpg" class="fw"><div class="custom_overlay"><span class="custom_overlay_inner"><h3>Find Best Service Provider</h3><p>Find best service according to your requirement</p></span></div></div>
    </slide>
    <slide>
        <div class="custom_overlay_wrapper"><img src="/public/img/front/banner-home2.jpg" class="fw"><div class="custom_overlay"><span class="custom_overlay_inner"><h3>Get offer for seller</h3><p>Get best offer for your service if you not proper seller</p></span></div></div>
    </slide>
</carousel>
</template>

<script>

import {Carousel, Slide} from 'vue-carousel'

export default {
    components: { Carousel, Slide },
}

</script>
<style lang="scss">
.fw{
    with:100%;
}
.custom-pag {
    .VueCarousel-pagination--bottom-overlay {
    text-align:left !important;
    margin: 0 0 15px 20px !important;
    }
    
}
.custom_overlay_wrapper { position: relative; }

.custom_overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: left;
    margin-left:10px;
    opacity: 1;
    -webkit-transition: all 400ms ease-in-out;
    -moz-transition: all 400ms ease-in-out;
    -o-transition: all 400ms ease-in-out;
    transition: all 400ms ease-in-out;
}



.custom_overlay_inner {
    position: absolute;
    top: 35%;
    left: 15px;
    right: 10px;
    transform: translateY(-50%);
}

.custom_overlay h3 {
    position: relative;
    margin-bottom: 4px;
    color:white;
    font-size: 28px;
    font-family: 'robotobold';
}

.custom_overlay p { 
    color: white;
    line-height: 1.4em;
    font-size: 18px;
    padding-top: 10px;
}

.custom_overlay h3:after {
    
    content: "";
    position: absolute;
    left: 35%;
    right: 35%;
    bottom: 0;
    height: 4px;
    font-size: 28px;
    font-family: 'robotobold';
}

/*------------------- TABLET ------------------*/
@media only screen and ( min-width: 600px ) and ( max-width: 999px ) {
    .custom_overlay h3 { font-size: 80%;}
    .custom_overlay p { 
        font-size: 85%;
        line-height: 1.2em;
    }
}

/*------------------- MOBILE ------------------*/
@media only screen and ( max-width: 599px ) {
    .custom_overlay h3 { font-size: 100%;}
    .custom_overlay p { font-size: 100%;}
}
</style>