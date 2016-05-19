<template>
  <div id="calendar-content-bar">
    <div class="row">
      <div class="medium-3 show-for-medium columns">
          <event-view-side-bar :elist.sync="eventlist"></event-view-side-bar>
      </div>
    <div class="medium-9 small-12 columns">
        <event-view-content :elist.sync="eventlist"></event-view-content>
    </div>
    </div>
  </div>
</template>




<script>
    import EventViewSideBar from './EventViewSideBar.vue'
    import EventViewContent from './EventViewContent.vue'
    export default {
        components: { EventViewSideBar, EventViewContent},
        ready() {
            // alert('!!!!!!!!!!!!!!!!!! EventView');
        },
        data: function() {
          return {
            eventlist: []
          }
        },
    }
</script>
