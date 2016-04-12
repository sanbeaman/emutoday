@extends('layouts.masters')

@section('content')
  <div id="content-area">
    <div id="four-stories-bar">
      <div id="news-title-bar" class="row">
        <div class="large-12 medium-12 small-12 columns manageleftpadding">
          <h5 class="subhead-title">Featured News Stories</h5>
        </div>
      </div>
      <div class="row row small-up-1 medium-up-2 large-up-4" data-equalizer="">
        <div class="column">
          <img class="topic-image" src="{{$story->grabStoryImageByType('imagesmall')->mainImageURL() }}" alt="story image">
          <div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
              <p>{{ $story->grabStoryImageByType('imagesmall')->teaser }}</p>
            </div>
            <p class="button-group"><a href="#" class="button">{{ $story->grabStoryImageByType('imagesmall')->moretext }}<i class="fi-play"></i></a></p>
          </div>
        </div>
        <div class="column">
          <img class="topic-image" src="{{$story->grabStoryImageByType('imagesmall')->mainImageURL() }}" alt="story image">
          <div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
              <p>{{ $story->grabStoryImageByType('imagesmall')->teaser }}</p>
            </div>
            <p class="button-group"><a href="#" class="button">{{ $story->grabStoryImageByType('imagesmall')->moretext }}<i class="fi-play"></i></a></p>
          </div>
        </div>
        <div class="column">
          <img class="topic-image" src="{{$story->grabStoryImageByType('imagesmall')->mainImageURL() }}" alt="story image">
          <div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
              <p>{{ $story->grabStoryImageByType('imagesmall')->teaser }}</p>
            </div>
            <p class="button-group"><a href="#" class="button">{{ $story->grabStoryImageByType('imagesmall')->moretext }}<i class="fi-play"></i></a></p>
          </div>
        </div>
        <div class="column">
          <img class="topic-image" src="{{$story->grabStoryImageByType('imagesmall')->mainImageURL() }}" alt="story image">
          <div class="stories-content">
            <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
              <p>{{ $story->grabStoryImageByType('imagesmall')->teaser }}</p>
            </div>
            <p class="button-group"><a href="#" class="button">{{ $story->grabStoryImageByType('imagesmall')->moretext }}<i class="fi-play"></i></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
