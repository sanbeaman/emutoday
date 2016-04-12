
<div class="imgform callout small">
<div class="row">
   {!! Form::model($storyImage,[
      'method' => 'patch',
      'route' => ['admin.storyimages.update', $storyImage->id],
      'files' => true
   ]) !!}
   {{$storyImage->image_type}}

@if($storyImage->is_active != 0)
   <div class="small-3 column">
      <img class="float-center" src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' .
$storyImage->image_extension . '?'. 'time='. time() }}">
   </div>
   <div class="small-9 column">
@else
   <div class="small-12 column">
@endif
   <div class="input-group">
{!! Form::label('image name', 'Image name:') !!}
{!! Form::text('image_name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
   </div>
   <!-- form field for file -->
   <div class="input-group">
   {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
   </div>
</div>
   </div>

   <div class="row column">
      <!-- form field for caption -->
      <div class="input-group caption">
      {!! Form::label('caption') !!}
      {!! Form::text('caption', null, ['class' => 'form-control']) !!}
      </div>
      <!-- form field for caption -->
      <div class="input-group teaser">
      {!! Form::label('teaser') !!}
      {!! Form::textarea('teaser', null, ['class' => 'form-control teaser']) !!}
      </div>
   </div>
<div class="row">
   <div class="small-6 columns">
      <!-- form field for moretext -->
      <div class="input-group moretext">
      {!! Form::label('moretext') !!}
      {!! Form::text('moretext', null, ['class' => 'form-control']) !!}
      </div>
   </div>
   <div class="small-6 columns">
      <div class="input-group">
       {!! Form::label('image_type', 'Image Type') !!}
       {!! Form::text('image_type', $storyImage->image_type, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
      </div>
   </div>
</div>
<div class="input-group">
   {!! Form::submit('Upload Photo', array('class'=>'button')) !!}


   </div>



   {!! Form::close() !!}

   @if($storyImage->image_type == 'imagehero')
      {!! Form::model($storyImage, ['route' => ['admin.storyimages.destroy', $storyImage->id],
      'method' => 'DELETE',
      'class' => 'form',
      'files' => true]
      ) !!}

      <div class="form-group">

           {!! Form::submit('Delete Image', array('class'=>'button alert', 'Onclick' => 'return ConfirmDelete();')) !!}

      </div>

      {!! Form::close() !!}
   @endif
   

</div>

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
