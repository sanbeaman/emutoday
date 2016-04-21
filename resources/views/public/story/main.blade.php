<!-- Main Story Page -->
@extends('public.layouts.master')
@section('content')
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <!-- Story Page Title group -->
        <div id="title-grouping" class="row">
          <div class="large-5 medium-4 small-6 columns noleftpadding">
            <h3 class="news-caps">{{$story->storyType}}</h3>
          </div>
          <div class="large-2 medium-4 small-6 columns noleftpadding">
            <p class="story-publish-date"><a href="">{{ $story->published_start }}</a></p>
          </div>
          <div class="large-5 medium-4 hide-for-small columns noleftpadding">
            <p class="small-return-news"><a href="#">News Home</a></p>
          </div>
        </div>
        <!-- Story Page Content -->
        <div id="story-content" class="row">
          <!-- Story Content Column -->
          <div class="large-9 medium-8 small-12 columns noleftpadding">
            <div class="addthis"></div>
            <h3>{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
            <div id="big-feature-image">
              <img src="{{$story->grabStoryImageByType('imagemain')->mainImageURL() }}" alt="feature-image"></a>

              <div class="feature-image-caption">{{ $story->grabStoryImageByType('imagemain')->caption }}</div>
            </div>
            <div id="story-content-edit">
              {!! $story->content !!}
            </div>
            <div class="story-author">{{ $story->author->name }}</div>
            <p class="news-contacts">Contact {{ $story->author->email }}</p>
          </div>
          <!-- Page Side Bar Column -->
          <div class="large-3 medium-4 small-12 columns featurepadding">
            @include('public.story.sideblock', ['sidetitle' => 'Featured Stories', 'sideitems' => $sideStorysFeatured])
            @include('public.story.sideblock', ['sidetitle' => "<span class='truemu'>EMU</span> student profiles", 'sideitems' => $sideStorysStudent])

          </div>


        </div>
      </div>

    </div>
  </div>

@endsection

@section('footer')
  @parent

  @endsection
