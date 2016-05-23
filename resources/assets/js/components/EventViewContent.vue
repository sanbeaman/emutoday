<template>
  <div class="calendar-bar row">
    <div class="small-6 columns">
      <h4>Upcoming Events</h4>
    </div>
    <div class="small-6 columns" columns>


    </div>
  </div>
  <div class="calendar-content">
    <div class="calendar-content-title row">
      <div class="small-12 column">
          <h6>From {{firstDate}} thru {{lastDate}}</h6>
      </div>
    </div>
    <div class="calendar-content-content row">
      <div class="small-12 columns">
        <div v-for="eitem in elist">
          <div class="event-day">
              <h4>{{monthVar}} {{$key }}, {{yearVar}}</h4>
              <event-view-single
                v-for="item in eitem"
                  :item="item"
                  :index="$index">
                </event-view-single>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.calendar-bar {
    background: #bebdbd;
}
.calendar-bar h4 {
  text-transform: uppercase;
  color: #fff;
  font-size: 1.2rem;
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}

.calendar-content-title {
  padding-top: 0.8rem;
}

.calendar-content-title h4{
  text-transform: uppercase;
  color: #fff;
    margin-top: 0.5rem;
}
.calendar-content-content{
  background: #fff;
}
.calendar-content-content h4 {
  line-height: 1.4rem;
  font-size: 1.3rem;
  font-weight: 600;
}

.event-day {
    margin: 0.8rem 0 0 0;
}


</style>
<script>
module.exports  = {
  data: function() {
    return {
      monthVar: '',
      yearVar: '',
      dayVar: '',
      firstDate: '',
      lastDate: '',
      monthVarUnit: '',
      eventRange: {},
      hasevents: 0,
    }
  },
  filters: {
    yesNo: function(value) {
      return (value == 1) ? 'Yes' : 'No';
    }
  },
  props: {
    elist: {},
    eventlist: [],

  },
  computed: {
    currentDate: function () {
      return this.monthVar+ ' ' + this.dayVar + ', ' + this.yearVar;
    },
    dateRange: function () {
        return 'From '+ this.firstDate + ' thru ' + this.lastDate;
    }
  },
  methods: {
    sortKeyInt: function ($key) {
     return parseInt($key);
   },
    // fetchEvents: function() {
    //   this.$http.get('/api/events', function(data) {
    //     this.monthArray = response.data.monthArray;
    //     this.currentDay = response.data.dayInMonth;
    //   });
    // },
    updateCalEvent: function(edata){
      this.monthVar = edata.monthVar;
      this.yearVar = edata.yearVar;
      this.dayVar = edata.dayVar;
      this.elist = edata.groupedByDay;
      this.firstDate = edata.firstDate;
      this.lastDate = edata.lastDate;
      console.log('fd='+this.firstDate );
      this.hasevents = this.elist ? 1: 0;
    },
    fetchEventsByDay: function(value) {
      alert(value);
    },
    // fetchEvents: function() {
    //   this.$http.get('/api/calendar/events/2015/09/10').then(function(response) {
    //     this.yearVar = response.data.yearVar;
    //     this.monthVar = response.data.monthVar;
    //     this.monthVarUnit = response.data.monthVarUnit;
    //     this.dayVar = response.data.dayVar;
    //     this.elist = response.data.groupedByDay;
    //     console.log(response.data);
    //   });
    // }
  },
watch: {

},
created: function() {
//  this.fetchEvents();
},
components: {
  eventViewSingle: require('./EventViewSingle.vue'),
},
events: {
           'responseCalEvent': 'updateCalEvent'
       }
};
</script>
