<template>
    <div>
        <div class="col-xs-12 col-sm-4 col-md-6 no-padding" v-if="contact">
      <loading :active.sync="isLoading" 
        :can-cancel="true" 
        :color="color"
        :is-full-page="fullPage"></loading> 
      <div class="message_middel_part">
                        <span v-if="isOnline(contact.id)" class=" indicator online"></span>
                                    <span v-else class="indicator offline"></span><h4 >&nbsp; {{contact.user_name}} | 
                                        <small v-if="isOnline(contact.id)"> Online </small>
                                        <small v-else> Offline </small> | </h4>
                        
                        <div class="messagebx_middel messagebx_middel_rightr" ref="feed" id="message_part">
                            <ul>
                                <li>
                                    <div v-if="page >= 1" v-observe-visibility="handleScrolledToTop"
                                ></div>
                                </li>
                                <li v-for="message in sortedMessages" :key="message.id">
                                    <!--                                    <a href="{{ URL::to( 'public-profile/'.$message->Sender->slug)}}">-->
                                    <div v-if="message.sender_id == contact.id" class="user_imges">  
                                        <!-- <img v-if="!contact.profile_image" src="/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/files/users/small/'+ contact.profile_image" > -->
                                        <img v-if="!contact.profile_image" src="/public/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/public/files/users/small/'+ contact.profile_image" >
                                    </div>
                                    <div v-if="message.sender_id == user.id" class="user_imges">  
                                        <!-- <img v-if="!contact.profile_image" src="/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/files/users/small/'+ user.profile_image" > -->
                                        <img v-if="!contact.profile_image" src="/public/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/public/files/users/small/'+ user.profile_image" >
                                    </div>
                                    <div class="message_chat_right">
                                        <h3 v-if="message.sender_id == contact.id">
                                            {{contact.user_name}}
                                            <span>{{message.created_at | myDate }}</span>
                                        </h3>
                                          <h3 v-if="message.sender_id != contact.id">
                                            Me
                                            <span>{{message.created_at | myDate }}</span>
                                        </h3>
                                        <p class="message">{{message.message}}</p>
                                        
                                        <!-- <a href="{{URL::to('messages/download/'.$message->slug.'/'.$message->attachment)}}" class="download_imges">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                        </a> -->
                                    </div>
                                    <!--                                    </a>-->
                                </li>
                                <li v-if="isTyping(contact.id)">
                                    <div class="user_imges">  
                                        <img v-if="!contact.profile_image" src="/public/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/public/files/users/small/'+ contact.profile_image" >
                                        <!-- <img v-if="!contact.profile_image" src="/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/files/users/small/'+ contact.profile_image" > -->

                                    </div>
                                    <div class="message_chat_right">
                                        <h3>
                                            {{contact.user_name}}
                                        </h3>
                                          
                                        <p class="message">Typing a message...</p>
                                        
                                        <!-- <a href="{{URL::to('messages/download/'.$message->slug.'/'.$message->attachment)}}" class="download_imges">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                        </a> -->
                                    </div>
                                </li>
                                
                                

                            </ul>
                        </div>
      </div>
        <Composer :contact="contact" :usersTyping="usersTyping" :user="user" />
  </div>
  <div v-if="contact" class="col-xs-12 col-sm-4 col-md-3 no-padding">
                    <About :contact="contact" />    
  </div>
  <div v-if="!contact" class="col-xs-12 col-sm-8 col-md-9 no-padding">
                    <div class="blank_mesage text-center">
                        <div class="chat-logo"><img src="/public/img/prozed-chat.png" /></div>
                        <div><strong class="font-accent">Select a Conversation</strong><br /></div>
                        <div><small>Try selecting a conversation or searching for someone specific.</small></div>
                    </div>
  </div>
    </div>
</template>

