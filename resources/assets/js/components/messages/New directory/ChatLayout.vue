<template>
  <div>
      <Contacts :onlineUsers="onlineUsers" />
                        <Messages :onlineUsers="onlineUsers" :usersTyping="usersTyping" :user="user"/>
  </div>
</template>

<script>
    import Contacts from './Contacts.vue';
    import Messages from './Messages.vue';

export default {
    props:['user'],
    data(){
        return{
            onlineUsers:[],
            typingUsers:[],
            typingTimer: false
        }
    },
    components: {
        Contacts, Messages
    },
    methods:{
        handleIncoming(message){

            Try.$emit('NewIncoming', message);
            this.typingUsers = this.typingUsers.filter(u=> u.id != message.sender_id);
            // this.playSound();
        },
        playSound(){
            var sound = new Audio('../audio/alert2.mp3')
            sound.play()
        },
    },
    mounted(){
        Echo.private(`messages.${this.user.id}`)
            .listen('NewMessage', (e) => {
                // console.log(e.message);
                this.handleIncoming(e.message);
            })
        Echo.join('login')
            .here(user => {
                this.onlineUsers = user;
            })
            .joining(user => {
            this.onlineUsers.push(user);
            })
            .leaving(user => {
                this.onlineUsers = this.onlineUsers.filter(u => u.id != user.id);
            })

        Echo.private(`typingTo.${this.user.id}`)
                .listenForWhisper('typingUser', (user) => {
                    //  const matchingUsersIndex = this.usersTyping.findIndex((item) => {
                    //         return item.id === user.id;
                    //     });
                    //  if (matchingUsersIndex <= -1) {
                    //      console.log(matchingUsersIndex)
                    //      this.usersTyping.push(user);
                    //  }

                        let objArray = _.map(this.usersTyping, _.property('id'));
                        let result = objArray.includes(user.id);

                        if(!result) {
                            this.usersTyping.push(user);
                        }

                        if(this.typingTimer){
                            clearTimeout(this.typingTimer);
                        }
                        this.typingTimer = setTimeout(() => {
                            // this.usersTyping = this.usersTyping.filter(u => u.id != user.id);
                    //   const  mactchingUserIndex = this.usersTyping.findIndex((single) => {
                    //     return single.id == user.id;

                    // });
                        this.typingUsers = this.typingUsers.filter(u => u.id != user.id);
                    // if(this.usersTyping[mactchingUserIndex]){
                    //     this.usersTyping.splice(mactchingUserIndex, 1);
                    // }

                        }, 3000);
                })    

    },
    computed:{
        usersTyping(){
            return this.typingUsers;
        }
    }
}
</script>

<style>

</style>