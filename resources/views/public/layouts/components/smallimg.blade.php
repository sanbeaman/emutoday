<div class="column">
  <img class="topic-image" src="{{$barImg->present()->mainImageURL}}" alt="story image">
  <div class="stories-content">
    <div class="stories-text-content" data-equalizer-watch="" style="height: 66px;">
      <p>{{$barImg->caption}}</p>
    </div>
    <p class="button-group">
      <a href="storytype/{{$barImg->story->story_type}}/{{$barImg->story->id}}" class="button">{{$barImg->moretext}}<i class="fi-play"></i></a>
    </p>
  </div>
</div>
