@inject('yearList', 'emutoday\Http\Utilities\YearList')
@inject('seasonList', 'emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.master')
@section('title', 'Create New Magazine')
@section('content')

	<div class="row">
		{!! Form::model($magazine, [
			'method' =>  'post',
			'route' => ['admin.magazine.store']
		]) !!}
		<div class="medium-2 columns">
		    <div class="input-group">
		    {!! Form::label('year') !!}
				{!! Form::select('year', $yearList::all(), 0) !!}
		    </div>
		</div>
    <div class="medium-2 columns">
		    <div class="input-group">
		    {!! Form::label('season') !!}
				{!! Form::select('season', $seasonList::all(), 0) !!}
		    </div>
		</div>
    <div class="input-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
		<div class="input-group">
				{!! Form::label('subtitle') !!}
				{!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
		</div>
    <div class="input-group">
        {!! Form::label('teaser') !!}
        {!! Form::text('teaser', null, ['class' => 'form-control']) !!}
    </div>
		{!! Form::submit('Create New Magazine', ['class' => 'button']) !!}

		{!! Form::close() !!}
	</div> <!-- END Row top page input -->
@endsection
@section('scriptsfooter')
	@parent
	<script>
	
	</script>
@endsection
