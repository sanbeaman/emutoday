@inject('yearList', 'emutoday\Http\Utilities\YearList')
@inject('seasonList', 'emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.adminlte')
@section('title', 'Create New Magazine')
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
	@endsection
@section('content')
<section class="content">


	<div class="row">
		{!! Form::model($magazine, [
			'method' =>  'post',
			'route' => ['admin.magazine.store']
		]) !!}
		<div class="form-group">
		    {!! Form::label('year') !!}
				{{-- {!! Form::select('year', $yearList::all(), 0) !!} --}}
				{!! Form::select('year', $yearList::all(), 0, ['class' => 'form-control']) !!}
		</div>
  <div class="form-group">
		    {!! Form::label('season') !!}
				{!! Form::select('season', $seasonList::all(), 0,['class' => 'form-control']) !!}
		    </div>

    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
		<div class="form-group">
				{!! Form::label('subtitle') !!}
				{!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
		</div>
    <div class="form-group">
        {!! Form::label('teaser') !!}
        {!! Form::text('teaser', null, ['class' => 'form-control']) !!}
    </div>
		{!! Form::submit('Create New Magazine', ['class' => 'btn btn-primary']) !!}

		{!! Form::close() !!}
		</section>
	</div> <!-- END Row top page input -->
@endsection
@section('scriptsfooter')
	@parent
	<script>

	</script>
@endsection
