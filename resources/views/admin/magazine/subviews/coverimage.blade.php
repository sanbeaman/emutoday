<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-head-info pull-left">
            @if($mediafile->filename)
            <img class="better-thumb" src="/imagecache/betterthumb/{{$mediafile->media_name}}" alt="{{$mediafile->name}}">
        @endif
          <h3 class="box-title">{{$mediafile->mediatype->name}}</h3>
        </div><!-- /.box-head-info -->
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">

        {!! Form::model($mediafile, [
            'method' => 'put',
            'route' => ['update_magazine_cover', $mediafile->id],
            'files' => true
            ]) !!}
            <div class="form-group">
                    {!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
                    <span class="help-block">{{$mediafile->mediatype->helptxt}}</span>
                </div>
                <div class="form-group">
                    {!! Form::label('headline') !!}
                    {!! Form::text('headline', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('caption') !!}
                    {!! Form::text('caption', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('teaser') !!}
                    {!! Form::textarea('teaser', null, ['class' => 'form-control', 'class'=>'ckeditor']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('link') !!}
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('link_text') !!}
                    {!! Form::text('link_text', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('note') !!}
                    {!! Form::text('note', null, ['class' => 'form-control']) !!}
                </div>
                    </div> <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            {!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
                        </div>
                        {{ csrf_field() }}
                        {!! Form::close() !!}
                    </div><!-- /.box-footer -->
    </div> <!-- /.box -->
