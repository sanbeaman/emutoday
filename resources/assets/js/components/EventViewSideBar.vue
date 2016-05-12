<template>
  <div id="calendar-nav" class="large-3  hide-for-small columns">
    <div class="calendar-box">
      <div class="row">
          <div class="large-12 columns">
            <div class="calendar">
              <div class="month">
                <a href="#" class="back"></a>
                <a href="#" class="next"></a>
                <h5>May</h5>
                <p>2016</p>
              </div>
              <ul class="weekdays">
                <li><span href="#">Sun</span></li>
                <li><span href="#">Mon</span></li>
                <li><span href="#">Tue</span></li>
                <li><span href="#">Wed</span></li>
                <li><span href="#">Thu</span></li>
                <li><span href="#">Fri</span></li>
                <li><span href="#">Sat</span></li>
              </ul>
              <ul>
                <li v-for="day in daysInMonth">
                  {{ day}}
                </li>
              </ul>
            </div>
          </div>
        </div>
      <div id="month" class="month-2016-05">

      </div>
    </div>
    <div class="calendar-categories">
      <h5>Categories</h5><ul class="events">
        <template v-for="category in categories">

          <li v-if="category.events.length == 0 ?false:true">
            <a href="#" aria-describedby="{{category.slug}}-badge">{{category.category}}<span id="{{category.slug}}-badge" class="secondary badge">{{category.events.length}}<span></a>
          </li>
        </template>
      </ul>
</div>
<div class="calendar-categories">
<h5>Other Calendars</h5>
<ul>
  <li><a href="http://art.emich.edu/events/upcoming">Art Galleries</a></li>
  <li><a href="http://www.emueagles.com/calendar.aspx">Athletics</a></li>
  <li><a href="http://www.emich.edu/hr/calendar/">Holiday &amp; Payroll</a></li>
  <li><a href="http://www.emich.edu/emutheatre/">Theatre</a></li>
</ul>
</div>
<div class="submit-calendar">
<a href="manage/" class="button emu-button">Submit an Event</a>
</div>
<div class="ypsi-graphic">
<a href="http://visitypsinow.com/local-events/"><img src="/themes/default/assets/imgs/emu-today/calendar/visit-ypsi.png" alt="Visit Ypsi Calendar"></a>

</div>
</div>
</template>
<style>
  .events li span.badge {
    margin-left: 10px;
  }
</style>
<script>
module.exports  = {
  data: function() {
    return {
      categories: {},
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
        this.events = data;
      });
    },
    fetchCategoryList: function() {
      this.$http.get('/api/active-categories').then(function(response){
        // console.log('response->categories=' + JSON.stringify(response.data));
        this.categories = response.data;

      }, function(response) {
      //  this.$set(this.formErrors, response.data);
          console.log(response);
      });
    },

    submitForm: function() {
    //  console.log('this.eventform=' + this.eventform.$valid);
      this.newevent.start_date = this.sdate;
      this.newevent.end_date = this.edate;
      this.newevent.reg_deadline = this.rdate;
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
   this.fetchCategoryList();
},
components: {


},
events: {

	}
};
</script>
