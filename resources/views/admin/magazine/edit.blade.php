@inject('yearList', 'emutoday\Http\Utilities\YearList')
@inject('seasonList', 'emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.master')
@section('title', 'Edit Magazine')
@section('scripthead')
          @parent
          	<link rel="stylesheet" href="{{'css/my-redips.css'}}" type="text/css" media="screen" />
          <script src="{{'js/redips-drag-min.js' }}"></script>

    @endsection
@section('content')
<div class="column row">
	{!! Form::model($magazine, [
		'method' =>  'put',
		'route' => ['admin.magazine.update', $magazine->id]
	]) !!}
	<div class="row">
    <div class="medium-2 columns">
        <div class="input-group">
        {!! Form::label('year') !!}
        {!! Form::select('year', $yearList::all(), null) !!}
        </div>
    </div>
    <div class="medium-2 columns">
        <div class="input-group">
        {!! Form::label('season') !!}
        {!! Form::select('season', $seasonList::all(), null) !!}
        </div>
    </div>
    <div class="input-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="input-group">
        {!! Form::label('teaser') !!}
        {!! Form::text('teaser', null, ['class' => 'form-control']) !!}
    </div>

    <div class="medium-2 columns">
      <div class="input-group">
        {!! Form::label('ext_url', 'Digital Version URL:') !!}
        {!! Form::text('ext_url', null, ['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="medium-2 columns">
        {!! Form::label('start_date') !!}
        {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
    </div>
    <div class="medium-2 columns">
      <div class="input-group">
        {!! Form::label('Published?') !!}
        <div class="switch medium">
        <input class="switch-input" id="pub-yes-no" type="checkbox" name="is_published">
        <label class="switch-paddle" for="pub-yes-no">
          <span class="show-for-sr">Is Magazine Published?</span>
          <span class="switch-active" aria-hidden="true">Yes</span>
          <span class="switch-inactive" aria-hidden="true">No</span>
        </label>
        </div>

      </div>
    </div>
    <div class="medium-2 columns">
      <div class="input-group">
        {!! Form::label('Archived?') !!}
        <div class="switch medium">
        <input class="switch-input" id="arc-yes-no" type="checkbox" name="is_archived">
        <label class="switch-paddle" for="arc-yes-no">
          <span class="show-for-sr">Is Magazine Archived?</span>
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
		@include('admin.magazine.templates.layoutindex')



	</div> <!-- END Row bottom page layout form -->

</div>
@endsection
@section('scriptsfooter')
	@parent
	    <script src="{{'js/magazine-redips.js'}}"></script>

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
