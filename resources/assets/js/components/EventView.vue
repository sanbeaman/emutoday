<template>
  <event-view-top-bar></event-view-top-bar>
  <div id="calendar-content-bar">
    <div class="row">
      <event-view-side-bar></event-view-side-bar>
      <!-- <event-view-content></event-view-content> -->
    </div>
  </div>
</template>




<script>
    import EventViewTopBar from './EventViewTopBar.vue'
    import EventViewSideBar from './EventViewSideBar.vue'
    // import EventViewContent from './EventViewContent.vue'
    export default {
        components: { EventViewTopBar, EventViewSideBar},
        ready() {
            alert('!!!!!!!!!!!!!!!!!! EventView');
        }
    }
</script>
