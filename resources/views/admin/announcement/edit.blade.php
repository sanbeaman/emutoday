@extends('admin.layouts.adminlte')
@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
@section('style-plugin')
	@parent
		<!-- daterange picker -->
<link rel="stylesheet" href="/themes/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/themes/adminlte/plugins/datepicker/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/themes/adminlte/plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="/themes/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="/themes/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="/themes/adminlte/plugins/select2/select2.min.css">

<link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/themes/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		@endsection
		@section('scripthead')
					{{-- @include('admin.layouts.scriptshead') --}}
		@show
		@include('include.js')
@section('content')
	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Announcement Edit</h3>
			</div>	<!-- /.box-header -->
			<div class="box-body">
    {!! Form::model($announcement, [
        'method' => $announcement->exists ? 'put' : 'post',
        'route' => $announcement->exists ? ['admin.announcement.update', $announcement->id] : ['admin.announcement.store']
    ]) !!}
    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('announcement') !!}
        {!! Form::textarea('announcement', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-inline">
          {!! Form::label('start_date') !!}
          {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
          {!! Form::label('end_date') !!}
          {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
      </div>
			<div class="form-inline">
				<div class="form-group">

				{!! Form::label('is_approved') !!}
            {{ Form::radio('is_approved', 1) }}{!! Form::label('is_approved', 'yes') !!}
            {{ Form::radio('is_approved', 0) }}{!! Form::label('is_approved', 'no') !!}
			</div>
			<div class="form-group">
				{!! Form::label('is_promoted') !!}
          {!! Form::radio('is_promoted', 1) !!}{!! Form::label('is_promoted', 'yes') !!}
          {!! Form::radio('is_promoted', 0) !!}{!! Form::label('is_promoted', 'no') !!}
			</div>

		</div>
			<div class="form-group">
				{!! Form::submit($announcement->exists ? 'Save Announcement' : 'Create New Announcement', ['class' => 'button']) !!}

		    {!! Form::close() !!}
			</div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
	</section>
@endsection

	@section('footer-plugin')
		@parent
	@endsection


	@section('footer-script')
		@parent
	@endsection
