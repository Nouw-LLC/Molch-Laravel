/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import bsCustomFileInput from 'bs-custom-file-input';
import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('feed-messages', require('./components/FeedMessage.vue').default);
Vue.component('feed-form', require('./components/FeedForm.vue').default);
Vue.component('username-form', require('./components/settings/UsernameComponent.vue').default);
Vue.component('email-form', require('./components/settings/EmailComponent.vue').default);
Vue.component('password-form', require('./components/settings/PasswordComponent.vue').default);
Vue.component('status-form', require('./components/settings/StatusComponent.vue').default);
Vue.component('bio-form', require('./components/settings/BioComponent.vue').default);

const app = new Vue({

    el: '#app',

    data: {
        messages: [],
        showModal: false
    },

    created() {
        this.fetchMessages();
        Echo.channel('feed')
            .listen('FeedMessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user,
                });
            });
    },



    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },


        addMessage(message) {
            this.messages.push(message);
            this.showModal = false;
            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    },
});

$(document).ready(function () {
    bsCustomFileInput.init()
})
