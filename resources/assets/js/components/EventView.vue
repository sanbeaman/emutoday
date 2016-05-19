<template>
  <div id="calendar-content-bar">
    <div class="row">
      <event-view-side-bar :elist.sync="eventlist"></event-view-side-bar>

      <event-view-content :elist.sync="eventlist"></event-view-content>
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
