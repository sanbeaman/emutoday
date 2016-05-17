<!-- Event Views with Vues -->
@extends('public.layouts.global')
@section('content')
  <div id="content-area">
    <div id="calendar-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <div class="row managehorizontalpadding">
            <div class="large-12 medium-12 small-12 columns  noleftpadding">
              <h3 class="cal-caps toptitle">Events Calendar</h3>
            </div>
          </div>
          <div id="five-events-container" class="row managehorizontalpadding">
            <div class="large-12 medium-12 small-12 columns">
              <div id="five-events-bar"></div> <!--end of five images bar-->
            </div>
          </div><!--row 2 in calendar bar-->
        </div><!--end calendar row column-->
      </div><!--end calendar bar row 1-->
      <div id="vueapp">
        <component is="event-view">
      </component>
      </div>
    </div>
</div>
@endsection

@section('footer')
  @parent
  <script src="{{ 'js/main.js' }}"></script>
@endsection
