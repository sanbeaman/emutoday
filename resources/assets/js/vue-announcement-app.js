var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

var moment = require('moment');
// import Validator from 'easiest-js-validator';
// Vue.http.headers.common['X_CSRF-TOKEN'] = document.querySelector('input[name="_token"]').value;
// var vueForm = require('vue-form');
// Vue.use(vueForm);
//
// var autocomplete = require('./components/vue-autocomplete.vue')
//
//
// Vue.component('autocomplete', autocomplete)
// Vue.directive('emit-change', function () {
//     var el = this.el
//     Vue.nextTick(function () {
//       $(el).trigger('change')
//    })
// })

new Vue({
    el: '#vue-announcement-app',
    components: {
      AnnouncementApp: require('./components/AnnouncementApp.vue')
    },
		http: {
				headers: {
						// You could also store your token in a global object,
						// and reference it here. APP.token
						'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
				}
		},
    ready() {
      console.log('new Vue AnnouncementApp ready');
    }
});
