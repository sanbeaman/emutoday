@extends('admin.layouts.master')

@section('title', 'Delete Page')

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin.pages.destroy', $page->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete the Page. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this record!', ['class' => 'button alert']) !!}

        <a href="{{ route('admin.pages.index') }}" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
