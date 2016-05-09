<template>
  <form @submit.prevent="submitForm" class="large-8">
    <div class="row column">
      <label>Title *
        <input v-model="newevent.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title" type="text">
        <p v-if="formErrors.title" class="help-text invalid">Need a Title!</p>
      </label>
      <label>Short Title
        <input v-model="newevent.short_title" type="text" placeholder="Short Title" name="short-title" >
      </label>
      <label>Location
        <autocomplete
          id="location"
          class="location"
          name="locationlist"
          placeholder="Type Here"
          url="/api/buildings"
          param="q"
          anchor="name"
          label="alias"
          model="vModelLike">
        </autocomplete>
        <p v-if="formErrors.location" class="help-text invalid">Need a Location!</p>

      </label>
    </div>
  <div class="row">
    <div class="small-4 column">
      <label for="start-date" class="middle">Start Date:</label>
      <datepicker id="start-date" :readonly="true" format="YYYY-MM-DD" name="start-date" :value.sync="sdate" aria-describedby="errorStartDate"></datepicker>
      <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
    </div>
    <div class="small-4 column">
      <label for="start-time" class="middle">Start Time:</label>
      <input id="start-time" type="time" v-model="newevent.start_time" />
    </div>
    <div class="small-4 column">
      <legend for="all-day">All Day?</legend>
      <div class="small-4 columns">
          <label for="allDayYes">Yes</label>
      </div>
      <div class="small-2 columns">
          <input type="radio" name="all-day" id="allDayYes" value="1" v-model="newevent.all_day" />
      </div>
      <div class="small-4 columns">
        <label for="allDayNo">No</label>
    </div>
    <div class="small-2 columns">
      <input type="radio" name="all-day" id="allDayNo" value="0" v-model="newevent.all_day" />
    </div>
    </div>
  </div>
  <div class="row">
    <div class="small-2 column">
      <label for="end-date" class="middle">End Date:</label>
    </div>
    <div class="small-4 columns">
      <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate" ></datepicker>
    </div>
    <div class="small-2 column">
      <label for="end-time" class="middle">End Time:</label>
    </div>
    <div class="medium-4 columns">
      <input id="end-time" type="time" v-model="newevent.end_time"/>
    </div>
  </div>
  <div class="row">
    <button class="button" type="submit">Publish</button>
  </div>
</form>



         <!-- <form method="POST" @submit.prevent="submitForm">
           {!! csrf_field() !!}

           <div class="form-group">
               <input class="form-control title" type="text" name="title" placeholder="Title" v-model="formInputs.title">
               <span v-if="formErrors['title']" class="error">@{{ formErrors['title'] }}</span>
           </div>

           <div class="form-group">
               <input class="form-control short_name" name="short_name" placeholder="Short Name" v-model="formInputs.short_name">
               <span v-if="formErrors['short_name']" class="error">@{{ formErrors['short_name'] }}</span>
           </div>

           <button class="button" type="submit">Publish</button>


         </form> -->

</template>
<style>
label {
           display: block;
           margin-bottom: 1.5em;
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
  border-color: #ec5840;
}
.invalid {
  color: #ff0000;
}


</style>

<script>