<script>
// Import component
    import Loading from 'vue-loading-overlay';
    import Composer from './Composer.vue';
    import About from "./About.vue";
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    props:['onlineUsers','usersTyping', 'user'],
    data(){
        return {
            contact: null,
            isLoading: false,
            fullPage: false,
            color: '#E73732', 
            messages:[],
            page: 1,
            scrolling: false,
            lastPage: 1,
            messagesSent:[],
            toBeFiltered:[]
        }
    },
    components: {
            Loading,
            Composer,
            About
        },
    methods:{
        handleScrolledToTop(isVisible){
            if(!isVisible) { return }
            if(this.page >= this.lastPage) { return }
            this.page++;
            this.scrolling = true;
            this.fetchMessages();
            this.scrollTo();
        },
      async  fetchMessages(){
            // axios.get('/messages/' + contact.id)
            if(this.contact){
                this.isLoading = true;
            await axios.get(`/messages/${this.contact.id}?page=${this.page}`, {perPage: 10})
            .then((response) => {
            this.toBeFiltered.push(...response.data.data);
            if(this.messagesSent){
            let arrayFiltered = this.toBeFiltered.filter((el) => { return !this.messagesIds.includes(el.id) })
            this.messages.push(...arrayFiltered);
            } else if(!this.messagesSent){ 
            this.messages.push(...response.data.data);
            }
            this.lastPage = response.data.last_page;
            })
            this.isLoading = false;
            }
        },
        scrollToBottom(){
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 300);
        },
        scrollTo(){
            setTimeout(() => {
                this.$refs.feed.scrollTop+= 140;
            }, 150);
        },
        isOnline(id){
            let objArray = _.map(this.onlineUsers, _.property('id'));
            let result = objArray.includes(id);
              return result;
            },
            isTyping(id){
            let objArray = _.map(this.usersTyping, _.property('id'));
            let result = objArray.includes(id);
              return result;
            },
    },
    created(){
        Try.$on('convoDeleted', () => {
            this.contact = null;
        })
        Try.$on('selected', (contact) => {
            this.messages = [];
            this.page = 1;
            this.lastPage =1;
            this.messagesSent =[];
            this.toBeFiltered =[];
            setTimeout(() => {
            this.contact = contact;
            this.fetchMessages();
            }, 150);
            
        })
        Try.$on('MessageSent', (message) => {
            this.messages.push(message);
            // if(this.contact.id == message.receiver_id){
            // this.messagesSent.push(message);
            this.scrolling = false;
            // }
        })
        Try.$on('NewIncoming', (message) => {
            if(this.contact && this.contact.id == message.sender_id){
                this.messages.push(message);
            }
        })
    },
    computed: {
        messagesIds(){
             let objArray = _.map(this.messages, _.property('id'));
            return objArray;
        },
        sortedMessages(){
            
            return _.sortBy(this.messages, [(message) => {
                // if(contact == this.selected) {
                //     return Infinity;
                // }

                const test =new Date(message.created_at);
                return test;
            }]);
        },
    },
    watch: {
        contact(contact){
        this.scrollToBottom();
        },
        usersTyping(usersTyping){
        this.scrollToBottom();
        },
        messages(message){
            if(!this.scrolling){
               this.scrollToBottom();
            }

        }
    }

}
</script>

<style lang="scss" scoped>
.blank_message{
    align-items: center;
    align-content: center;
    display: flex;
    flex-direction: column;
}
.chat-logo{
    height:60px;
    width: 90px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;
    // position: absolute;
    // top:130px;
}
.message{
    max-width: 340px;
    overflow-wrap: break-word;
}
.indicator.offline {
    background: #9D9D9D;
    display: flex;
    position: absolute;
    left:6px;
    top:20px;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    border:1px solid white;

}
.indicator.online {
    background: #28B62C;
    display: flex;
    position: absolute;
    left:6px;
    top:20px;
    width: 1em !important;
    height: 1em !important;
    border-radius: 50%;
    border:1px solid white;
    -webkit-animation: pulse-animation 2s infinite linear;
}

@-webkit-keyframes pulse-animation {
	0% { -webkit-transform: scale(1); }
	25% { -webkit-transform: scale(1); }
    50% { -webkit-transform: scale(1.2) }
    75% { -webkit-transform: scale(1); }
    100% { -webkit-transform: scale(1); }
}
.message_middel_part{
    border-right: none;
}
.username {
    margin-right:10px !important;
    padding-right: 5px !important;
}
.messagebx_middel{
    min-height:400px !important;
    max-height:00px !important;
    }
.messagebx_middel ul li {
    
    border:none !important;
}
.user_imges{
    height:45px!important;
    width:45px!important;
}
span.status {
                    color: #0eb350;
                    background: #0eb350 !important;
                    position: absolute;
                    left:6px;
                    top:20px;
                    display:flex;
                    width:10px !important;
                    height:10px !important;
                    font-weight: 700;
                    font-size: 10px;
                    margin:0;
                    padding: 0;
                    border-radius: 50%;
                    border:1px solid white;

                }
</style>