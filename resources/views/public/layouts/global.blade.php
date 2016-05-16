<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')  &mdash; EMU</title>
    @include('public.layouts.styles')
    @include('public.layouts.scriptshead')
    @include('include.js')
  </head>
  <body>
    <div class="off-canvas-wrapper">
      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <aside class="off-canvas position-right" id="offCanvas" data-off-canvas>
          @section('offcanvaslist')
          <ul class="off-canvas-list"><!-- include($_SERVER['DOCUMENT_ROOT'].'/emu-today/admin/php/top_nav.php'); -->
            <li><a href="/emu-today/hub">Today</a></li>
            <li><a href="/emu-today/calendar">Calendar</a></li>
            <li><a href="/emu-today/announcement">Announcements</a></li>
            <li><a href="/emu-today/news">News</a></li>
            <li><a href="/emu-today/student">Student Profiles</a></li>
            <li><a href="#">Athletics</a></li>
          </ul>
          <ul class="off-canvas-list alt"><!-- include($_SERVER['DOCUMENT_ROOT'].'/emu-today/admin/php/secondary_nav.php'); -->
            <li><a href="#">Media Highlights</a></li>
            <li><a href="/emu-today/magazine">Eastern Magazine</a></li>
            <li><a href="#">Submit an Event</a></li>
            <li><a href="#">Submit an Announcement</a></li>
          </ul>
        @show
        </aside> <!-- END off-canvas position-right -->
        <div class="off-canvas-content" data-off-canvas-content>
          @section('connectionbar')
          <div id="connection-bar" data-equalizer>
            <div id="all-connections" data-equalizer-watch>
              <div id="white-bar">
                <div id="tier1-nav">
                  <div class="row">
                    <div class="large-9 large-push-3 medium-10 medium-push-2 small-10 small-push-2 columns">
                      <div class="row">
                        <div class="large-5 medium-7 small-12 columns">
                          <h1><a href="/emu-today/hub"><span class="first-word">EMU</span> Today</a></h1>
                        </div>
                        <div class="large-7 medium-5 small-12 columns">
                          <ul>
                            <li class="search-area"><a class="search-glass" href="">Search</a></li>
                            <li class="menu-area"><a class="menu-icon" href="">Menu</a></li>
                          </ul>
                        </div>
                      </div>
                    </div><!-- large-9 -->
                    <div class="large-3 large-pull-9 medium-2 medium-pull-10 small-2 small-pull-10 columns">
                      <div id="logo-box" data-equalizer-watch>
                        <a href="http://www.emich.edu"><img class="full-logo" alt="Eastern Michigan University" src="/themes/default/assets/imgs/home/logo.png"></a>
                        <a href="http://www.emich.edu"><img class="block-e" alt="Eastern Michigan University" src="/themes/default/assets/imgs/home/blockEwhiteplain.png"></a>
                        <a href="http://www.emich.edu"><img class="emu" alt="Eastern Michigan University" src="/themes/default/assets/imgs/home/emu.png"></a>
                        {{-- <a href="http://www.emich.edu">
                          <img data-interchange="[/themes/default/assets/imgs/home/emu.png, small], [/themes/default/assets/imgs/home/blockewhiteplain.png, medium], [/themes/default/assets/imgs/home/logo.png, large]">
                        </a> --}}
                      </div><!-- logo-box -->
                    </div><!-- large-3 -->
                  </div><!-- row -->
                </div><!--tier1-nav -->
              </div><!-- white-bar -->
              <div id="transparent-bar">
                <div id="tier2-nav" class="row">
                  <div class="large-10 large-push-2 medium-10 medium-push-2 small-10 small-push-2 columns">
                    <div class="row">
                      <div class="large-12 medium-12 small-12 columns">
                        <!-- '/admin/php/top_nav.php'); -->
                        <ul>

                          <li><a class="{{ set_active('emu-today/hub', 'right-arrow')}}" href="/emu-today/hub">Today</a></li>
                          <li ><a class="{{ set_active('emu-today/calendar', 'right-arrow')}}" href="#">Calendar</a></li>
                          <li ><a class="{{ set_active('emu-today/announcement', 'right-arrow')}}" href="/emu-today/announcement">Announcements</a></li>
                          <li ><a class="{{ set_active('emu-today/news', 'right-arrow')}}" href="/emu-today/news">News</a></li>
                          <li ><a class="{{ set_active('emu-today/student', 'right-arrow', 1)}}" href="/emu-today/student">Student Profiles</a></li>
                          <li><a href="#">Athletics</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="large-2 large-pull-10 medium-2 medium-pull-10 small-2 small-pull-10 columns">&nbsp;</div>
                </div> <!-- tier2-nav -->
              </div><!-- transparent-bar -->
              <div id="secondary-bar">
                <div id="tier3-nav" class="row">
                  <div class="large-10 large-push-2 medium-10 medium-push-2 show-for-medium columns">
                    <div class="row">
                      <div class="large-12 medium-12 small-12 columns">
                      <ul>
                        <!-- '/admin/php/secondary_nav.php'); -->
                        <li><a href="#">For the Media</a></li>
                        <li><a href="/emu-today/magazine">Eastern Magazine</a></li>
                        <li><a href="#">Submit an Event</a></li>
                        <li><a href="#">Submit an Announcement</a></li>
                      </ul>
                    </div>
                    </div>
                  </div>
                  <div class="large-2 large-pull-10 medium-2 medium-pull-10 show-for-medium columns">&nbsp;</div>
                </div>
              </div><!-- secondary-bar -->
            </div> <!-- all-connections -->
          </div> <!-- connection-bar -->
        @show
   <section class="main-section">
         @yield('content')
  </section>
  <a class="exit-off-canvas"></a>
      <!-- php $wrapper->base(); -->
  <div id="base-message-bar">
    <div class="row">
      <p><a href="http://www.emich.edu/tobaccofree/">Eastern Michigan University is a tobacco-free campus.</a></p>
    </div>
  </div>  <!-- END base-message-bar -->
  <div id="base-bar">
    <div class="row">
      <div id="university-contacts" class="large-2 medium-2 hide-for-small columns noleftpadding">
        <a href="http://www.emich.edu"><img class="bottom-logo" alt="Eastern Michigan University" src="{{ theme('imgs/home/logo.png')}}"/></a>
      </div>
      <div id="linking-lists" class="large-8 medium-10 small-12 columns noleftpadding">
                <h6><a href="http://www.emich.edu">Eastern Michigan University, <span class="notbold">Education First</span></a></h6>
                <p>Ypsilanti, Michigan, USA 48197 | 734.487.1849</p>
                <p><a href="http://www.emich.edu/title-nine/">Non-Discrimination Statement</a> | <a href="http://www.emich.edu/privacy/">Privacy Policy</a> | <a href="http://www.emich.edu/copyright/">Copyright <?= date('Y') ?></a></p>
      </div>
      <div id="social-links" class="large-2 medium-12 small-12 columns noleftpadding norightpadding">
          <ul class="social-icons">
            <li><a href="https://www.facebook.com/Eastern.Michigan.University"><img alt="Facebook" src="{{ theme('imgs/icons/facebook-base-icons.png') }}"></a></li>
            <li><a href="http://www.emich.edu/twitter/"><img alt="Twitter" src="{{ theme('imgs/icons/twitter-base-icons.png') }}"></a></li>
            <li><a href="https://www.youtube.com/user/emichigan08"><img alt="YouTube" src="{{ theme('imgs/icons/you-tube-base-icons.png')}}"></a></li>
            <li><a href="https://instagram.com/easternmichigan/"><img alt="Instagram" src="{{ theme('imgs/icons/instagram-base-icons.png') }}"></a></li>
            <li><a href="https://www.linkedin.com/edu/school?id=18604"><img alt="Linked-In" src="{{ theme('imgs/icons/linked-in-base-icons.png') }}"></a></li>
            <li><a href="http://blogemu.com/"><img alt="Blog EMU" src="{{ theme('imgs/icons/e-base-icons.png') }}"></a></li>
          </ul>
      </div> <!-- END social links -->
    </div>
    <div id="final-bar" class="row">
      </div>
  </div>

    </div>
    </div>
 </div> <!-- off-canvas-content -->
    @include('public.layouts.scriptsfooter')
  </body>
</html>