module.exports  = {
  data: function() {
    return {
      sdate: '',
      edate: '',
      stime: '',
      buildings: [],
      data:{},
      eventform: {},
      newevent: {},
      response: {},
      formStatus: {},
      vModelLike: "",
      formInputs : {},
      formErrors : {}
    }
  },
  props: {
    //add props
  },
  computed: {

  },
  methods: {
    fetchEvents: function() {
      this.$http.get('/api/events', function(data) {
        this.buildings = data;
      });
    },
    fetchBuildingList: function() {
      this.$http.get('api/buildings', function(data) {
        this.buildings = data;
      });
    },
    updateEvent: function() {
      var resource = this.$resource('api/events/:id');
      resource.update({id : 1}, { name: 'tester' }, function(events) {
        this.newevent = events;
      }.bind(this));
    },
    submitForm: function() {
    //  console.log('this.eventform=' + this.eventform.$valid);
      this.newevent.start_date = this.sdate;
      this.$http.post('/api/events', this.newevent).then(function(response){
          //get status

          response.status;
          console.log('response.status=' + response.status);
          console.log('response.ok=' + response.ok);
            console.log('response.statusText=' + response.statusText);
            console.log('response.request=' + JSON.stringify(response.request));

          //get all headers
          response.headers();
          //get 'expirese' header
          response.headers('expires');

          //set data on vm
          if (response.data.errors){
              this.formErrors = response.data.errors;
          } else {
            this.formErrors = {};
          }

          console.log('json-'+JSON.stringify(response.data));
      }, function(response) {
      //  this.$set(this.formErrors, response.data);
          console.log(response);
      });
    }
  },
watch: {

},
created: function() {
  // this.fetchEvents();
},
components: {
		autocomplete: require('./vue-autocomplete.vue'),
    'datepicker': require('../vendor/datepicker.vue')
},
events: {

		/**
		*	Global Autocomplete Callback Event
		*
		*	@event-name autocomplete:{event-name}
		*	@param {String} name name of auto
		*	@param {Object} data
		*	@param {Object} json - ajax-loaded only
		*/

		// Autocomplete on before ajax progress
		'autocomplete:before-ajax': function (name,data){
			console.log('before-ajax',name,data);
		},

		// Autocomplete on ajax progress
		'autocomplete:ajax-progress': function(name,data){
			console.log('ajax-progress',data);
		},

		// Autocomplete on ajax loaded
		'autocomplete:ajax-loaded': function(name,data,json){
			console.log('ajax-loaded',data,json);
		},

		// Autocomplete on focus
		'autocomplete:focus': function(name,evt){
			console.log('focus',name,evt);
		},

		// Autocomplete on input
		'autocomplete:input': function(name,data){
			console.log('input',data);
		},

		// Autocomplete on blur
		'autocomplete:blur': function(name,evt){
			console.log('blur',evt);
		},

		// Autocomplete on show
		'autocomplete:show': function(name){
			console.log('show',name);
		},

		// Autocomplete on selected
		'autocomplete:selected': function(name,data){
			console.log('selected',data);
      this.newevent.location = data.name;
		//	this.data = data;
      console.log('data.name',data.name);
		},

		// Autocomplete on hide
		'autocomplete:hide': function(name){
			console.log('hide',name);
		},


		/**
		*	Spesific Autocomplete Callback Event By Name
		*
		*	@event-name autocomplete-{component-name}:{event-name}
		*	@param {String} name name of auto
		*	@param {Object} data
		*	@param {Object} json - ajax-loaded only
		*/

		// Autocomplete on before ajax progress
		'autocomplete-locationlist:before-ajax': function(data){
			console.log('before-ajax-locationlist',data);
		},

		// Autocomplete on ajax progress
		'autocomplete-locationlist:ajax-progress': function(data){
			console.log('ajax-progress-locationlist',data);
		},

		// Autocomplete on ajax loaded
		'autocomplete-locationlist:ajax-loaded': function(data,json){
			console.log('ajax-loaded-locationlist',data,json);
		},

		// Autocomplete-locationlist on focus
		'autocomplete-locationlist:focus': function(evt){
			console.log('focus-locationlist',evt);
		},

		// Autocomplete-locationlist on input
		'autocomplete-locationlist:input': function(data){
			console.log('input-locationlist',data);
		},

		// Autocomplete-locationlist on blur
		'autocomplete-locationlist:blur': function(evt){
			console.log('blur-locationlist',evt);
		},

		// Autocomplete-locationlist on show
		'autocomplete-locationlist:show': function(){
			console.log('show-locationlist');
		},

		// Autocomplete-locationlist on selected
		'autocomplete-locationlist:selected': function(data){
			console.log('selected-locationlist',data);
		},

		// Autocomplete-locationlist on hide
		'autocomplete-locationlist:hide': function(){
			console.log('hide-locationlist');
		},

	}
};


</script>
