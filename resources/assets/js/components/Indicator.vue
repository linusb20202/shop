<template>
  <div>
      
       <span v-if="unreadCount" class="indicator offline"></span>
       
                            <ul  class="notification" id="msgcontaine" style="display: block;">
                                <li><a href="messages/message"><h3>Test</h3><div class="job-tatle">Linus Smart2<span> 23 hours ago</span></div></a>
                                </li>
                            </ul>
  </div>
</template>

<script>
export default {
    props:['user'],
    // data(){
    //     return {
    //         unreadCount: 0
    //     }
    // },
    methods:{
        // async getUnreadCount(){
        // await axios.get('/message/getUnreadCount')
        // .then((response) => {
        //     // console.log(response)
        //     this.unreadCount = response.data;
        // })
        // },
        playSound(){
            var sound = new Audio('../public/audio/alert2.mp3')
            // var sound = new Audio('../audio/alert2.mp3')
            sound.play()
        },
    },
    created(){
        // this.getUnreadCount();
        // Try.$on('selected', () => {
        //     this.unreadCount = 0;
        // })
    },
    
    computed: {
        unreadCount(){
            return this.$parent.unreadCount;
        }
    },
mounted(){
    Echo.private(`messages.${this.user.id}`)
            .listen('NewMessage', (e) => {
                // console.log(e.message);
                this.$parent.unreadCount += 1;
                this.playSound();
            })
}
}
</script>

<style lang="scss" scoped>

.indicator.offline {
    background: rgb(240, 3, 3);
    display: flex;
    position: absolute;
    left:69px;
    top:12px;
    width: 0.29em;
    height: 0.38em;
    border-radius: 50%;
    // border:2px solid white;
}
</style>