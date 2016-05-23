@foreach($tweets as $tweet)
    <div class="tweet">
        @include('admin.tweets.tweet')
    </div>
@endforeach
