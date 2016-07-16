<!-- Event Views with Vues -->
@extends('public.layouts.global')
@section('content')
    <div id="calendar-bar">
		<div class="row">
			<div class="small-12 column">
				<h3 class="cal-caps toptitle">Events Calendar</h3>
				@include('public.layouts.components.errors')
				<div class="row">
						<div class="medium-6 columns">
							<div id="vue-event-form">
									<event-form authorid="{{$currentUser->id}}" eventexists="{{$event->exists ? true: false}}" editeventid="{{$event->exists ? $event->id : null }}">
										<input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
									</event-form>
							</div><!-- /#vue-event-form -->
						</div><!-- /.medium-6 column -->
						<div class="medium-6 columns">

						</div><!-- /.medium-6 columns -->
					</div><!-- /.row -->
			</div><!-- /.small-12 column -->
		</div><!-- /.row -->
	</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
  @parent
  <script type="text/javascript" src="/js/vue-event-form.js"></script>
@endsection
