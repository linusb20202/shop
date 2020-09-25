<template>
  <div>
                        <div class="orders1">
                        <h4>Orders</h4>
                                                <p>1</p>
                        </div>
                        <div class="orders">
                        <h4>Orders</h4>
                        <br>
                        <a href="#">Past Orders(3)</a>
                        </div>
      <div class="message_abouts">
                        <h4>About</h4>
                        <div class="dots">
                                             <i @click="deleteConvo" class="fa-2x fa-trash trash"></i>

                        </div>
                        
                 
                        <div class="message_abouts_user">
                            <div class="message_abouts_img">
                                <img v-if="!contact.profile_image" src="/public/img/front/user-img.png" >
                                <img v-if="contact.profile_image" :src="'/public/files/users/small/'+ contact.profile_image">
                                <!-- <img v-if="!contact.profile_image" src="/img/front/user-img.png" >
                                <img v-if="contact.profile_image" :src="'/files/users/small/'+ contact.profile_image"> -->
                            </div>
                            <h3>{{contact.user_name}}</h3>
                            <div class="message_details">
                                <div class="message_about_details">
                                    <label>Rating </label>
                                    <span><i class="fa fa-star starred"></i><b>{{contact.seller_rating}} (3)</b></span>
                                </div>
                                <div class="message_about_details">
                                    <label>Avg. Response Time</label>
                                    <span>1h</span>
                                </div>
                                <div class="message_about_details">
                                    <label>From </label>
                                    <span>
                                        {{contact.city}}</span>
                                </div>
                                <div class="message_about_details">
                                    <label>
                                       English, French, German                               
                                    </label>
                                    <span>Basic</span>
                                </div>
                            </div>
                        </div>
                    </div>
  </div>
</template>

<script>
export default {
    props:['contact'],
    methods:{
        deleteConvo(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                axios.get('/deleteConvo/' + this.contact.id)
                .then(function (response) {
                    Try.$emit('convoDeleted');

                    setTimeout(() => {
                        Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                    }, 1000);
                })
                
            }
            })
        }
    },
    

}
</script>

<style lang="scss" scoped>
.starred {
                    // background: #82e0a8;
                    color:#FE423D;
                    // position: absolute;
                    // right:2px;
                    // top:0px;
                    // display:flex;
                    font-weight: 700;
                    min-width: 20px;
                    // justify-content: center;
                    // align-items: center;
                    line-height: 20px;
                    font-size: 14px;
                    padding: 0 4px;
                    border-radius: 50%;
                }
.orders{
    border-bottom: 1px solid #ddd;
    border-left: 1px solid #ddd;

    padding:15px;
    height: 74px;
}
.orders1{
    border-bottom: 1px solid #ddd;
    padding:15px;
    height: 54px;
    color:white;
    cursor: default;
    text-decoration: none;
}
.orders a {
    text-decoration: underline;
}
.message_abouts{
    height:472px;
    border-left: 1px #ddd solid; 
}
.trash{
    color:#FE423D;
    
}
.trash:hover{
cursor: pointer;
}
.dot {
  height: 8px;
  width: 8px;
  margin-right:3px;
  margin-left:3px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}
.dots{
    position: absolute;
    display:flex;
    top: -4px;
    right: 5px;
}
</style>