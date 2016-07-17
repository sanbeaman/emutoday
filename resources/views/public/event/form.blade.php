<!-- Event Views with Vues -->
@extends('public.layouts.global')
@section('content')
    <div id="calendar-bar">
		<div class="row">
			<div class="medium-12 column">

				@include('public.layouts.components.errors')
				<div class="row">
						<div class="medium-6 columns">
							<h3 class="cal-caps toptitle">Events Calendar</h3>
							<div id="vue-event-form">
									<event-form authorid="{{$currentUser->id}}" eventexists="{{$event->exists ? true: false}}" editeventid="{{$event->exists ? $event->id : null }}">
										<input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
									</event-form>
							</div><!-- /#vue-event-form -->
						</div><!-- /.medium-6 column -->
						<div class="medium-6 columns">
							<div class="row">
								<div class="small-12 column">
									<h3 class="cal-caps toptitle">Approved Events</h3>
									<table id="user-events-table" class="table table-bordered table-hover">
														<thead>
															<tr>
																	<th class="text-center">ID</th>
																	<th class="text-left">Title</th>
																	<th class="text-left">Submitted On</th>

																	<th class="text-left">Approved On</th>
																	<th class="text-left">Start Date</th>
																</tr>
														</thead>
														<tbody>
																@foreach($approvedevents as $event)
																		<tr>
																			<td>{{ $event->id }}</td>
																				<td>{{ $event->title }}</td>
																			<td>{{ $event->submission_date }}</td>

																			<td>{{ $event->approved_date }}</td>
																			<td>{{ $event->start_date }}</td>
																		</tr>
																@endforeach
														</tbody>
													</table>
													{{-- {!! $storys->render() !!} --}}
													{{-- {{ $storys->links() }} --}}
								</div><!-- /.small-12 column -->
							</div><!-- /.row -->
							<div class="row">
								<div class="small-12 column">
									<h3 class="cal-caps toptitle">Submitted Events</h3>
									<table id="user-events-table" class="table table-bordered table-hover">
														<thead>
															<tr>
																	<th class="text-center">ID</th>
																	<th class="text-left">Title</th>
																	<th class="text-left">Submitted On</th>

																	<th class="text-left">Approved On</th>
																	<th class="text-left">Start Date</th>
																</tr>
														</thead>
														<tbody>
																@foreach($submittedevents as $event)
																		<tr>
																			<td>{{ $event->id }}</td>
																				<td>{{ $event->title }}</td>
																			<td>{{ $event->submission_date }}</td>

																			<td>{{ $event->approved_date }}</td>
																			<td>{{ $event->start_date }}</td>
																		</tr>
																@endforeach
														</tbody>
													</table>
													{{-- {!! $storys->render() !!} --}}
													{{-- {{ $storys->links() }} --}}
								</div><!-- /.small-12 column -->
							</div><!-- /.row -->



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
