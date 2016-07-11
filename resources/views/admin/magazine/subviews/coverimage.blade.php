<div class="box box-info">
	{{-- @if(count($magazine->mediafiles) > 0)
		<h4>{{$magazine->mediafiles()->first()}}</h4>
		@else --}}
	<div class="box-header with-border">
		<h3 class="box-title">Cover Image</h3>
	</div>
	<div class="box-body">
		{!! Form::model($mediafile,[
			'method' =>  'put',
			'route' => ['update_magazine_cover',$mediafile->id ] ,
			'files' => true
		]) !!}
			<div class="form-group">
				<img src="/imagecache/betterthumb/{{$mediafile->filename}}" alt="{{$mediafile->name}}">
			</div><!-- /.form-group -->


			<div class="form-group">
			{!! Form::label('caption') !!}
			{!! Form::text('caption', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('note') !!}
			{!! Form::text('note', null, ['class' => 'form-control']) !!}
		</div>
			<div class="form-group">
				{!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
			</div>
			<div class="form-group">
			{!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
		</div>
	{{ csrf_field() }}
{!! Form::close() !!}

	</div> <!-- /.box-body -->

</div> <!-- /.box -->
