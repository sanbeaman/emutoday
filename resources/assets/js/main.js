var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EventView from './components/EventView.vue';
import EventFoam from './components/EventFoam.vue';

new Vue({
    el: '#vueapp',

    components: {
      EventView, EventFoam
    },
    
    ready() {
      alert('vue ready');
    }
});
