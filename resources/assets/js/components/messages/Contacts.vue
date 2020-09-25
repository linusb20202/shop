<template>
  <div><loading :active.sync="isLoading" 
        :can-cancel="true" 
        :color="color"
        :is-full-page="fullPage"></loading> 
                <div class="col-xs-12 col-sm-4 col-md-3 no-padding">
                    <div class="message_left_part">
                        <h4>All Conversations</h4>
                        <div class="contacts-list">
                            <ul>
                                <!-- <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }"> -->
                                <li :class="selectedContact.id == contact.id ? 'active' : '' " v-for="contact in sortedContacts" :key="contact.id" @click="selected(contact)">    
                                    <div class="avatar">
                                        <!-- <img v-if="!contact.profile_image" src="/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/files/users/small/'+ contact.profile_image" > -->
                                        <img v-if="!contact.profile_image" src="/public/img/front/user-img.png" >
                                        <img v-if="contact.profile_image" :src="'/public/files/users/small/'+ contact.profile_image" >
                                    <span v-if="isOnline(contact.id)" class=" indicator online"></span>
                                    <span v-else class="indicator offline"></span>
                                    </div>
                                    <div class="contact">
                                        <p class="name" v-if="pogi">{{contact.user_name}}</p>
                                        <p class="email" v-if="contact.last_message">{{contact.last_message.message | trunc}} </p> 
                                    </div>

                                    <span class="date" v-if="contact.last_message"> {{contact.last_message.created_at | myDate2}}</span>
                                    <span v-if="contact.unread_messages_count" class="unread" >{{contact.unread_messages_count}}</span>
                                    <span class="fa fa-star starred"></span>
                                    <!-- <span  class="unread" >{{contact.last_message.created_at | myDate2}}</span> -->
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
  </div>
</template>

<script>
// Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    props:['onlineUsers','receiver', 'user'],
    data() {
        return{
            contacts:[],
            pogi: true,
            isLoading: false,
            fullPage: false,
            color: '#E73732',
            selectedContact: '',
            // onlineUsers: []
        }
    },
    components: {
            Loading
        },
    methods: {
        async fetchContacts(){
            this.isLoading = true;
            await axios.get('/contacts')
            .then((response) => { 
                this.contacts = response.data; 
                })
            this.isLoading = false;

        },
        selected(contact){
            Try.$emit('selected', contact);
            this.selectedContact = contact;
            this.updateUnreadCount(contact, true);

        },
        isOnline(id){
            let objArray = _.map(this.onlineUsers, _.property('id'));
            let result = objArray.includes(id);
              return result;
            },
        // markAsRead(){
            
        // },
        updateLatestMessage(contact, message){
                this.contacts = this.contacts.map((single) => {
                    if(single.id != contact.id) {
                        return single;
                    }
                    single.last_message = message;
                        return single;
                })
            },
            updateUnreadCount(contact, reset){
                this.contacts = this.contacts.map((single) => {
                    if(single.id != contact.id) {
                        return single;
                    }
                    if(reset)
                        single.unread_messages_count = 0;
                    else
                        // single.latest = message.text;
                        single.unread_messages_count += 1;

                        return single;
                })
            },
        
    },
     filters: {
        trunc(str, len = 15) {
            _.trim(str);
            return _.truncate(str, {'length': len});
        },

        },

    created(){
        if(this.receiver.id != this.user.id ){
            this.selectedContact =  this.receiver;
            
        }
        this.fetchContacts();
        Try.$on('convoDeleted', () => {
            this.fetchContacts();
        })
        Try.$on('NewIncoming', (message) => {
            let objArray = _.map(this.contacts, _.property('id'));
            let result = objArray.includes(message.sender.id);
            if(!result) {
                message.sender.unread_messages_count = 1;
                this.contacts.push(message.sender);
            }
            if(this.selectedContact && this.selectedContact.id == message.sender_id){
            this.updateLatestMessage(message.sender, message);
            this.updateUnreadCount(message.sender, true);
            } else { 
            this.updateUnreadCount(message.sender, false);
            this.updateLatestMessage(message.sender, message);
            }
            

        })
    },
    computed: {
        sortedContacts(){
                    return _.sortBy(this.contacts, [(contact) => {
                        // if(contact == this.selectedContact) {
                        //     return Infinity;
                        // }
                        if(!contact.last_message){
                            return !Infinity;
                        }
                        const test =new Date(contact.last_message.created_at);
                        return test;
                        // return contact.unread_messages_count;
                    }]).reverse();
                },
    }

}
</script>

<style lang="scss" scoped>
.date{
    margin-right: 10px;
    position: absolute;
    right: 8px;
    top: 25px;
}
.message_left_part{
    height:600px;
}
.active {
    background-color: #e5f8e6;
}
.indicator.offline {
    background: #9D9D9D;
    display: flex;
    position: absolute;
    left:43px;
    top:44px;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    border:2px solid white;
}
.indicator.online {
    background: #28B62C;
    display: flex;
    position: absolute;
    left:43px;
    top:44px;
    width: 1em;
    height: 1em;
    border-radius: 50%;
    border:2px solid white;
    // -webkit-animation: pulse-animation 2s infinite linear;
}
// @-webkit-keyframes pulse-animation {
// 	0% { -webkit-transform: scale(1); }
// 	25% { -webkit-transform: scale(1); }
//     50% { -webkit-transform: scale(1.2) }
//     75% { -webkit-transform: scale(1); }
//     100% { -webkit-transform: scale(1); }
// }
    .contacts-list {
        flex: 2;
        max-height: 545px;
        overflow-y:scroll;
        // border-right: 1px solid #a6a6a6;
        ul {
            list-style-type: none;
            padding-left: 0;
            height:545px;
            li:hover{
                background-color: #F8F8FF;
            }
            li {
                display: flex;
                padding:2px;
                border-bottom: 1px solid #c5c5c5;
                height: 80px;
                position: relative;

                cursor: pointer;

                &.selected {
                    background: lightblue;
                }
                span.unread {
                    background: #82e0a8;
                    color:#fff;
                    position: absolute;
                    right:36px;
                    top:1px;
                    display:flex;
                    font-weight: 700;
                    min-width: 20px;
                    justify-content: center;
                    align-items: center;
                    line-height: 20px;
                    font-size: 12px;
                    padding: 0 4px;
                    border-radius: 50%;
                }
                span.starred {
                    // background: #82e0a8;
                    color:#fff02a;
                    position: absolute;
                    right:2px;
                    top:0px;
                    display:flex;
                    font-weight: 700;
                    min-width: 20px;
                    justify-content: center;
                    align-items: center;
                    line-height: 20px;
                    font-size: 18px;
                    padding: 0 4px;
                    border-radius: 50%;
                }
                span.status {
                    color: #0eb350;
                    background: #0eb350 !important;
                    position: absolute;
                    left:43px;
                    top:44px;
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

                .avatar {
                    display:flex;
                    flex:1;
                    align-items: center;
                    img {
                        width: 35px;
                        height: 36px;
                        border-radius: 50%;
                        margin: 0 auto;
                        border: 1px solid #c5c5c5;
                    }
                }
                .contact {
                    display: flex;
                    flex:3;
                    font-size: 12px;
                    overflow:hidden;
                    flex-direction: column;
                    justify-content: center;
                    p {
                        margin: 0;
                        &.name {
                            font-weight: bold;
                            font-family: ProximaNova, "Helvetica Neue", Helvetica, Arial, sans-serif
                        }
                        
                    }
                }
                
            }
            
        }
    }
</style>
