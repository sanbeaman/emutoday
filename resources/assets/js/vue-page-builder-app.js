var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);
// var VueDragula = require('vue-dragula');
// Vue.use(VueDragula);
var moment = require('moment');

new Vue({
    el: '#vue-page-builder-app',
    components: {
      PageBuilderApp: require('./components/PageBuilderApp.vue')
    },
        http: {
                headers: {
                        // You could also store your token in a global object,
                        // and reference it here. APP.token
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
        },
    ready() {
      console.log('new Vue Page Builder App ready');
    }
});
