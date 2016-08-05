<template>

	<div class="box box-default box-solid">
      <div class="box-header with-border" >
				<div class="row">
						<a v-on:click="toggleBody" href="#">
					<div class="col-md-7">
						<h4 class="box-title">{{item.title}}</h4>
					</div><!-- /.col-md-7-->
				</a>
					<div class="col-md-5">
					<form class="form-inline pull-right">
						<!-- <div class="form-group">
							<button v-on:click.prevent="doThis" class="btn btn-sm">BTN</button>
						</div> -->
						<!-- /.form-group -->
				  <div class="form-group">
				    <label class="sr-only" for="priority-number">Priority</label>
						<select id="priority-{{item.id}}" v-model="item.priority" class="form-control" number>
							<option v-for="option in options" v-bind:value="option.value">
								{{option.text}}
							</option>
						</select>
				  </div>
				  <div class="form-group">
						<div class="onoffswitch ">
							<input id="smitch-{{item.id}}" v-on:click="doThis" v-model="item.approved"  type="checkbox" name="onoffswitch" class="onoffswitch-checkbox">

							<label class="onoffswitch-label" for="smitch-{{item.id}}">
									<span class="onoffswitch-inner"></span>
									<span class="onoffswitch-switch"></span>
							</label>
						</div>
				    </div>
					</form>
				</div><!-- /.col-md-6 -->
			</div><!-- /.row -->
	  </div>  <!-- /.box-header -->


        <div v-if="showBody" class="box-body">
						<p>{{item.announcement}}</p>
						<div class="announcement-info">
							Submitted On: {{item.submission_date}}</br>
							By: {{item.author_name}}</br>
							{{item.author_email}} {{item.author_phone}}</br>
							Dates: {{item.start_date}} - {{item.end_date}}

						</div>

      </div><!-- /.box-body -->
			<div class="box-footer list-footer">
				<h6>Submitted On: {{item.submission_date}}, By: {{item.author_name}}, Dates: {{item.start_date}} - {{item.end_date}}</h6>

			</div><!-- /.box-footer -->

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

select.form-control {
	height:22px;
	border: 1px solid #999999;
}


h6 {
	margin-top: 0;
	margin-bottom: 0;
}
.form-group {
	/*border: 1px solid red;*/
}
.form-group label{
	margin-bottom: 0;
}
.box.box-solid.box-default {
	border: 1px solid #999999;
}
</style>
<script>
var moment = require('moment')

module.exports  = {
				props: [
					'item',
					'pid'
				],
			  data: function() {
			    return {
						options: [
							{ text: '0', value: 0 },
		 					{ text: '1', value: 1 },
		 					{ text: '2', value: 2 },
							{ text: '3', value: 3 },
		 					{ text: '4', value: 4 },
		 					{ text: '5', value: 5 },
							{ text: '6', value: 6 },
							{ text: '7', value: 7 },
							{ text: '8', value: 8 },
							{ text: '9', value: 9 },
							{ text: '10', value: 10 },
							{ text: '99', value: 99 }
						],
						showBody: false,
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
					toggleBody: function(ev) {
						if(this.showBody == false) {
							this.showBody = true;
						} else {
							this.showBody = false;
						}
						console.log('toggleBody' + this.showBody)
					},
					doThis: function(ev) {
						this.$emit('item-change',this.item);
						console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
					}

				},
				watch: {
					'isapproved': function(val, oldVal) {
						if (val !=  oldVal) {
							console.log('val change')
						}
					}
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
