var Vue = require('vue');
var VueCharts = require('vue-charts')
Vue.use(VueCharts);

new Vue({
    el: '#vue-chart-app',
    components: {
      PageChartApp: require('./components/PageChartApp.vue')
  },
    ready() {
      alert('vue ready');
    }
});