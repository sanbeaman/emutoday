@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
        <div class="medium-6 columns">
          <h4>Admin List of Tweets</h4>
        @include('admin.tweets.list-admin')
        </div>
        <div class="medium-6 columns">
          <h2>Public tweets</h2>
        
        </div>
@endsection
