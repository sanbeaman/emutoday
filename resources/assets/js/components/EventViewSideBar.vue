<template>
  <div id="calendar-nav" class="large-3  hide-for-small columns">
    <div class="calendar-box">
      <div class="row">
          <div class="large-12 columns">
            <div class="calendar">
              <div class="month">
                <a href="#" class="back"></a>
                <a href="#" class="next"></a>
                <h5>{{$cd->format('M')}}</h5>
                <p>{{$cd->format('Y')}}</p>
               JSvars
              </div>
              <ul class="weekdays">
                <li><span href="#">Sun</span></li>
                <li><span href="#">Mon</span></li>
                <li><span href="#">Tue</span></li>
                <li><span href="#">Wed</span></li>
                <li><span href="#">Thu</span></li>
                <li><span href="#">Fri</span></li>
                <li><span href="#">Sat</span></li>
              </ul>
              <ul>
                @for ($i = 0; $i < count($monthArray) ; $i++)

                  @if($monthArray[$i] == $dayInMonth)
                    <li><a href="#" class="active">{{$monthArray[$i]}}</a></li>
                  @else
                <li><a href="#" class="">{{$monthArray[$i]}}</a></li>
              @endif
                @endfor
              </ul>
            </div>
          </div>
        </div>
      <div id="month" class="month-2016-05">

      </div>
    </div>
    <div class="calendar-categories">
      <h5>Categories</h5><ul class="events">
        <li class="active"><a href="/emu-today/calendar/" id="cat-all-events">All Events</a></li>
        <li><a href="/emu-today/calendar/?category=alumni" id="cat-alumni">Alumni</a>            </li>
        <li><a href="/emu-today/calendar/?category=arts" id="cat-arts">Arts</a><span class="hidden">&nbsp;</span>                    <ul style="display: none;">
          <li><a href="/emu-today/calendar/?category=comedy" id="cat-comedy">Comedy</a></li>
          <li><a href="/emu-today/calendar/?category=concerts" id="cat-concerts">Concerts</a></li>
          <li><a href="/emu-today/calendar/?category=dance" id="cat-dance">Dance</a></li>
          <li><a href="/emu-today/calendar/?category=film" id="cat-film">Film</a></li>
          <li><a href="/emu-today/calendar/?category=galleries-exhibits" id="cat-galleries-exhibits">Galleries and Exhibits</a></li>
          <li><a href="/emu-today/calendar/?category=music" id="cat-music">Music</a></li>
          <li><a href="/emu-today/calendar/?category=performance" id="cat-performance">Performance</a></li>
          <li><a href="/emu-today/calendar/?category=recitals" id="cat-recitals">Recitals</a></li>
          <li><a href="/emu-today/calendar/?category=spoken-word" id="cat-spoken-word">Spoken Word</a></li>
          <li><a href="/emu-today/calendar/?category=theatre" id="cat-theatre">Theatre</a></li>
        </ul>
      </li>
      <li><a href="/emu-today/calendar/?category=conferences-workshops" id="cat-conferences-workshops">Conferences/Workshops</a>            </li>
      <li><a href="/emu-today/calendar/?category=general" id="cat-general">General Events</a><span class="hidden">&nbsp;</span>                    <ul style="display: none;">
        <li><a href="/emu-today/calendar/?category=camps" id="cat-camps">Camps</a></li>
        <li><a href="/emu-today/calendar/?category=commencement" id="cat-commencement">Commencement</a></li>
        <li><a href="/emu-today/calendar/?category=homecoming" id="cat-homecoming">Homecoming</a></li>
        <li><a href="/emu-today/calendar/?category=important-dates" id="cat-important-dates">Important Dates</a></li>
      </ul>
    </li>
    <li><a href="/emu-today/calendar/?category=lbc-approved" id="cat-lbc-approved">LBC Approved Events</a>            </li>
    <li><a href="/emu-today/calendar/?category=lectures-presentations" id="cat-lectures-presentations">Lectures/Presentations</a>            </li>
    <li><a href="/emu-today/calendar/?category=meetings" id="cat-meetings">Meetings</a>            </li>
    <li><a href="/emu-today/calendar/?category=sports-recreation" id="cat-sports-recreation">Sports/Recreation</a><span class="hidden">&nbsp;</span>                    <ul style="display: none;">
      <li><a href="/emu-today/calendar/?category=club-sports" id="cat-club-sports">Club Sports</a></li>
      <li><a href="/emu-today/calendar/?category=intramurals" id="cat-intramurals">Intramurals</a></li>
      <li><a href="/emu-today/calendar/?category=varsity-athletics" id="cat-varsity-athletics">Varsity Athletics</a></li>
    </ul>
  </li>
</ul>
</div>
<div class="calendar-categories">
<h5>Other Calendars</h5>
<ul>
  <li><a href="http://art.emich.edu/events/upcoming">Art Galleries</a></li>
  <li><a href="http://www.emueagles.com/calendar.aspx">Athletics</a></li>
  <li><a href="http://www.emich.edu/hr/calendar/">Holiday &amp; Payroll</a></li>
  <li><a href="http://www.emich.edu/emutheatre/">Theatre</a></li>
</ul>
</div>
<div class="submit-calendar">
<a href="manage/" class="button emu-button">Submit an Event</a>
</div>
<div class="ypsi-graphic">
<a href="http://visitypsinow.com/local-events/"><img src="{{ theme('imgs/emu-today/calendar/visit-ypsi.png') }}" alt="Visit Ypsi Calendar"></a>

</div>
</div>
</template>
<script>

</script>
