<template>
    <star-rating :border-width="1" v-model="rate" :read-only="true" :star-size="16" active-color="#fe423d" :show-rating="false" :increment="0.1" border-color="#d8d8d8" :rounded-corners="true" :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"></star-rating>
    
</template>

<script>

import StarRating from 'vue-star-rating'

export default {
    components: {
  StarRating
},
props:['rate']
}

</script>
<style lang="scss" scoped>
.fw{
    with:100%;
}

</style>