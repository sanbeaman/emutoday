@inject('pageTemplates', 'emutoday\Http\Utilities\PageTemplates')
@extends('admin.layouts.master')
@section('title', 'Create New Page')
@section('content')

	<div class="row">
		{!! Form::model($page, [
			'method' =>  'post',
			'route' => ['admin.pages.store']
		]) !!}
		<div class="medium-2 columns">
		    <div class="input-group">
		        {!! Form::label('template') !!}
				{!! Form::select('template', $pageTemplates::all(), 0) !!}
		    </div>
		</div>
		<div class="medium-2 columns">
			<div class="input-group">
				{!! Form::label('uri') !!}
				{!! Form::text('uri', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="medium-2 columns">
				{!! Form::label('start_date') !!}
				{!! Form::text('start_date', null, ['class' => 'form-control']) !!}
		</div>
		<div class="medium-2 columns">
				{!! Form::label('end_date') !!}
				{!! Form::text('end_date', null, ['class' => 'form-control']) !!}
		</div>
		<div class="medium-2 columns">
			<div class="input-group">
				{!! Form::label('Active?') !!}
			  <div class="switch medium">
				<input class="switch-input" id="yes-no" type="checkbox" name="is_active">
				<label class="switch-paddle" for="yes-no">
				  <span class="show-for-sr">Is Page Active?</span>
				  <span class="switch-active" aria-hidden="true">Yes</span>
				  <span class="switch-inactive" aria-hidden="true">No</span>
				</label>
			  </div>

			</div>
		</div>
		{!! Form::submit('Create New Story', ['class' => 'button']) !!}

		{!! Form::close() !!}
	</div> <!-- END Row top page input -->
@endsection
@section('scriptsfooter')
	@parent
	<script>
	$(function(){
		$('#start_date').fdatepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			disableDblClickSelection: true,
			language: 'en',
			pickTime: true
		});
		$('#end_date').fdatepicker({
			format: 'yyyy-mm-dd hh:ii:ss',
			disableDblClickSelection: true,
			language: 'en',
			pickTime: true
		});


	});
	</script>
@endsection
