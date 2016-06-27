@inject('yearList', 'emutoday\Http\Utilities\YearList')
@inject('seasonList', 'emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.adminlte')
@section('title', 'Edit Magazine')
	@section('style-plugin')
		@parent
		<!-- daterange picker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/datepicker/datepicker3.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

		<link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	@endsection
	@section('scripthead')
		@parent
		<link rel="stylesheet" href="{{'/css/my-redips.css'}}" type="text/css" media="screen" />
		<script src="{{'/js/redips-drag-min.js' }}"></script>

	@endsection
	@section('content')
	<div class="row">

		{!! Form::model($magazine, [
			'method' =>  'put',
			'route' => ['admin.magazine.update', $magazine->id]
			]) !!}
			<div class="col-sm-6">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Magazine Content</h3>
					</div>
					<div class="box-body">
						<div class="form-inline">
							<div class="form-group">
								{!! Form::label('year') !!}
								{!! Form::select('year', $yearList::all(), null) !!}
							</div>
							<div class="form-group">
								{!! Form::label('season') !!}
								{!! Form::select('season', $seasonList::all(), null) !!}
							</div>
							<div class="form-group">
								{!! Form::label('start_date') !!}
								{!! Form::text('start_date', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('title') !!}
							{!! Form::text('title', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('teaser') !!}
							{!! Form::text('teaser', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('ext_url', 'Digital Version URL:') !!}
							{!! Form::text('ext_url', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-inline">
							<div class="form-group">
								{{$magazine->is_published}}

								{!! Form::label('is_published', 'Published?') !!}
								{!! Form::radio('is_published',true, null) !!}
							</div>
							<div class="form-group">
								{{$magazine->is_archived}}
								{!! Form::label('is_archived', 'Archived') !!}
								{!! Form::radio('is_archived', true, null) !!}
							</div>
							<div class="form-group">
								{!! Form::label('story_ids') !!}
								{!! Form::text('story_ids', null, ['id'=> 'story_ids',  'class' => 'form-control', 'readonly' => 'readonly']) !!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::submit('Update Page', ['class' => 'button']) !!}

							{!! Form::close() !!}
						</div>

					</div> <!-- /.box-body -->
				</div> <!-- /.box -->
			</div> <!-- /.col-sm-6 -->

			<div class="col-sm-6">
				@if(count($mediafiles) > 0 )
					@foreach ($mediafiles as $mediafile)
								<div class="box box-info">
									{{-- @if(count($magazine->mediafiles) > 0)
										<h4>{{$magazine->mediafiles()->first()}}</h4>
										@else --}}
									<div class="box-header with-border">
										<h3 class="box-title">Cover Image</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										{!! Form::model($mediafile, [
											'method' => 'put',
											'route' => ['update_magazine_cover', $magazine->id]
											]) !!}
											<div class="media-left">
												<img class="media-object" src="/imgs/magazine/thumbnails/{{ 'thumb-' . $mediafile->name . '.' .
													$mediafile->ext . '?'. 'time='. time() }}" alt="{{$mediafile->name}}">
												</div>
												<div class="form-group">
													{!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
												</div>
												<div class="form-group">
													{!! Form::label('caption') !!}
													{!! Form::text('caption', null, ['class' => 'form-control']) !!}
												</div>
												<div class="form-group">
													{!! Form::label('note') !!}
													{!! Form::text('note', null, ['class' => 'form-control']) !!}
												</div>
												<div class="form-group">
													{!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
												</div>
												{{ csrf_field() }}
												{!! Form::close() !!}
											</div> <!-- /.box-body -->
									</div> <!-- /.box -->
								@endforeach
							@else
								<div class="box box-info">
									<div class="box-header with-border">
										<h3 class="box-title">Add Cover Image</h3>
									</div><!-- /.box-header -->
				<div class="box-body">
			{!! Form::open(array('method' => 'post',
													'route' => ['store_magazine_cover', $magazine->id],
													'files' => true)) !!}
					<div class="form-group">
						{!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
					</div>
							<div class="form-group">
							{!! Form::label('caption') !!}
							{!! Form::text('caption', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('note') !!}
							{!! Form::text('note', null, ['class' => 'form-control']) !!}
						</div>
							<div class="form-group">
							{!! Form::submit('Add Cover Image', array('class'=>'btn btn-primary')) !!}
						</div>
					{{ csrf_field() }}
				{!! Form::close() !!}

					</div> <!-- /.box-body -->

				</div> <!-- /.box -->
			@endif

			{{-- @each('admin.magazine.subviews.coverimage',$mediafiles, 'mediafile', 'admin.magazine.subviews.addcoverimage') --}}
			</div> <!-- /.col-sm-6 -->
		</div>
	<div class="row">
		<div class="col-sm-12">

			<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Build Magazine</h3>
					</div>

					<div class="box-body">

							@include('admin.magazine.templates.layoutindex')

					</div> <!-- /.box-body -->
				</div> <!-- /.box -->
			</div>
		</div>
		@endsection
		@section('footer-plugin')
			@parent

			<!-- Select2 -->
			<script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
			<!-- InputMask -->
			<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
			<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
			<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
			<!-- date-range-picker -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
			<script src="/themes/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
			<!-- bootstrap datepicker -->
			<script src="/themes/admin-lte/plugins/datepicker/bootstrap-datepicker.js"></script>
			<!-- bootstrap datetimepicker -->
			<script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


			<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
			<!-- iCheck 1.0.1 -->
			<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
			<!-- FastClick -->
			<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>

			<!-- Bootstrap WYSIHTML5 -->
			<script src="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

		@endsection
		@section('footer-script')
			@parent
			<script src="{{'/js/magazine-redips.js'}}"></script>
			<script>
			// $(function(){
			// 	$('#start_date').fdatepicker({
			// 		format: 'yyyy-mm-dd hh:ii',
			// 		disableDblClickSelection: true,
			// 		language: 'en',
			// 		pickTime: true
			// 	});
			// 	$('#end_date').fdatepicker({
			// 		format: 'yyyy-mm-dd hh:ii',
			// 		disableDblClickSelection: true,
			// 		language: 'en',
			// 		pickTime: true
			// 	});
			//
			//
			// });
			</script>
		@endsection
