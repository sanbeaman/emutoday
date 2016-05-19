<template>
<div class="calendar-sidebar-title row column">
  <h4>Calendar</h4>
  </div>
  <div class="calendar-sidebar-content row">
    <div class="calendar-box">
    <div class="calendar large-12 columns" data-equalizer>
      <div class="row">
        <div class="small-3 columns">
          <a class="text-left" href=""><img src="/assets/imgs/calendar/green-calendar-arrow-before.png" alt="arrow"></a>
        </div>
        <div class="text-center small-6 columns">
          <p>{{monthVar}} {{yearVar}}</p>
        </div>
        <div class="small-3 columns">
          <a class="text-right" href=""><img src="/assets/imgs/calendar/green-calendar-arrow-after.png" alt="arrow"></a>
        </div>
      </div>
      <div class="weekdays row small-up-7 small-collapse">
        <div class="column" data-equalizer-watch><span href="#">Sun</span></div>
        <div class="column" data-equalizer-watch><span href="#">Mon</span></div>
        <div class="column" data-equalizer-watch><span href="#">Tue</span></div>
        <div class="column" data-equalizer-watch><span href="#">Wed</span></div>
        <div class="column" data-equalizer-watch><span href="#">Thu</span></div>
        <div class="column" data-equalizer-watch><span href="#">Fri</span></div>
        <div class="column" data-equalizer-watch><span href="#">Sat</span></div>
      </div>
      <div class="days row small-up-7 small-collapse">
        <div class="column" v-for="item in calDaysArray" data-equalizer-watch>
          <a v-on:click.prevent="fetchEventsByDay( item.day )" v-bind:class="[{'active': item.day == currentDay },{'noevents': item.hasevents == haseventClass }]"  href="#"> {{item.day | removex }}</a>
        </div>
      </div>
    </div>
  </div>
<div class="calendar-categories">
  <h5>Categories</h5>
  <ul class="events">
    <template v-for="category in categories">
      <li v-if="category.events.length == 0 ?false:true">
        <a href="#" aria-describedby="{{category.slug}}-badge">{{category.category}}<span id="{{category.slug}}-badge" class="secondary badge">{{category.events.length}}<span></a>
        </li>
      </template>
    </ul>
  </div>


    </div>
</template>
<style>

.calendar-sidebar-content{
  background: #ffffff;
}
.calendar-sidebar-title h4{
  text-transform: uppercase;
  color: #fff;
  margin-top: 0.5rem;
}
.calendar-text-content p {
    text-align: left;
}

  .events li span.badge {
    margin-left: 10px;
  }

  .calendar ul {
    padding: 15px;
    background: #f3f3f3;
    margin: 0;
  }
  .calendar .weekdays,
  .calendar .days {
    font-size: 12px;
    color: #888;
    text-align: center;
    padding-top: 4px;
    padding-bottom: 4px;
  }
  .calendar ul.days
   {
     border: 1px solid  #000;
    padding: 10px 15px 3px;
    background: #f9f9f9;
  }
  .calendar ul li {
    list-style-type: none;
    display: inline-block;
    width: 12.8%;
    height: 25px;
    font-size: 12px;
    color: #888;
    text-align: center;
    margin-bottom: 4px;

  }
  .calendar ul li span {
    font-size: 10px;
    text-transform: uppercase;
    font-weight: bold;
  }
  .calendar  a {
    color: #888;
    display: block;
    padding: 4px 0;
    border: 1px solid  #fff;
  }
  .calendar a:hover {
    /*border-radius: 5px;*/
    background: #f9f9f9;
    color: #008cba;
  }
  .calendar  a.active {
    /*border-radius: 5px;*/
      background: #ff0000;
    /*padding: 2px 0;*/
  }
.calendar  a.noevents {
       pointer-events: none;
  }

  .calendar-box caption{
    font-weight:400;
    margin-bottom: .3rem;
}
.calendar-caption p{
  font-weight: 400;
  margin-bottom: 0.3rem;
}

.calendar-caption a {
  font-weight: 400;
  margin-bottom: 0.3rem;
  border: 1px none  #000;
}



.calendar-box  {
  margin-top: 0.8rem;
}
</style>
<script>
module.exports  = {
  data: function() {
    return {
      categories: {},
      calevents: {},
      yearVar: '',
      monthVar: '',
      monthVarUnit: '',
      monthArray: [],
      currentDay: '',
      haseventClass: 'no',
      calDaysArray: [],

    }
  },
  filters: {
    removex: function(value) {
      return (value[0] == 'x') ? '_' : value;
    }
  },
  props: {
     elist:{}
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

      this.$http.get('/api/calendar/events/' + this.yearVar + '/'+ this.monthVarUnit + '/' + value).then(function(response) {
        this.yearVar = response.data.yearVar;
        this.monthVar = response.data.monthVar;
        this.monthVarUnit = response.data.monthVarUnit;
      this.elist = response.data.groupedByDay;

        console.log(response.data);
      });
    },
    fetchEventsForCalendar: function() {
      this.$http.get('/api/calendar/month/2015/05').then(function(response) {
        this.yearVar = response.data.yearVar;
        this.monthVar = response.data.monthVar;
        this.monthVarUnit = response.data.monthVarUnit;
        this.monthArray = response.data.monthArray;
        this.currentDay = response.data.dayInMonth;
        this.calDaysArray = response.data.calDaysArray;
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
    this.fetchEventsForCalendar();
   this.fetchCategoryList();
},
components: {

},
events: {

	}
};
</script>
