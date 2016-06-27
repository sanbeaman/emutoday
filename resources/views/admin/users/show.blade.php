@extends('admin.layouts.adminlte')
@section('content')
	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">{{$user->last_name}}</span>
    <ul>
			@foreach ($userRoles as $userRole)
				<li>
					{{$userRole->name}}
				</li>

			@endforeach

		</ul>
  </div><!-- /.info-box-content -->
</div><!-- /.info-box -->
    {!! Form::model($user,[
        'method' => $user->exists ? 'put' : 'post',
        'route' => $user->exists ? ['admin.users.update', $user->id] : ['admin.users.store']
    ]) !!}

    <div class="form-group">
        {!! Form::label('last_name') !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
		<div class="form-group">
				{!! Form::label('first_name') !!}
				{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
				{!! Form::label('phone') !!}
				{!! Form::text('phone', null, ['class' => 'form-control']) !!}
		</div>
    <div class="form-group">
       {!! Form::label('email') !!}
       {!! Form::text('email', null, ['class' => 'form-control']) !!}
   </div>

   <div class="form-group">
       {!! Form::label('password') !!}
       {!! Form::password('password', ['class' => 'form-control']) !!}
   </div>

   <div class="form-group">
       {!! Form::label('password_confirmation') !!}
       {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
   </div>

	 <div class="input-group">


		@can('super', $user)
			{!! Form::label('role_list', 'Roles:') !!}
			 {!! Form::select('role_list[]',$userRoles, $user->roles->lists('id')->toArray() , ['class' => 'form-control', 'multiple']) !!}
		 @else
			 @if($user->exists)
			 {!! Form::label('role_list', 'Roles:') !!}
			 {!! Form::text('role_list', $user->roles->lists('name') , ['class' => 'form-control','readonly' => 'readonly']) !!}
		 @endif
		 @endcan

	 </div>
   {!! Form::submit($user->exists ? 'Save User' : 'Create New User', ['class' => 'button']) !!}

   {!! Form::close() !!}
@endsection
