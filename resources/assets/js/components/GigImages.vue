<template>
<carousel :autoplay="true" :nav="false" :items="1" :loop="toLoop">
	<div class="lm text-center" v-for="image in images" :key="image.id">	
   		<img  :src="'/public/files/gigs/full/' + image.name" >
   	</div>	
   <!-- <img src="/public/files/gigs/full/1bbe8026_social.jpg" class="fw">
   <img src="/public/files/gigs/full/1e128e1d_illustration1.jpg" class="fw"> -->
   
</carousel>
</template>

<script>

import carousel from 'vue-owl-carousel'

export default {
    components: { carousel },
    props:['images'],
    computed: {
    	toLoop(){
    		if(this.images.length > 1){
    			return true;
    		}
    		else { return false; }
    	}
    }
}

</script>
<style lang="scss" scoped>
.fw{
    with:100%;
}
.lm{
	height:500px;
	text-align:center;
	justify-content:center;
	img{
		height:490px;
		margin: auto;
		width:auto;
		vertical-align:middle;
  		object-fit:contain;
	}
}

</style>