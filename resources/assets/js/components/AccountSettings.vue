<template>
    <div><loading :active.sync="isLoading" 
        :can-cancel="true" 
        :color="color"
        :is-full-page="fullPage"></loading> 
        <div class="row mt-0 border-bottom" >
                                    <div class="col-sm-12 text-left" style="margin-top:-20px; padding-top:0px;">
                                        <h4>Registration Data</h4>  
                                    </div>
                                </div>
                                  
                                <div class="row" style="padding-top:20px;">
                                    <div class="col-md-12 mx-auto">
                                        <form @submit.prevent="submit()">
                                            <div class="form-group row">
                                                <div class="col-sm-6 md-6 text-left">
                                                    <label for="inputFirstname" >First name </label><span style="font-style:italic;"> (private)</span>
                                                    <!-- <input type="text" class="form-control" v-model="first_name"   placeholder="First name"> -->
                                                    <input v-model="form.first_name" type="text" name="first_name" placeholder="Name"
                                                    class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                                <has-error :form="form" field="first_name"></has-error>
                                                </div>
                                                <div class="col-sm-6 md-6 text-left">
                                                    <label for="inputLastname">Last name </label><span style="font-style:italic;"> (private)</span>
                                                    <input type="text" class="form-control" name="last_name" v-model="form.last_name"  :class="{ 'is-invalid': form.errors.has('last_name') }"  placeholder="Last name">
                                                    <has-error :form="form" field="last_name"></has-error>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 md-6 text-left">
                                                    <label for="inputEmail">Email * </label><span style="font-style:italic;"> (private)</span>
                                                    <input v-model="form.email_address" type="email" name="email_address" required
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email_address') }">
                                                    <has-error :form="form" field="email_address"></has-error>
                                                </div>
                                                <div class="col-sm-6 md-6 text-left">
                                                    <label for="inputPhoneNumber">Phone Number </label><span style="font-style:italic;"> (private)</span>
                                                    <input type="number" class="form-control" v-model="form.contact"    placeholder="+123456789000">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 md-12 text-left " >
                                                    <label for="inputAddress">Address</label>
                                                    <input type="text" class="form-control" v-model="form.address"    placeholder="123 Street Name, Province">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 text-left">
                                                    <label for="inputState">Country</label>
                                                    <select class="form-control arrowed" id="sel1" v-model="form.country_id">
                                                        <option value="">--Select Country--</option>
                                                            <option  v-for="country in countries" :key="country.id"  :value="country.id">{{country.name}}</option>
                                                      </select>
                                                </div>
                                                <div class="col-sm-6 md-6 text-left address">
                                                    <label for="inputCity">City</label>
                                                    <input type="text" class="form-control" v-model="form.city"   placeholder="City">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 text-left address">
                                                    <label for="inputState">State/Province/Region</label>
                                                    <input type="text" class="form-control" v-model="form.state"   placeholder="State">
                                                </div>
                                                <div class="col-sm-6 md-6 text-left">
                                                    <label for="inputCity">Zip/Postal Code</label>
                                                    <input type="text" class="form-control" v-model="form.zipcode"   placeholder="Zip/Postal">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row" >
                                               
                                                <div class="col-sm-6 text-left">
                                                    <label for="inputPrefLang">Preffered Language</label>
                                                    <input type="text" class="form-control" v-model="form.pref_lang"   placeholder="Preferred Language">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 md-6 text-right">
                                                </div>
                                                <div class="col-sm-6 md-6 text-right">
                                                    <button type="submit" :disabled="form.busy" class="succbtn float-right" >Save Changes</button>

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

    props:['countries','user'],
    data() {
        return {
            isLoading: false,
            fullPage: true,
            color: '#E73732', 
            form: new Form({
            first_name: this.user.first_name,
            last_name:this.user.last_name,
            email_address:this.user.email_address,
            contact:this.user.contact,
            address:this.user.address,
            country_id: this.user.country_id,
            city:this.user.city,
            state:this.user.state,
            zipcode:this.user.zipcode,
            pref_lang:this.user.preferred_language
            })
        }
    },
    components: {
            Loading
        },
    methods: {
        async submit(){
            this.isLoading = true;
            await this.form.post('/users/updateAccount')
        //    await axios.post('/users/updateAccount', {
        //         first_name: this.first_name,
        //         last_name: this.last_name,
        //         email: this.email_address,
        //         contact: this.contact,
        //         address: this.address,
        //         country: this.country_id,
        //         city: this.city,
        //         state: this.state,
        //         zipcode: this.zipcode,
        //         pref_lang: this.pref_lang,
        //     })
            .then((response) => {
                this.isLoading = false
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Account Settings saved!!',
                    showConfirmButton: false,
                    timer: 1500
                    })
            
            })
            .catch(error => {
                this.isLoading = false
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please check errors on form',
                    // title: error.response.data.errors.email,
                    showConfirmButton: false,
                    timer: 1500
                    })
            })
            
        }
    }
}
</script>

<style>

</style>