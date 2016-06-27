<div class="box">
	{!! Form::model($storyImage,[
		'method' => 'patch',
		'route' => ['admin.storyimages.update', $storyImage->id],
		'files' => true
	]) !!}
        <div class="box-header with-border">
          <h3 class="box-title">{{$storyImage->image_type}}</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
					@if($storyImage->is_active != 0)
						<div class="media">
  						<div class="media-left">
	      				<img class="media-object" src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' .
								$storyImage->image_extension . '?'. 'time='. time() }}" alt="{{$storyImage->image_name}}">
							</div>
						@endif
  					<div class="media-body">
							<div class="form-group">


							<div class="form-inline">
										<div class="form-group">
										 {!! Form::label('image_type', 'Image Type:') !!}
										 {!! Form::text('image_type', $storyImage->image_type, ['class' => 'form-control input-sm', 'readonly' => 'readonly']) !!}
										</div>
								<div class="form-group">
									{!! Form::label('image_name', 'Name:') !!}
									{!! Form::text('image_name', null, ['class' => 'form-control input-sm', 'readonly' => 'readonly']) !!}
								</div>

							</div>
							</div>

							<div class="form-group">
								{!! Form::file('image', null, array('required', 'class'=>'form-control input-sm')) !!}
							</div>
							<div class="form-inline">
								{!! Form::label('moretext') !!}
								{!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
							</div>
						</div> <!-- /.media-body -->
							<div class="form-group">
								{!! Form::label('caption') !!}
								{!! Form::text('caption', null, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('teaser') !!}
								{!! Form::textarea('teaser', null, ['class' => 'form-control teaser']) !!}
							</div>



					</div><!-- /.box-body -->
        	<div class="box-footer">
						<div class="form-inline">
							<div class="form-group">
							{!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
							{!! Form::close() !!}
						</div>

						@if($storyImage->image_type == 'imagehero')
							 <div class="form-group">
				       {!! Form::model($storyImage, ['route' => ['admin.storyimages.destroy', $storyImage->id],
				       'method' => 'DELETE',
				       'class' => 'form',
				       'files' => true]
				       ) !!}
							 {!! Form::submit('Delete Image', array('class'=>'btn btn-warning', 'Onclick' => 'return ConfirmDelete();')) !!}
				       {!! Form::close() !!}
							  </div>
				    @endif
						</div>
        </div><!-- /.box-footer-->
      </div><!-- /.box-body -->
		</div> <!-- /.box -->

@section('footer')
    @parent
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection
