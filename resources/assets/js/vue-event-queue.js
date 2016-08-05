var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

var moment = require('moment');


new Vue({
    el: '#vue-event-queue',
    components: {
      EventQueue: require('./components/EventQueue.vue')
    },
        http: {
                headers: {
                        // You could also store your token in a global object,
                        // and reference it here. APP.token
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
        },
    ready() {
      console.log('new Vue Event Queue ready');
    }
});
