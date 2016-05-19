<template>
  <div class="calendar-content-title row">
    <div class="small-3 columns">
      <h4>Events</h4>
    </div>
    <div class="small-9" columns>
      <h4>{{dateRange}}</h4>
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



          <!-- <div class="event">
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
            </div> -->



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
    fetchEventsByDay: function(value) {
      alert(value);
    },
    fetchEvents: function() {
      this.$http.get('/api/calendar/events/2015/09/10').then(function(response) {
        this.yearVar = response.data.yearVar;
        this.monthVar = response.data.monthVar;
        this.monthArray = response.data.monthArray;
        this.currentDay = response.data.dayInMonth;
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

	}
};
</script>
