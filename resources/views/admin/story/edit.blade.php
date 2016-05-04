@inject('storytypes', 'emutoday\Http\Utilities\StoryTypes')
@extends('admin.layouts.master')

@section('title', 'Editing '.$story->title)
    @section('scripthead')
        @parent
      <script src="{{ theme('js/ckeditor/ckeditor.js') }}"></script>
  @endsection
@section('content')
    <div class="row">
      <div class="medium-6 columns">
        <div class="row column">
          {!! Form::model($story, [
            'method' => 'put',
            'route' => ['admin.story.update', $story->id]
          ])
          !!}
          <div class="input-group">
            {!! Form::label('title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
          </div>
          <div class="input-group">
            {!! Form::label('slug') !!}
            {!! Form::text('slug', null, ['class' => 'form-control']) !!}
          </div>
          <div class="input-group">
            {!! Form::label('subtitle') !!}
            {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
          </div>
          <div class="input-group teaser">
            {!! Form::label('teaser') !!}
            {!! Form::textarea('teaser', null, ['class' => 'form-control']) !!}
          </div>
          @if($story->story_type == 'storyexternal')

          <div class="input-group">
              {!! Form::label('external_link') !!}
              {!! Form::text('external_link', null, ['class' => 'form-control']) !!}
          </div>
        @else
          <div class="input-group">
              {!! Form::label('content') !!}
              {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
          </div>
        @endif
        <div class="input-group">
            {!! Form::label('tag_list', 'Tags:') !!}
            {!! Form::select('tag_list[]',$tags, $story->tags->lists('id')->toArray() , ['class' => 'form-control', 'multiple']) !!}
        </div>
          <div class="input-group">
            <div class="small-3 column">
              {!! Form::label('start_date') !!}
              {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
            </div>
            <div class="small-3 column">
              {!! Form::label('end_date') !!}
              {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
            </div>
            <div class="small-3 column">
              {!! Form::label('story_type','Story Type') !!}
              {!! Form::text('story_type', $story->story_type, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
            </div>
              <div class="small-3 column">
                  {!! Form::submit($story->exists ? 'Save Story' : 'Create New Story', ['class' => 'button']) !!}
              </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      <div class="medium-6 columns">

            <!--     add image asset -->
            @if ($story->storyImages()->count() < 3)
              <form action="addimage" method="POST">
                  {{ csrf_field() }}
                <button class="hollow button" href="#">Add Image</button>

              </form>


          @endif

            @each('admin.story.subviews.storyimage', $story->storyImages, 'storyImage')

            <!-- list all image assets -->


            </div>
    </div>
@endsection
@section('footer')
    @parent
      <script src="{{ theme('js/ckeditor/ckeditor.js') }}"></script>
    <script>

                            CKEDITOR.replace('teaser',
                            {
                                toolbarGroups: [
                                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                                    { name: 'links', groups: [ 'links' ] },
                                    { name: 'insert', groups: [ 'insert' ] },
                                    { name: 'forms', groups: [ 'forms' ] },
                                    { name: 'tools', groups: [ 'tools' ] },
                                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                                    { name: 'others', groups: [ 'others' ] },
                                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                                    { name: 'styles', groups: [ 'styles' ] },
                                    { name: 'colors', groups: [ 'colors' ] },
                                    { name: 'about', groups: [ 'about' ] }
                                ],
                                removeButtons: 'Underline,Subscript,Superscript,Cut,Undo,Redo,Copy,Paste,PasteText,PasteFromWord,Scayt,Link,Unlink,Anchor,Image,Table,SpecialChar,Maximize,Source,NumberedList,BulletedList,Indent,Outdent,Blockquote,About',
                                height : 50,
                                toolbar : 'simple'
                            })
                            if (JSvars.storytype != 'storyexternal'){
                                CKEDITOR.replace('content');
                            }





                            $('input[name=title]').on('blur', function () {
                                var slugElement = $('input[name=slug]');

                                if (slugElement.val()) {
                                    return;
                                }

                                slugElement.val(this.value.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, ''));
                            });

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
                <!-- add additional script to bottom of body like js/main.js
                or add Jquery or similiar calls from inside script tags
                //$('#flash-overlay-modal').foundation('open'); //will open a Reveal modal with id `reveal`.
@endsection
