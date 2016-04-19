@extends('admin.layouts.master')
@section('title', 'Edit Story')
@section('scripthead')
          @parent
          	<link rel="stylesheet" href="{{ theme('css/my-redips.css') }}" type="text/css" media="screen" />
          <script src="{{ theme('js/redips-drag-min.js') }}"></script>

    @endsection
@section('content')
<div class="column row">
	{!! Form::model($page, [
		'method' =>  'put',
		'route' => ['admin.pages.update', $page->id]
	]) !!}
	<div class="row">

		<div class="medium-2 columns">
		    <div class="input-group">
		        {!! Form::label('template') !!}
				{!! Form::text('template', $page->template, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
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
		<div class="medium-1 columns">
			<div class="input-group">
			 {!! Form::label('is_active') !!}
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
		<div class="medium-2 columns">
			<div class="input-group">
 				{!! Form::label('story_ids') !!}
				{!! Form::text('story_ids', null, ['id'=> 'story_ids',  'class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="medium-1 columns">
		{!! Form::submit('Update Page', ['class' => 'button']) !!}

		{!! Form::close() !!}
		</div>

	</div> <!-- END Row top page input -->

	<div class="row">
		@include('admin.pages.templates.homeemutoday')



	</div> <!-- END Row bottom page layout form -->

</div>
@endsection
@section('scriptsfooter')
	@parent
	    <script src="{{ theme('js/my-redips.js') }}"></script>
		
	<script>
	$(function(){
		$('#start_date').fdatepicker({
			format: 'yyyy-mm-dd hh:ii',
			disableDblClickSelection: true,
			language: 'en',
			pickTime: true
		});
		$('#end_date').fdatepicker({
			format: 'yyyy-mm-dd hh:ii',
			disableDblClickSelection: true,
			language: 'en',
			pickTime: true
		});


	});
	</script>
@endsection
