<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
        <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('public.layouts.styles')
    @include('public.layouts.scriptshead')
    @include('include.js')
  </head>
  <body>
    @yield('bodytop')

    <div class="off-canvas-wrapper">

      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <!-- ***** off-canvas off-canvas right menu 'small' screen -->

        <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">

          @section('offcanvaslist')

            <ul class="tier2-menu vertical dropdown menu" data-dropdown-menu>
              <li><a href="/emu-today/hub">Today</a></li>
              <li><a href="/emu-today/calendar">Calendar</a></li>
              <li><a href="/emu-today/announcement">Announcements</a></li>
              <li><a href="/emu-today/news">News</a></li>
              <li><a href="http://www.wemu.org">WEMU</a></li>
              <li><a href="#">Athletics</a></li>
            </ul>
            <ul class="tier3-menu vertical dropdown menu" data-dropdown-menu>
              <li><a href="http://www.emich.edu/media_highlights/">Media Highlights</a></li>
              <li><a href="/emu-today/magazine">Eastern Magazine</a></li>
              <li><a href="/emu-today/event/create">Submit an Event</a></li>
              <li><a href="/emu-today/announcement/create">Submit an Announcement</a></li>
          </ul>
           @show
        </div> <!-- off-canvas position-right -->
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

                                                    <div class="icon-menu float-right">

                                                        <div id="vue-search-form">
                                                            <search-form>
                                                                <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </search-form>
                                                        </div><!-- /#vue-event-form -->

                                                        {{-- <span class="search-area"><a>Search <i class="fi-magnifying-glass"></i></a></span> --}}
                                                        <span class="menu-area show-for-small-only"><a data-toggle="offCanvasRight">Menu <i class="fi-list"></i></a></span>

                                                    </div> <!-- .icon-menu -->

{{--
                                                        <li class="search-area"><a class="search-glass" href="">Search</a></li>
                                                        <li class="menu-area"><a class="menu-icon" href="">Menu</a></li> --}}

                                                </div>
                                            </div>
                                        </div><!-- large-9 -->
                                        <div class="large-3 large-pull-9 medium-2 medium-pull-10 small-2 small-pull-10 columns">
                                            <div id="logo-box" data-equalizer-watch>
                                                <a href="http://www.emich.edu"><img class="full-logo show-for-large" alt="Eastern Michigan University" src="/assets/imgs/home/logo.png"></a>
                                                <a href="http://www.emich.edu"><img class="emu show-for-medium-only" alt="Eastern Michigan University" src="/assets/imgs/home/emu.png"></a>
                                                <a href="http://www.emich.edu"><img class="block-e show-for-small-only" alt="Eastern Michigan University" src="/assets/imgs/home/blockewhiteplain.png"></a>

                                                {{-- <a href="http://www.emich.edu">
                                                    <img data-interchange="[/assets/imgs/home/emu.png, small], [/assets/imgs/home/blockewhiteplain.png, medium], [/assets/imgs/home/logo.png, large]">
                                                </a> --}}
                                            </div><!-- logo-box -->
                                        </div><!-- large-3 -->
                                    </div><!-- row -->
                                </div><!--tier1-nav -->
                            </div><!-- white-bar -->

                            <div id="transparent-bar">
                                <div id="tier2-nav" class="row">
                                    <div class="large-10 large-push-2 medium-10 medium-push-2 columns">
                                        <div class="row">
                                            <div class="large-12 medium-12 show-for-medium columns">
                                                <!-- '/admin/php/top_nav.php'); -->
                                                <ul id="tier2-nav-main">
                                                    <li><a class="{{ set_active('emu-today/hub')}}" href="/emu-today/hub"><i class="fi-play"></i>Today</a></li>
                                                    <li ><a class="{{ set_active('emu-today/calendar')}}" href="/emu-today/calendar"><i class="fi-play"></i>Calendar</a></li>
                                                    <li ><a class="{{ set_active('emu-today/announcement')}}" href="/emu-today/announcement"><i class="fi-play"></i>Announcements</a></li>
                                                    <li ><a class="{{ set_active('emu-today/news')}}" href="/emu-today/news"><i class="fi-play"></i>News</a></li>
                                                    <li ><a href="http://www.wemu.org"><i class="fi-play"></i>WEMU</a></li>
                                                    <li><a href="http://www.emueagles.com/">Athletics</a></li>
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
                                            <div class="large-12 show-for-medium columns">
                                            <ul>
                                                <!-- '/admin/php/secondary_nav.php'); -->
                                                <li><a href="http://www.emich.edu/communications/media/">For the Media</a></li>
                                                <li><a href="/emu-today/magazine">Eastern Magazine</a></li>
                                                <li><a href="/emu-today/event/create">Submit an Event</a></li>
                                                <li><a href="/emu-today/announcement/create">Submit an Announcement</a></li>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="large-2 large-pull-10 medium-2 medium-pull-10 show-for-medium columns">
                                    </div>
                                </div>
                            </div><!-- secondary-bar -->

                        </div><!-- #all-connections -->
                    </div> <!-- #connection-bar -->
                @show
<!-- ************* CONTENT-AREA ********** -->
                    <div id="content-area">
                        @yield('content')
                        @include('public.layouts.basebar')
                    </div><!-- #content-area -->

             </div> <!-- .off-canvas-content -->
           </div> <!-- .off-canvas-wrapper-inner -->
      </div> <!-- .off-canvas-wrapper -->
    @section('footer-vendor')
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57b1dfed53cef787"></script>
    @show
    @section('footer-plugin')
    @show
    @include('public.layouts.scriptsfooter')
