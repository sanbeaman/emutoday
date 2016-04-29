var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EventForm from './components/EventForm.vue';

new Vue({
    el: '#vueapp',

    components: {EventForm},

    ready() {
      alert('vue ready');
    }
});
