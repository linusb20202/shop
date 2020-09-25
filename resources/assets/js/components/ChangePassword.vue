<template>
    <div><loading :active.sync="isLoading" 
        :can-cancel="true" 
        :color="color"
        :is-full-page="fullPage"></loading> 
                                <div class="row mt-0 border-bottom" style="margin:0 5 0 0;padding:0px;">    
                                    <div class="col-sm-12 text-left" style=" margin-top:-20px; padding-top:0px;">
                                        <h4>Change Password</h4>  
                                    </div>
                                </div>
                                <div class="row" style="padding-top:20px;">
                                    <div class="col-sm-6">
                                        <div class="ch_password">
                                            
                                            <div class="passmsg" id="passmsg"></div>
                                            <div class="setting-input">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" v-model="password" required  placeholder="Old Password">
                                                </div>
                                            </div>
                                            <div class="setting-input">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" v-model="newPassword" required  placeholder="New Password">
                                                    <span class="help-text" v-if="passwordValidation.errors.length" >{{ passwordValidation.errors }}</span>
                                                </div>
                                            </div>
                                            <div class="setting-input">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" v-model="confirmPassword" required  placeholder="Confirm Password">
                                                    <span class="help-text danger" v-if="notSamePasswords">Passwords don't match!</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <div class="col-sm-11 md-11 text-right">
                                                        <div class="setting-btn">
                                                            <button type="submit"  @click.prevent="submitPasswords" class="succbtn" :disabled="!!notSamePasswords" style="margin-right:5px;" >Save Changes</button>
                                                        </div>
                                                    </div>
                                                    
                                            </div>
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
    data(){
        return {
            rules: [
				{ message:"8 characters minimum", regex:/.{8,}/ },
				{ message:'at least 1 lowercase letter', regex:/[a-z]+/ },
				{ message:"at least 1 uppercase letter",  regex:/[A-Z]+/ },
				{ message:"at least 1 number", regex:/[0-9]+/ }
			],
            password:'',
            newPassword:'',
            confirmPassword:'',
            isLoading: false,
            fullPage: true,
            color: '#E73732', 
        }
    },
    components: {
            Loading
        },
    methods: {
       async submitPasswords(){
            if(this.password.length && !this.passwordValidation.errors.length){
                this.isLoading = true;
                await axios.post('/users/updatesettings', {
                    old_password: this.password,
                    newpassword: this.newPassword
                })
                .then((response) => {
                    console.log(response)
                    if(response.data.success){
                        Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Password successfuly changed!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                    this.isLoading = false;
                    this.password = '';
                    this.newPassword = '';
                    this.confirmPassword = '';
                    } else if(response.data.error) {
                        this.isLoading = true;
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.data.error,
                        // title: error.response.data.errors.email,
                        showConfirmButton: false,
                        timer: 1500
                        })
                    this.isLoading = false;
                    }
                })
            
            } else {
            this.isLoading = true;

                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Please fill all required fields!',
                    // title: error.response.data.errors.email,
                    showConfirmButton: false,
                    timer: 1500
                    })
            this.isLoading = false;

            }
        }
    },
    computed: {
		notSamePasswords () {
			if (this.passwordsFilled) {
				return (this.newPassword !== this.confirmPassword)
			} else {
				return false
			}
		},
		passwordsFilled () {
			return (this.newPassword !== '' && this.confirmPassword !== '')
		},
		passwordValidation () {
			let errors = []
			for (let condition of this.rules) {
				if (!condition.regex.test(this.newPassword)) {
                    // errors.push(condition.message)
                    errors = errors  + condition.message + ', ';
				}
			}
			if (errors.length === 0) {
				return { valid:true, errors }
			} else {
				return { valid:false, errors }
            }
            
		}
	}

}
</script>
