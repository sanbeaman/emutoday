@extends('admin.layouts.master')

@section('title', $user->exists ? 'Editing '.$user->name : 'Create New User')

@section('content')
    {!! Form::model($user,[
        'method' => $user->exists ? 'put' : 'post',
        'route' => $user->exists ? ['admin.users.update', $user->id] : ['admin.users.store']
    ]) !!}

    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
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

			 {!! Form::label('role_list', 'Roles:') !!}
		@can('super', $user)
			 {!! Form::select('role_list[]',$userRoles, $user->roles->lists('id')->toArray() , ['class' => 'form-control', 'multiple']) !!}
		 @else
			 {!! Form::select('role_list[]',$userRoles, $user->roles->lists('id')->toArray() , ['class' => 'form-control', 'multiple','readonly' => 'readonly']) !!}
		 @endcan

	 </div>
   {!! Form::submit($user->exists ? 'Save User' : 'Create New User', ['class' => 'button']) !!}

   {!! Form::close() !!}
@endsection
