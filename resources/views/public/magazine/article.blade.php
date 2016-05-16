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
                  <div class="addthis magazine-top"><a href=""><img src="/themes/default/assets/imgs/icons/fake-addthis.png" alt="addthis "></a></div>
                </div>
              </div>
              <div id="big-feature-image">
                  <img src="{{$mainImage->present()->mainImageURL}}" alt="feature-image">
              </div>
              <div class="magazine-titlebar"><img src="/themes/default/assets/imgs/graphic-title.png" alt="Lost Voices"></div>
              {!! $story->content !!}
              <div class="story-author">Author's name</div>
              <p class="news-contacts">Contact Author, author@emich.edu, 734.487.XXXX</p>
            </div>
            <div class="large-3 medium-4 small-12 columns featurepadding">

              <div class="featured-content-block magazine-block">
                <h6 class="headline-block">Popular stories</h6>
                <ul class="feature-list">
                    @foreach ($sideStoryBlurbs as $ssblurb)
                  <li><a href="/emu-today/{{$ssblurb->story->story_folder}}/{{$ssblurb->story->id}}">{{$ssblurb->caption}}</a></li>
                @endforeach

                </ul>

              </div>
              <div class="featured-content-block magazine-block">
                <h6 class="headline-block">Headlines</h6>
                <ul class="feature-list">
                  @foreach ($sideNewsStorys as $newsstory)
                <li><a href="/emu-today/{{$newsstory->story_folder}}/{{$newsstory->id}}">{{$newsstory->title}}</a></li>
                @endforeach
                </ul>

              </div>
              <a class="button magazine-button expand">Subscribe</a>
              <a class="button magazine-button expand">Submit a Story Idea</a>


            </div>


          </div>
        </div>

      </div>
    </div>

  </div>   <!--end content area-->
@endsection
