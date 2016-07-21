<template>

	<div class="box box-default box-solid collapsed-box">
	            <div type="button" class="box-header with-border" data-widget="collapse">
						<i class="fa fa-plus pull-left"></i>
								<h3 class="box-title" >{{item.title}}</h3>
								<div class="box-tools pull-right">
									<!-- <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span> -->
									<!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
									</button> -->
									<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
										<i class="fa fa-comments"></i>
									</button>
									<!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
								</div>
	              <!-- /.box-tools -->
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
								<p>{{item.announcement}}</p>
								<p>Posted {{item.start_date | momentPretty}}</p>
	            </div> <!-- /.box-body -->
	          </div><!-- /.box- -->
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
