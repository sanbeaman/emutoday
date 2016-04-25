<div class="featured-content-block">
    <h6 class="headline-block lt-green">{!! $sidetitle !!}</h6>
    <ul class="feature-list">

    <a href="#"><img src="{{$sideitems->first()->grabStoryImageByType('imagesmall')->mainImageURL()}}" /></a>
    <ul class="feature-list">
    @foreach($sideitems as $sideitem)
        <li><a href="/{{$sideitem->story_type}}/{{$sideitem->id}}">{{ $sideitem->grabStoryImageByType('imagesmall')->caption }}</a></li>
    @endforeach
    </ul>
</div>
