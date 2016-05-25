@extends('admin.layouts.master')

@section('title', 'Twitter Admin')

@section('content')

  <div class="large-6 medium-6 small-12 columns">
    <h5>Admin List of Tweets</h5>
  @include('admin.twitter.list-admin')
  </div>
<!--Twitter-->
    <div id="twitter-info" class="large-6 medium-6 small-12 columns">
        <div class="row">
             <div class="large-12 medium-12 small-12 columns">
             <h5 class="subhead-title">Twitter</h5>
             </div>
         </div>
         <div class="twitter-feed">
           <ul class="twitter-content">
                 @foreach($tweets as $tweet)
                   <li><a href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}">{{ '@' . $tweet->user_screen_name }}</a> {{ $tweet->tweet_text }}</li>
                 @endforeach
             </ul>
             <div class="twitterlink">
                 <p><a href="http://emich.edu/twitter">See all EMU Twitter Feeds</a></p>

             </div>
        </div>
    </div>
@endsection
