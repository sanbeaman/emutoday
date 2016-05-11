<template>
  <div class="large-9 medium-12 small-12 columns">
    <div id="calendarfeed" class="week-2016W192">
    @foreach ($events as $event)
        <h4>{{ $event->present()->eventListDateString }}</h4>
        <div class="event">
          <h6><a href="#" id="{{ $event->id }}">{{$event->title}}</a></h6>
          <p>{{ $event->present()->displayTimeRange }}</p>
          <p>
            <a href="#" class="external">{{$event->location}}</a>
          </p>
          <div class="details" style="display: none;"></div>
        </div>
        @endforeach
  </div>
</div>
</template>
<script>
    export default {
        ready() {
            alert('EventViewContent>>>>>>>>>EventViewContent');
        }
    }
</script>
