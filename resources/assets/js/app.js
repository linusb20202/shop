
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

window.Vue = require('vue');

/** Sweet alert Toaster */
import Swal from 'sweetalert2';
window.Swal = Swal;

window.Try = new Vue();

import VueObserveVisibility from 'vue-observe-visibility'
Vue.use(VueObserveVisibility)


import moment from 'moment';

Vue.filter('myDate', function(created){
  var d = new Date(created);
  return moment(d).format('MMM D, h:mm a');

})
Vue.filter('myDate2', function(created){
  var d = new Date(created);
  return moment(d).startOf('hour').fromNow();
})
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast;
/** Sweet alert Toaster End */
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('account-settings', require('./components/AccountSettings.vue'));
Vue.component('change-password', require('./components/ChangePassword.vue'));
Vue.component('paypal', require('./components/Paypal.vue'));
Vue.component('payoneer', require('./components/Payoneer.vue'));
Vue.component('bank', require('./components/Bank.vue'));
Vue.component('contacts', require('./components/messages/Contacts.vue'));
Vue.component('composer', require('./components/messages/Composer.vue'));
Vue.component('messages', require('./components/messages/Messages.vue'));
Vue.component('about', require('./components/messages/About.vue'));
Vue.component('chat-app', require('./components/messages/ChatLayout.vue'));
Vue.component('indicator', require('./components/messages/Indicator.vue'));


const app = new Vue({
    el: '#app'
});
const app2 = new Vue({
  el: '#app2',
  data(){
    return{
      unreadCount: 0
    }
  },
  methods:{
    async getUnreadCount(){
    await axios.get('/message/getUnreadCount')
    .then((response) => {
        // console.log(response)
        this.unreadCount = response.data;
    })
    },
    playSound(){
        var sound = new Audio('../public/audio/alert2.mp3')
        // var sound = new Audio('../audio/alert2.mp3')
        sound.play()
    },
},
  created(){
        this.getUnreadCount();
    
    Try.$on('selected', () => {
      this.unreadCount = 0;
  })
  },
  
});
