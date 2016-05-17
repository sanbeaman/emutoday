{{-- Magazine Index Page --}}
@extends('public.layouts.global')
@section('offcanvaslist')
  <ul class="off-canvas-list"><!-- include($_SERVER['DOCUMENT_ROOT'].'/emu-today/admin/php/top_nav.php'); -->
      <li><a href="#">Current Issue</a></li>
      <li><a href="#">Past Issues</a></li>
      <li><a href="#">Alumni</a></li>
      <li><a href="#">EMU Today</a></li>
  </ul>
  <ul class="off-canvas-list alt"><!-- include($_SERVER['DOCUMENT_ROOT'].'/emu-today/admin/php/secondary_nav.php'); -->
    <li><a href="#">Subscribe to Eastern Magazine</a></li>
    <li><a href="#">Submit a Story idea</a></li>
  </ul>
@endsection
  @section('connectionbar')
    @include('public.magazine.partials.connectionbar')
  @endsection
@section('content')
  <div id="content-area">
    <div id="news-story-bar" class="magazine-story">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <div id="story-content" class="row">
            <div class="large-9 medium-8 small-12 columns noleftpadding">
              <div id="issue-grouping" class="row">
                <div class="large-8 medium-8 small-12 columns noleftpadding"><h2 class="issue-date news-caps">{{$magazine->season}} {{$magazine->year}}</h2></div>
                <div class="large-4 medium-4 small-12 columns noleftpadding">
                  <div class="addthis magazine-top"><a href="#"><img src="/assets/imgs/icons/fake-addthis.png" alt="addthis "></a></div>
                </div>
              </div>

              <div id="story-listing" class="row">
                <ul>
                  @foreach ($barImgs as $barImg)
                  <li class="clearfix">
                    <a class="magazine-article-button" href="/emu-today/magazine/article/{{$barImg->story->id}}">
                    <div class="small-12 medium-5 large-3 columns nohorizontalpadding"><img src="{{$barImg->present()->mainImageURL}}"></div>
                    <div class="small-12 medium-7 large-9 columns story-text-teaser">
                        <h3>{{$barImg->caption}}</h3>
                          <p>{{$barImg->teaser}}</p>
                    </div>
                    </a>
                  </li>
                    @endforeach
                </ul>

              </div>
            </div>
            <div class="large-3 medium-4 small-12 columns current-issue-padding">
              <div class="current-issue-info">
                <p><img src="/assets/imgs/magazine/magazine-cover-winter2016.jpg"></p>
                <p><a href="">Read the Digital Issue</a></p>
              </div>

              <a class="expanded button magazine-button">Subscribe</a>
              <a class="expanded button magazine-button">Submit a Story Idea</a>


            </div>


          </div>
        </div>

      </div>
    </div>

  </div>   <!--end content area-->
@endsection
