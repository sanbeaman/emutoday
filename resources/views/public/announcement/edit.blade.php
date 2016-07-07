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
											{!! Form::textarea('announcement', null, ['class' => 'form-control htmlwysiwyg','rows' => '4', 'aria-describedby' =>'announcement-helptext', 'required'=> 'required','maxlength'=> '400'  ]) !!}
										</label>
										<p class="help-text" id="announcement-helptext">Brief Description of Announcement under 400 characters.</p>
									</div>
								</div><!-- /.small-12 column -->
							</div><!-- /.row -->
							<div class="row">
								<div class="medium-4 columns">
									<div class="form-group">
										<label>Start Date
											{!! Form::text('start_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-start-date','aria-describedby' =>'start-date-helptext', 'required'=> 'required']) !!}
											<span class="form-error">
												Please Include a Start Date.
											</span>
										</label>
										<p class="help-text" id="start-date-helptext">Please enter a Start Date</p>
									</div>
								</div><!-- /.col-md-3 -->
									<div class="medium-4 columns">
										<div class="form-group">
											<label>End Date
												{!! Form::text('end_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-end-date','aria-describedby' =>'end-date-helptext','data-abide-ignore'=>' data-abide-ignore']) !!}
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
											{!! Form::submit($announcement->exists ? 'Save' : 'Create New', ['class' => 'button button-success expanded']) !!}
										</label>

									</div>
								</div><!-- /.medium-3 columns -->
								{!! Form::close() !!}
							</div> <!-- row -->
						</div><!-- /.medium-6 -->
						<div class="medium-6 column">
							<div id="title-grouping" class="row">
									<div class="small-12 columns"><h3 class="news-caps">Announcements</h3></div>
							</div>
		          <div class="row">
            <div class="large-12 medium-12 small-12 column">

	              <ul class="accordion" data-accordion data-allow-all-closed="true">
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
              </ul>
              <div id="base-grouping" class="row">
                <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
                <div class="large-7 medium-5 small-12 columns"><h6>{!! $announcements->links() !!}</h6>                </div>
              </div>
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
		$('#announcement-start-date').fdatepicker({
			initialDate: JSvars.currentDate,
			format: 'mm-dd-yyyy',
			disableDblClickSelection: true
		});
		$('#announcement-end-date').fdatepicker({
			initialDate: JSvars.currentDate,
			format: 'mm-dd-yyyy',
			disableDblClickSelection: true
		});
	});


	</script>
@endsection
