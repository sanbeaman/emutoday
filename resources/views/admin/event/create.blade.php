@extends('admin.layouts.master')

@section('title', $event->exists ? 'Editing '.$event->title : 'Create New Event')
  @section('scripthead')
  @endsection
@section('content')
  {!! csrf_field() !!}
  <div id="vueapp">
    <eventform></eventform>
  </div>


  @endsection
  @section('footer')
    @parent
@endsection
