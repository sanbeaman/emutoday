@extends('public.layouts.global')
@section('content')
  <div id="content-area">
      <div id="listing-bar">
          <div class="row">
              <div class="large-12 medium-12 small-12 columns">
                   <div id="title" class="row">
                       <div class="large-12 medium-12 small-12 columns  noleftpadding"><h3 class="news-caps"><span class="truemu">EMU</span> Student Profiles</h3></div>

                   </div>
               </div>
          </div>
      </div>
      <div id="homepage-hero" class="row">
          <div id="profile-text-over-image-box"><p>{{$heroImg->caption}}</p>
          <p><a href="student/{{$heroImg->story->id}}">{{$heroImg->moretext}}</a></p></div>
          <img src="{{$heroImg->present()->mainImageURL }}" alt="main image"/>
      </div>
          <div id="profiles-list" >
              <div class="row managehorizontalpadding">
                  <div class="large-10 medium-10 small-10 columns noleftpadding"><h4>Recent Profiles</h4></div>
                  <div class="large-2 medium-2 small-2 columns nohorizontalpadding control-arrows"><a href=""><i class="fi-arrow-left"></i></a><a href=""><i class="fi-arrow-right"></i></a></div>
              </div>
               <div class="row managehorizontalpadding" >
                <div class="row small-up-2 medium-up-3 large-up-5 noleftpadding">
                  @each('public.student.partials.box', $barImgs, 'barImg')
                </div>
                </div>
              <div id="student-feature">
                   <div class="row">
                       <div class="large-7 medium-12 hide-for-small columns noleftpadding managehorizontalpadding"><img src="/themes/default/assets/imgs/student/profiles-feature.jpg"  alt="feature student image"/></div>
                       <div class="large-5 medium-12 small-12 columns managehorizontalpadding">
                           <h4 class="green">Do you know a student who could be featured in student profiles?</h4>
                           <p>Nam sitas autectatem aut volupta spellestio. Adistiore liquis nis reiurer itatur, et fugiam, ute cone labo. Dam restrum faccusa essite maximus, ut exceprae audant erum fuga. </p>
                           <p><a class="button large emu-button">Suggest a Student</a></p>
                       </div>

                  </div>
               </div>
              </div><!--end of profiles-list-->

   </div>   <!--end content area-->
@endsection
