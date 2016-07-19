<template>

				<form>
					<slot name="csrf"></slot>
					<!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
					<div class="row">
						<div class="small-12 columns">
							<div v-show="formMessage.isOk"  class="callout success">
  							<h5>{{formMessage.msg}}</h5>
									</div>
							<div class="form-group">
									<label>Title <i class="fi-star reqstar"></i></label>
										<p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
										<input v-model="record.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
										<p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
				    		</div>
								<div class="form-group">
									<label>Announcement <i class="fi-star reqstar"></i> <p class="help-text" id="announcement-helptext">({{descriptionChars}} characters left)</p>

									<textarea v-model="record.announcement" v-bind:class="[formErrors.announcement ? 'invalid-input' : '']" name="announcement" type="textarea" rows="6"></textarea>
								</label>
								<p v-if="formErrors.announcement" class="help-text invalid">Need a Description!</p>

								</div>
						</div><!-- /.small-12 columns -->
					</div><!-- /.row -->
					<div class="row">
						<div class="small-6 columns">
								<div class="form-group">
									<label for="start-date">Start Date: <i class="fi-star reqstar"></i></label>
									<input id="start-date" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" v-model="record.start_date" aria-describedby="errorStartDate" v-mydatedropper />
									<p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
								</div><!--form-group -->
						</div><!-- /.small-6 columns -->
						<div class="small-6 columns">
								<div class="form-group">
										<label for="end-date">End Date: <i class="fi-star reqstar"></i></label>
										<input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="record.end_date"  aria-describedby="errorEndDate" v-mydatedropper />
										<!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
										<p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>

									</div><!--form-group -->
						</div><!-- /.small-6 columns -->
					</div><!-- /.row -->
					<div class="row">
						<div class="medium-12 column">
							<div class="form-group">
								<button v-on:click="submitForm" type="submit" class="button button-primary">Submit For Approval</button>
							</div>
					</form>
						</div><!-- /.medium-12 column -->
					</div>


</template>
<style scoped>
 p {
	 margin:0;
 }
      label {
           display: block;
           /*margin-bottom: 1.5em;*/
       }

       label > span {
           display: inline-block;
           width: 8em;
           vertical-align: top;
       }
.valid-titleField {
  background-color: #fefefe;
  border-color: #cacaca;
}
.no-input {
  background-color: #fefefe;
  border-color: #cacaca;
}
.invalid-input {
  background-color: rgba(236, 88, 64, 0.1);
  border: 1px dotted red;
}
.invalid {
  color: #ff0000;
}


fieldset label.radiobtns  {
  display: inline;
  margin: 4px;
  padding: 2px;
}

[type='text'], [type='password'], [type='date'], [type='datetime'], [type='datetime-local'], [type='month'], [type='week'], [type='email'], [type='number'], [type='search'], [type='tel'], [type='time'], [type='url'], [type='color'],
textarea {
	margin: 0;
	padding: 0;
	padding-left: 8px;
}
[type='file'], [type='checkbox'], [type='radio'] {
	margin: 0;
	margin-left: 8px;
	padding: 0;
	padding-left: 2px;
}
.reqstar {
    font-size: .5rem;
    color: #E33100;
		vertical-align:text-top;
}

button.button-primary{
	margin-top: 1rem;
}

</style>

<script>
module.exports  = {
				props:{
					authorid: {default : '0'},
					recordexists: {default: false},
					editid: {default: ''},
				},
			  data: function() {
			    return {
						record: {
							title: '',
							announcement: '',
							start_date: '',
							end_date: ''
						},
						totalChars: {
							start: 0,
							title: 100,
							announcement: 255
						},
			      response: {

						},
						formMessage: {
							isOk: false,
							msg: ''
						},
			      formInputs : {},
			      formErrors : {}
			    }
			  },
				ready: function() {

						if(this.recordexists){
							console.log('editeventid'+ this.editid)
							this.fetchCurrentEvent(this.editid)

						}

				},


			  computed: {
					titleChars: function() {
						var str = this.record.title;


						console.log(str.length);
						var cclength = str.length;
						return this.totalChars.title - cclength;
						// this.totalChars.title - (this.newevent.title).length
					},
					descriptionChars: function() {
						var str = this.record.announcement;
						console.log(str.length);
						var cclength = str.length;
						return this.totalChars.announcement - cclength;
						// this.totalChars.title - (this.newevent.title).length
					}

			  },
			  methods: {
					fetchCurrentEvent: function() {
						this.$http.get('/api/announcement/'+ this.editid +'/edit')

							.then((response) =>{
									//response.status;
									console.log('response.status=' + response.status);
									console.log('response.ok=' + response.ok);
									console.log('response.statusText=' + response.statusText);
									// console.log('response.data=' + response.data.json());
									this.record = response.data;

									this.checkOverData();
								}, (response) => {
									//error callback
									console.log("ERRORS");

									// this.formErrors =  response.data.error.message;

								}).bind(this);
					},
					checkOverData: function() {
						console.log('this.record'+ this.record.length)
					},
					submitForm: function(e) {
				    //  console.log('this.eventform=' + this.eventform.$valid);
						e.preventDefault();
			      // this.newevent.start_date = this.sdate;
			      // this.newevent.end_date = this.edate;
			      // this.newevent.reg_deadline = this.rdate;
			      this.record.author_id = this.authorid;

			      this.$http.post('/api/announcement', this.record)

							.then((response) =>{
									//response.status;
									console.log('response.status=' + response.status);
									console.log('response.ok=' + response.ok);
									console.log('response.statusText=' + response.statusText);
								 console.log('response.data=' + response.data.message);

								 this.formMessage.msg = response.data.message;
								  this.formMessage.isOk = response.ok;
								}, (response) => {
									//error callback
									this.formErrors =  response.data.error.message;
								}).bind(this);
					}
					},
					watch: {

					},
					directives: {
						mydatedropper: require('../directives/mydatedropper.js')
					},
					components: {
						// listselect2: require('./ListSelect2.vue')
						// autocomplete: require('./vue-autocomplete.vue'),
				    // 'datepicker': require('../vendor/datepicker.vue'),

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
