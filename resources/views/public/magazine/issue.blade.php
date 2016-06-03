{{-- Magazine Index Page --}}
@extends('public.layouts.global')
@section('offcanvaslist')
	@include('public.magazine.partials.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('public.magazine.partials.connectionbar')
  @endsection
@section('content')
  <div id="content-area">
    <div id="news-story-bar" class="magazine-story">

          <div id="story-content" class="row">
            <div class="large-9 medium-8 small-12 columns">
              <div id="issue-grouping" class="row">
                <div class="large-8 medium-8 small-12 columns">
									<h2 class="issue-date news-caps">{{$magazine->season}} {{$magazine->year}}</h2></div>
                <div class="large-4 medium-4 small-12 columns">
                  <div class="addthis magazine-top"><a href="#"><img src="/assets/imgs/icons/fake-addthis.png" alt="addthis "></a></div>
                </div>
              </div> <!-- issue-grouping -->
              <div id="story-listing" class="row column">
								  @foreach ($barImgs as $barImg)
										<a class="magazine-article-button" href="/emu-today/magazine/article/{{$barImg->story->id}}">
										<div class="media-object row">
											<div class="media-object-section small-12 medium-5 large-3 columns">
												<div class="thumbnail">
													<img src= "{{$barImg->present()->mainImageURL}}">
												</div>
											</div>
											<div class="media-object-section main-section small-12 medium-7 large-9 columns">
											<h3>{{$barImg->caption}}</h3>
										  <p>{{$barImg->teaser}}</p>
										</div>
										</div>
									</a>
									@endforeach
              </div> <!-- story-listing -->
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

    </div> <!-- news-story-bar -->

  </div>   <!--end content area-->
@endsection
