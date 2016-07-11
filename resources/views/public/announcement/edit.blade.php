{{-- announcement --}}
@extends('public.layouts.global')
@section('content')
    <div id="listing-bar">

				<div class="row">
				<div class="medium-6 columns">
					<div id="title-grouping" class="row">
							<div class="small-12 columns"><h3 class="news-caps">Edit Announcement</h3></div>
					</div>
						<div class="row">
							<div class="small-12 column">
								@include('public.layouts.components.errors')
							{!! Form::model($announcement, [
								'method' => $announcement->exists ? 'put' : 'post',
								'route' => $announcement->exists ? ['emu-today.announcement.update', $announcement->id] : ['emu-today.announcement.store'],
								'data-abide' => 'data-abide'
								]) !!}
									<div class="form-group">
										<label>Title
											{!! Form::text('title', null, ['class' => 'form-control','aria-describedby' =>'description-helptext', 'required'=> 'required']) !!}
											<span class="form-error">
												Please Include a Title for your Announcement.
											</span>
										</label>
										<p class="help-text" id="description-helptext">Please enter a title</p>
									</div>
									<div class="form-group">
										<label>Description
											{!! Form::textarea('announcement', null, ['class' => 'form-control','rows' => '4', 'aria-describedby' =>'announcement-helptext', 'required'=> 'required','maxlength'=> '400'  ]) !!}
										</label>
										<p class="help-text" id="announcement-helptext">Brief Description of Announcement under 400 characters.</p>
									</div>
								</div><!-- /.small-12 column -->
							</div><!-- /.row -->
							<div class="row">
								<div class="medium-4 columns">
									<div class="form-group">
										{!! Form::text('start_date', null, ['class' => 'form-control', 'id'=>'announcement-start-date' ]) !!}
									</div><!-- /.form-group -->
									<div class="form-group">
										<label>Start Date
											{!! Form::text('start_date_view', null, ['class' => 'form-control', 'id'=>'view-announcement-start-date','aria-describedby' =>'start-date-helptext','required'=> 'required']) !!}
											<span class="form-error">
												Please Include a Start Date.
											</span>
										</label>
										<p class="help-text" id="start-date-helptext">Please enter a Start Date</p>
									</div>

								</div><!-- /.col-md-3 -->
									<div class="medium-4 columns">
										<div class="form-group">
											{!! Form::text('end_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-end-date','data-abide-ignore'=>' data-abide-ignore']) !!}
										</div><!-- /.form-group -->
										<div class="form-group">
											<label>End Date
												{!! Form::text('end_date_view', null, ['class' => 'form-control', 'id'=>'view-announcement-end-date','aria-describedby' =>'end-date-helptext']) !!}
												<span class="form-error">
													Please Include a Start Date.
												</span>
											</label>
											<p class="help-text" id="end-date-helptext">Please enter a End Date</p>
										</div>
									</div><!-- /.col-md-3 -->
									<div class="medium-4 columns">
									<div class="form-group text-right">
										<label>
											{!! Form::submit($announcement->exists ? 'Update' : 'Create New', ['class' => 'button button-success expanded']) !!}
										</label>

									</div>
								</div><!-- /.medium-3 columns -->
								{!! Form::close() !!}
							</div> <!-- row -->
						</div><!-- /.medium-6 -->
						<div class="medium-6 column">
							<div id="title-grouping" class="row">
									<div class="small-12 columns"><h3 class="news-caps">Your Announcements</h3></div>
							</div>
		          <div class="row">
            <div class="large-12 medium-12 small-12 column">
							<ul class="accordion" data-accordion data-allow-all-closed="true">
								@if (isset($id))
										@foreach($announcements as $announcement)
									<li class="{{$announcement->id == $id ? 'accordion-item is-active':'accordion-item' }}" id="accitem-{{$announcement->id}}" data-accordion-item>
									{{-- <li class="accordion-item" data-accordion-item> --}}
										<a href="#" class="accordion-title">{{$announcement->title}}</a>
										<div class="accordion-content" data-tab-content>
											{!! $announcement->announcement !!}
											<p>posted {{$announcement->present()->prettyDate}}</p>
										</div>
									</li>
								@endforeach
							@else
									<li>You don't have any saved announcements</li>
								@endif

							</ul>


            </div>
          </div>
        </div><!-- /.medium-6 columns -->

      </div><!-- /.row -->
    </div><!-- listing-bar -->
@endsection
@section('scriptsfooter')
	@parent
	<!-- Bootstrap WYSIHTML5 -->
	<script>
	$(function(){
		var now = JSvars.currentDate;
		var startDate = new Date(JSvars.currentDate);
		var announceStartDate = new Date($('#announcement-start-date').val());
		var announceEndDate = new Date($('#announcement-end-date').val());

		var checkin = $('#view-announcement-start-date').fdatepicker({
					format: 'mm-dd-yyyy',
					disableDblClickSelection: true,
					onRender: function (date) {
						return new Date(announceStartDate);
						// return date.valueOf() < now.valueOf() ? 'disabled' : '';
				}
			})
			.on('show', function() {
				if($('#announcement-start-date').val()) {
					checkin.update(announceStartDate)
				}

			})


			.on('changeDate', function (ev) {
				if (ev.date.valueOf() > checkout.date.valueOf()) {
					var newDate = new Date(ev.date)
					newDate.setDate(newDate.getDate() + 1);
					checkout.update(newDate);
				}
				startDate = new Date(ev.date);
				$('#announcement-start-date').val(startDate);
				checkin.hide();
				$('#view-announcement-end-date')[0].focus();
			}).data('datepicker');

			var checkout = $('#view-announcement-end-date').fdatepicker({
				format: 'mm-dd-yyyy',
				disableDblClickSelection: true,
				onRender: function (date) {
					return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
				}
			}).on('changeDate', function (ev) {
				checkout.hide();
			}).data('datepicker');



		// $('#announcement-start-date').fdatepicker({
		// 	initialDate: JSvars.currentDate,
		// 	format: 'mm-dd-yyyy',
		// 	disableDblClickSelection: true
		// });
		// $('#announcement-end-date').fdatepicker({
		// 	initialDate: JSvars.currentDate,
		// 	format: 'mm-dd-yyyy',
		// 	disableDblClickSelection: true
		// });
	});


	</script>
@endsection
