<template>
  <div id="graybar">
    <div class="row">
      <div class="large-3 hide-for-small noleftpadding columns">
        <h4>Calendars</h4>
      </div>
      <div class="large-9 medium-12 small-12 columns">
        <div class="row">
          <div class="large-3 medium-3 small-3 columns">
            <h4>Events</h4>
          </div>
          <div id="before-after" class="large-9 medium-9 small-9 columns">
            <a id="week-2016W182" class="week-arrow leftnav" href="/emu-today/calendar/?show=2016W182">  <i class="fi-arrow-left calstyle1"></i></a> Week of May 10 | <a href="/emu-today/calendar/" id="today-2016W192.2016-05" class="today">Today</a> <a id="week-2016W202" class="week-arrow rightnav" href="/emu-today/calendar/?show=2016W202">
              <i class="fi-arrow-right calstyle1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        ready() {
            alert('EventView>>>>>>>>>EventViewBar');
        }
    }
</script>
