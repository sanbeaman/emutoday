<div class="panel panel-default">
  <div class="panel-body row">
		<div class="col-md-2">
			{{$item->submission_date}}
		</div><!-- /.col-md-2 -->
		<div class="col-md-5">
			<p>{{$item-title}}</p>
			<p>{{$item-announcement}}</p>
		</div><!-- /.col-md-6 -->
  <div class="col-md-2">
  <p>from :{{$item->start_date}} - {{$item->end_date}}</p>
  </div><!-- /.col-md-3 -->
	<div class="col-md-3">
		<form method="POST"
      action="/admin/annocement/{{$item->id}}"
      v-ajax complete="Okay, the post has been deleted."
  >
    {{ csrf_field() }}
		{!! Form::checkbox('is_approved', 1, true , ['']) !!}
		var checkicon = (data == 1)?'check-square-o' :'square-o';
		return "<i class='fa fa-"+checkicon+"'></i>"
    <button type="submit">Delete Post</button>
</form>
	</div><!-- /.col-md-3 -->
  </div>
</div>
