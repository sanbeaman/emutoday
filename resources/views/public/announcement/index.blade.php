{{-- announcement --}}
@extends('public.layouts.global')
@section('content')
  <div id="content-area">
    <div id="listing-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 column">
          <div id="title-grouping" class="row">
            <div class="large-5 medium-7 small-12 columns  noleftpadding"><h3 class="news-caps">Announcements <a class="smaller-title" href="">[ RSS feed ]</a></h3></div>
            <div class="large-7 medium-5 small-12 columns noleftpadding"><h6>{!! $announcements->links() !!}</h6></div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 column">

              <ul class="accordion" data-accordion data-allow-all-closed="true">
                @foreach($announcements as $announcement)
                  <li class="accordion-item" id="accitem-{{$announcement->id}}" data-accordion-item>
                  {{-- <li class="accordion-item" data-accordion-item> --}}
                    <a href="#" class="accordion-title">{{$announcement->title}}</a>
                    <div class="accordion-content" data-tab-content>
                      {!! $announcement->announcement !!}
                      {{$announcement->start_date}}
                    </div>
                  </li>
                @endforeach
              </ul>
              <div id="base-grouping" class="row">
                <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
                <div class="large-7 medium-5 small-12 columns"><h6>{!! $announcements->links() !!}</h6>                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>   <!--end content area-->
@endsection
