<template>
    <div><loading :active.sync="isLoading" 
        :can-cancel="true" 
        :color="color"
        :is-full-page="fullPage"></loading> 
        <div class="row align-items-center mb20">
                                    <div class="col-sm-9 "  style="padding-left:0px;">
                                      <div class="col-sm-12">
                                          <div class="ch_paypalemail mb20">
                                              <h4 style="margin-bottom: 15px;">Bank Transfer For Withdrawing Revenue</h4>   
                                          </div>
                                      </div>
                                      
                                          <div class="passmsg" id="emailmsg"></div>
                                              <form @submit.prevent="submit()">
                                                <div class="col-sm-4 text-left pd10">
                                                    Bank Name
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="bank_name" v-model="form.bank_name"  :class="{ 'is-invalid': form.errors.has('bank_name') }"  placeholder="Bank name">
                                                    <has-error :form="form" field="bank_name"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 text-left pd10">
                                                    Bank Country
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                           <input type="text" class="form-control" name="bank_country" v-model="form.bank_country"  :class="{ 'is-invalid': form.errors.has('bank_country') }"  placeholder="Bank Country">
                                                    <has-error :form="form" field="bank_country"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 text-left pd10">
                                                    Bank State/Province/Region
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="bank_state" v-model="form.bank_state"  :class="{ 'is-invalid': form.errors.has('bank_state') }"  placeholder="Bank State">
                                                    <has-error :form="form" field="bank_state"></has-error>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4 text-left pd10">
                                                    Bank City
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="bank_city" v-model="form.bank_city"  :class="{ 'is-invalid': form.errors.has('bank_city') }"  placeholder="Bank City">
                                                    <has-error :form="form" field="bank_city"></has-error>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4 text-left pd10">
                                                    Account Holder Name
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="account_name" v-model="form.account_name"  :class="{ 'is-invalid': form.errors.has('account_name') }"  placeholder="Account Name">
                                                    <has-error :form="form" field="account_name"></has-error>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4 text-left pd10">
                                                    Account No.
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="account_number" v-model="form.account_number"  :class="{ 'is-invalid': form.errors.has('account_number') }"  placeholder="Account Number">
                                                    <has-error :form="form" field="account_number"></has-error>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4 text-left pd10">
                                                    Iban Number (optional)
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="iban_number" v-model="form.iban_number"  :class="{ 'is-invalid': form.errors.has('iban_number') }"  placeholder="Iban Number">
                                                    <has-error :form="form" field="iban_number"></has-error>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4 text-left pd10">
                                                   Swift Code (optional)
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="setting-input">
                                                        <div class="form-group">
                                                             <input type="text" class="form-control" name="swift_code" v-model="form.swift_code"  :class="{ 'is-invalid': form.errors.has('swift_code') }"  placeholder="Swift Code">
                                                    <has-error :form="form" field="swift_code"></has-error>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-8">
                                        </div>
                                        <div class="col-sm-4">        
                                                    <div class="form-group text-right" style="padding-right:5px;">
                                                        <div class="setting-btn">
                                                            <button type="submit" class="succbtn" id="bankbtn" style="margin-right: 20px;">Update Bank Details</button>
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
                bank_name: this.user.bank_name,
                bank_country: this.user.bank_country,
                bank_state: this.user.bank_state,
                bank_city: this.user.bank_city,
                account_name: this.user.account_name,
                account_number: this.user.account_number,
                iban_number: this.user.iban_number,
                swift_code: this.user.swift_code,
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
          await  this.form.post('/users/updateBank')
            .then((response) => {
            this.isLoading = false;
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Bank details Saved!',
                    showConfirmButton: false,
                    timer: 1500
                    }) 
            })
            .catch(error => {
                this.isLoading = false
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please review required fields',
                    // title: error.response.data.errors.email,
                    showConfirmButton: false,
                    timer: 1500
                    })
            })
        }
    }

}
</script>