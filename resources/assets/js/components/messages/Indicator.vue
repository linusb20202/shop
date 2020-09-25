<template>
  
      
       <!-- <a href='javascript:void();'>Message <span v-if="unreadCount" class="indicator offline"></span></a>
                            <ul  class="notification" id="msgcontaine" style="display: block;">
                                <li><a href="messages/message"><h3>Test</h3><div class="job-tatle">Linus Smart2<span> 23 hours ago</span></div></a>
                                </li>
                            </ul> -->
            <li class="left notification-b" >
            <a href='/messages/message'>Message<span v-if="unreadCount" class="indicator offline"></span></a>
            <ul  class="notification" v-if="unreadCount" id="msgcontaine" style="display: block;">
                <li  v-for="unread in unreadMessages" :key="unread.id"><a href="http://laravelvue.seenshop.com/messages/message"><h3>{{unread.message | trunc}}</h3><div class="job-tatle">{{unread.sender.user_name}}<span>{{unread.created_at | myDate2}}</span></div></a>
                </li>
            </ul>
            </li>
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
        // selected(contact){
        //     Try.$emit('selected', contact);
            

        // },
    },
    created(){
        // this.getUnreadCount();
        // Try.$on('selected', () => {
        //     this.unreadCount = 0;
        // })
    },
    filters: {
        trunc(str, len = 20) {
            _.trim(str);
            return _.truncate(str, {'length': len});
        },

        },
    computed: {
        unreadCount(){
            return this.$parent.unread.length;
        },
        unreadMessages(){
            return _.sortBy(this.$parent.unread, [(unr) => {

                const test =new Date(unr.created_at);
                        return test;

                }]).reverse();
            // return this.$parent.unread;
        }
    },
mounted(){
    Echo.private(`messages.${this.user.id}`)
            .listen('NewMessage', (e) => {
                
                Try.$emit('NewUnread', e.message);
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