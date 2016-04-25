@extends('admin.layouts.master')

@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
@section('scripthead')
    @parent
  <script src="{{ theme('js/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('content')
    {!! Form::model($announcement, [
        'method' => $announcement->exists ? 'put' : 'post',
        'route' => $announcement->exists ? ['admin.announcement.update', $announcement->id] : ['admin.announcement.store']
    ]) !!}
    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('announcement') !!}
        {!! Form::textarea('announcement', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group row">
      <div class="medium-2 columns">
          {!! Form::label('start_date') !!}
          {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
      </div>
      <div class="medium-2 columns">
          {!! Form::label('end_date') !!}
          {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="form-group row">
      <div class="medium-2 columns">
          {!! Form::label('is_approved') !!}
          {!! Form::radio('is_approved', null, ['class' => 'form-control']) !!}
      </div>
      <div class="medium-2 columns">
          {!! Form::label('is_promoted') !!}
          {!! Form::radio('is_promoted', null, ['class' => 'form-control']) !!}
      </div>
    </div>

    {!! Form::submit($announcement->exists ? 'Save Announcement' : 'Create New Announcement', ['class' => 'button']) !!}

    {!! Form::close() !!}
@endsection
@section('footer')
    @parent
      <script src="{{ theme('js/ckeditor/ckeditor.js') }}"></script>
    <script>

                            CKEDITOR.replace('announcement',
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
