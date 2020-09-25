<template>
    <div><loading :active.sync="isLoading" 
        :can-cancel="true" 
        :color="color"
        :is-full-page="fullPage"></loading> 
        <div class="row align-items-center mb10">
                                  <div class="col-sm-9" style="padding-left:0px;">
                                    <div class="col-sm-12" style="margin-top:-20px;">
                                          <div class="ch_paypalemail mb20">
                                              <h4 class="mb10" style="margin-bottom: 15px;">Paypal For Withdrawing Revenue</h4>   
                                          </div>
                                      </div>
                                        <form @submit.prevent="submit()">
                                        <div class="passmsg" id="emailmsg"></div>
                                            <div class="col-sm-4 text-left pd10">
                                                Enter Paypal Email
                                            </div>
                                        <div class="col-sm-8">
                                            <div class="setting-input">
                                                <div class="form-group mb10">
                                                <input v-model="form.paypal_email" type="email" name="paypal_email" required autocomplete="off"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('paypal_email') }">
                                                    <has-error :form="form" field="paypal_email"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                        </div>
                                        <div class="col-sm-4">

                                            <div class="form-group text-right" style="padding-right:5px;">
                                                <div class="setting-btn">
                                                    <button type="submit" :disabled="form.busy" class="succbtn" id="paypalemailbtn" style="margin-right: 20px;">Change Paypal Email</button>
                                                </div>
                                            </div>
                                        </div>    
                                    </form>            
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
    props:['user'],
    data() {
        return {
            form: new Form({
                paypal_email: this.user.paypal_email
            }),
            isLoading: false,
            fullPage: true,
            color: '#E73732',
        }
    },
    components:{
        Loading
    },
    methods: {
       async submit(){
            this.isLoading = true;
          await  this.form.post('/users/updatePaypal')
            .then((response) => {
            this.isLoading = false;
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Paypal Email saved!',
                    showConfirmButton: false,
                    timer: 1500
                    }) 
            })
            .catch(error => {
                this.isLoading = false
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please enter a valid paypal Email',
                    // title: error.response.data.errors.email,
                    showConfirmButton: false,
                    timer: 1500
                    })
            })
        }
    }

}
</script>