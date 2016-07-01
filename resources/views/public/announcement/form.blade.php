@extends('public.layouts.global')
@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
@section('content')
<div class="row">
	<div class="small-6 columns">
		<div class="row">
			<div class="small-12 column">
				{!! Form::model($announcement, [
        'method' => $announcement->exists ? 'put' : 'post',
        'route' => $announcement->exists ? ['emu-today.announcement.update', $announcement->id] : ['emu-today.announcement.store']
    		]) !!}
    	<div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    	</div>
    	<div class="form-group">
				<label>Description
					{!! Form::textarea('announcement', null, ['class' => 'form-control htmlwysiwyg','rows' => '3', 'aria-describedby' =>'announcementHelpText'  ]) !!}
				</label>
				<p class="help-text" id="announcementHelpText">Brief Description of Announcement under 200 characters.</p>
			</div>
		</div><!-- /.small-12 column -->
	</div><!-- /.row -->
	<div class="row">
		<div class="medium-4 columns">
			<div class="form-group">
				{!! Form::label('start_date') !!}
				{!! Form::text('start_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-start-date']) !!}
			</div>
		</div><!-- /.col-md-3 -->
		<div class="medium-4 columns">
			<div class="form-group">
				{!! Form::label('end_date') !!}
					{!! Form::text('end_date', null, ['class' => 'form-control datetimepicker', 'id'=>'announcement-end-date']) !!}
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
	</div><!-- /.row -->
	</div><!-- /.small-6 columns -->
	<div class="small-6 columns">

		</div><!-- /.medium-6 columns -->
</div><!-- row -->
@endsection

@section('scriptsfooter')
		@parent
		{{-- <!-- Bootstrap WYSIHTML5 -->
<script src="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<script>
			$(function () {
				  $(".htmlwysiwyg").wysihtml5();
					//Date picker
					// $('.datetimepicker').datetimepicker({
					// 	format: 'YYYY-MM-DD HH:mm:ss'
					// 	});
					});

		</script>--}}
	@endsection
