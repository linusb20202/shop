<template>
  <div>
    <div class="floating-div">
          <picker v-if="emoStatus" @select="onInput" set="apple" tooltip  />
      </div>
      <div class="messagebx_commant">
           <textarea ref="composer" class="form-control" v-model="message" @keydown.enter.prevent="sendMessage" @keydown="sendTypingEvent" placeholder="Message..."></textarea>
            <div class="meaasges_btn">
                <div class="attach_fliles">
                    
                </div>                                
                <i @click="toggleEmo" class="fa-2x fa-smile-o emo"> </i>&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0);" class="create_offer" data-toggle="modal" data-target="#offerModel"> Create an offer</a>
               <button class="btn btn-primary" @click="sendMessage">Send 
                 
               </button>
            </div>
        </div>
  </div>
</template>

<script>
import { Picker } from "emoji-mart-vue";
export default {
  props:['contact','usersTyping', 'user'],
  data(){
    return{
      message:'',
      typingTimer:false,
      typing:0,
      emoStatus: false
      // contact: ''
    }
  },
  components:{
    Picker
},
  methods:{
    async sendMessage(){
      if(this.message){
        await axios.post('/messages/send/' + this.contact.id, {
           message: this.message,
        })
        .then((response) => {
          Try.$emit('MessageSent', response.data);
          this.message = ''
            // this.$refs.composer.focus();
        })
      }
    },
    toggleEmo(){
            this.emoStatus = !this.emoStatus;
            this.$refs.composer.focus();

        },
        onInput(e){
            if(!e){
                return false;
            }
            if(!this.message){
                this.message = e.native + ' ';
            } else {
                this.message = this.message + ' ' + e.native + ' ';
            }
            this.$refs.composer.focus();

            this.sendTypingEvent();
        },
    sendTypingEvent(){
      //  if(this.usersTyping){
      //    let objArray = _.map(this.usersTyping, _.property('id'));
      //                   let result = objArray.includes(this.user.id);
      //                   console.log(this.user.id, objArray);
      //   if(!result){
      //     Echo.private(`typingTo.${this.contact.id}`)
      //             .whisper('typingUser',this.user)
      //   }
      //  } else { Echo.private(`typingTo.${this.contact.id}`)
      //             .whisper('typingUser',this.user) }
                    if(this.typing <= 1){
                       Echo.private(`typingTo.${this.contact.id}`)
                        .whisper('typingUser',this.user)
                        this.typing += 1;
                        // console.log('typing')
                    }

                        if(this.typingTimer){
                            clearTimeout(this.typingTimer);
                        }
                        this.typingTimer = setTimeout(() => {
                          // console.log('test')
                        // Echo.private(`typingTo.${this.contact.id}`)
                        // .whisper('typingUser',this.user)
                        this.typing = 0;
                        Echo.private(`typingTo.${this.contact.id}`)
                        .whisper('typingStop',this.user)
                        // console.log('done')
                        }, 3000);
        },
  },
  created(){
    Try.$on('selected', (contact) => {
            this.message = '';
            this.$refs.composer.focus();
            // setTimeout(() => {
            // this.$refs.composer.focus();
            // }, 200);
        })
    setTimeout(() => {
            this.$refs.composer.focus();
    }, 200);
  }

}
</script>

<style lang="scss" scoped>
.emo{
  cursor: pointer;
}
.floating-div {
    position:absolute;
    bottom:120px;
}
.form-control{
  resize: none;
  border-radius: 10px;
}
.btn{
  text-decoration: none;
  
}
</style>