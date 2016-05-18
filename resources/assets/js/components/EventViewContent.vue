<template>
  <div class="small-12 medium-8 columns">
    <div id="calendarfeed" class="week-2016W192">
      <div v-for="eitem in elist">
        <div class="event">
        <h4> {{eitem.start_date}}</h4>
          <div class="event">
            <h6><a href="#" id="eitem.id">{{eitem.title}}</a></h6>
            <p>From {{eitem.start_time}} to {{eitem.end_date}}</p>
            <p>
              <a href="#" class="external">{{eitem.location}}</a>
            </p>
            <div class="details">
              {{eitem.description}}
              <p>Contact:</p>
              <ul>
                <li>{{eitem.contact_person}}</li>
                <li>Phone: {{eitem.contact_phone}}</li>
                <li>Email: <a href="mailto:{{eitem.contact_email}}">{{eitem.contact_email}}</a></li>
              </ul>
              <p>Additional Information:</p>
              <ul>
                <li v-if="eitem.related_link_1"><a href="eitem.related_link_1" class="external">{{eitem.related_link_1}}</a></li></ul>
                <li v-if="eitem.related_link_2"><a href="eitem.related_link_2" class="external">{{eitem.related_link_2}}</a></li></ul>
                <p>Cost: {{eitem.cost}}</p>
                <p>{{eitem.participants}}</p>
                <p>LBC Approved: {{eitem.lbc_approved | yesNo }}</p>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
</template>
<style>

#calendarfeed {
    background-color: #fff;
    padding: 0.8rem 1rem 1rem 1.5rem;
    margin: 0;
}
#calendarfeed p, #calendarfeed h6{
    padding: 0;
    margin: 0;
    line-height: 1.4rem;
}
.event{
    margin:.8rem 0;
}
#calendarfeed h4{
    padding: .8rem 0 0 0;
    margin: .8rem 0 0  0;
    line-height: 1.4rem;
    font-size: 1.3rem;
    border-top: 1px solid #ccc;
    font-weight: 600;
}
#calendarfeed h4:first-child{
    border-top: none;
    margin-top: 0;
}
.details{
    display: block;
    margin: .8rem 1.2rem;
}
.details ul{
    padding: 0;
    margin: .4rem 0 .4rem 2rem;;
    }
.calendar-box caption{
    font-weight:400;
    margin-bottom: .3rem;
}

#calendar-bar h3.toptitle{
    margin-bottom: 0;
}
#before-after{
    padding-top: .4rem;
    font-size: 1rem;
    position: relative;
}
.week-arrow img {
    padding: 0;
    margin: -.2rem .2rem 0 .2rem;
    float: none;
}
#calendar-nav table {
    background-color: transparent;
    border: none;
    width: 100%;
    box-sizing: border-box;
    float: left;
}
#calendar-nav table caption{
    padding: 0 1rem;
}
#calendar-nav table thead{
    background-color: transparent;
}
#calendar-nav table tr.even, #calendar-nav table tr.alt, #calendar-nav table tr:nth-of-type(2n){
    background-color: transparent;
}
#calendar-nav table tr th, #calendar-nav table tr td{
    padding-top: .2rem;
    padding-bottom: .2rem;
    padding-left: 0;
    padding-right: 0;
    text-align: center;
}
.calendar-box, .calendar-categories {
    padding-left: .8rem;
    padding-right: .8rem;
}
</style>
<script>
module.exports  = {
  data: function() {
    return {
      eventRange: {}
    }
  },
  filters: {
    yesNo: function(value) {
      return (value == 1) ? 'Yes' : 'No';
    }
  },
  props: {
    elist: {},
    eventlist: []
  },
  computed: {

  },
  methods: {
    fetchEvents: function() {
      this.$http.get('/api/events', function(data) {
        this.monthArray = response.data.monthArray;
        this.currentDay = response.data.dayInMonth;
      });
    },
    fetchEventsByDay: function(value) {
      alert(value);
    },
    fetchEventsForCalendar: function() {
      this.$http.get('/api/calendar/events/2015/05').then(function(response) {
        this.yearVar = response.data.yearVar;
        this.monthVar = response.data.monthVar;
        this.monthArray = response.data.monthArray;
        this.currentDay = response.data.dayInMonth;
        console.log(response.data);
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

},
components: {

},
events: {

	}
};
</script>
