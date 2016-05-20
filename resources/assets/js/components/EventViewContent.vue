<template>
  <div class="calendar-content-title row">
    <div class="small-3 columns">
      <h4>Events</h4>
    </div>
    <div class="small-9" columns>
      <h4>{{currentDate}}</h4>
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
</template>
<style>
.calendar-content-content{
  background: #fff;
}
.calendar-content-title h4{
  text-transform: uppercase;
  color: #fff;
    margin-top: 0.5rem;
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
      monthVarUnit: '',
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
    eventlist: [],
    dateRange: {},

  },
  computed: {
    currentDate: function () {
      return this.monthVar+ ' ' + this.dayVar + ', ' + this.yearVar;
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
    },
    fetchEventsByDay: function(value) {
      alert(value);
    },
    fetchEvents: function() {
      this.$http.get('/api/calendar/events/2015/09/10').then(function(response) {
        // this.dateRange = response.data.monthVar+ ' ' + response.data.dayVar + ', ' + response.data.yearVar;

        this.yearVar = response.data.yearVar;
        this.monthVar = response.data.monthVar;
        this.monthVarUnit = response.data.monthVarUnit;
        this.dayVar = response.data.dayVar;
        this.elist = response.data.groupedByDay;
        console.log(response.data);
      });
    }
  },
watch: {

},
created: function() {
  this.fetchEvents();
},
components: {
  eventViewSingle: require('./EventViewSingle.vue'),
},
events: {
           'responseCalEvent': 'updateCalEvent'
       }
};
</script>
