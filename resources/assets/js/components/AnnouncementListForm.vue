<template>

	<div class="box box-default box-solid collapsed-box">
	            <div class="box-header with-border" >
								<div class="row">
									<div class="col-md-1">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
										</button>
									</div><!-- /.col-md-1 -->
									<div class="col-md-5">
											<h3 class="box-title" >{{item.title}}</h3>
									</div><!-- /.col-md-6 -->
									<div class="col-md-3">

									</div><!-- /.col-md-3 -->
									<div class="col-md-3">
										<div class="onoffswitch">
				<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
				<label class="onoffswitch-label" for="myonoffswitch">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
				</label>
		</div>
									</div><!-- /.col-md-3 -->
								</div><!-- /.row -->



									<!-- <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span> -->


									<!-- <div class="box-tools pull-right"> -->

									<!-- </div> -->

									<!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->

	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
								<p>{{item.announcement}}</p>
								<p>Posted {{item.start_date | momentPretty}}</p>
	            </div> <!-- /.box-body -->
	          </div><!-- /.box- -->
</template>
<style scoped>
.onoffswitch {
    position: relative; width: 60px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 50px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 18px; padding: 0; line-height: 18px;
    font-size: 11px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "YES";
    padding-left: 10px;
    background-color: #605CA8; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "NO";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 22px; margin: 0px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 38px;
    border: 2px solid #999999; border-radius: 50px;
    transition: all 0.3s ease-in 0s;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
}
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
