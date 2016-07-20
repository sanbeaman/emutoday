<template>

	<div class="panel panel-default">
	  <div class="panel-body">
			<h3 class="panel-title">{{item.title}}</h3>
		<p>{{item.announcement}}</p>
	  	<p>Posted {{item.start_date | momentPretty}}</p>
	  </div>
	</div>

</template>
<style scoped>

</style>

<script>
var moment = require('moment')

module.exports  = {
				props: [
					'item'
				],
			  data: function() {
			    return {
						currentDate: {},
						record: {
							user_id : '',
							title: '',
							announcement: '',
							start_date: ''
						}
			    }
			  },
				created: function () {
					// this.currentDate = moment();
					// console.log('this.currentDate=' + this.currentDate)
				},
				ready: function() {
					//ready function
				},
			  computed: {

			  },
			  methods: {

				},
				watch: {

				},
				directives: {
						// mydatedropper: require('../directives/mydatedropper.js')
						// dtpicker: require('../directives/dtpicker.js')
				},
				components: {
						// listselect2: require('./ListSelect2.vue')
						// autocomplete: require('./vue-autocomplete.vue'),
				    // 'datepicker': require('../vendor/datepicker.vue'),

				},
				filters: {
						momentPretty: {
							read: function(val) {
									console.log('read-val'+ val )

								return 	val ?  moment(val).format('MM-DD-YYYY') : '';
							},
							write: function(val, oldVal) {
								console.log('write-val'+ val + '--'+ oldVal)

								return moment(val).format('YYYY-MM-DD');
							}
						}
					},
					events: {

					// 'building-change':function(name) {
					// 	this.newbuilding = '';
					// 	this.newbuilding = name;
					// 	console.log(this.newbuilding);
					// },
					// 'categories-change':function(list) {
					// 	this.categories = '';
					// 	this.categories = list;
					// 	console.log(this.categories);
					// }
				}
			};


</script>
