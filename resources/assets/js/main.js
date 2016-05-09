var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

var vueForm = require('vue-form');
Vue.use(vueForm);
//
// var autocomplete = require('./components/vue-autocomplete.vue')
//
//
// Vue.component('autocomplete', autocomplete)

new Vue({
    el: '#vueapp',
    components: {
      eventform: require('./components/EventForm.vue')

    },
    ready() {
      alert('vue ready');
    }
});
