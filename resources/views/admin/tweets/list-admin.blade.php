{{-- list-admin.blade.php --}}
<form action="/approve-tweets" method="post">
{{ csrf_field() }}

@foreach($tweets as $tweet)
    <div class="tweet row">
        <div class="small-8 columns">
            @include('admin.tweets.tweet')
        </div>
        <div class="small-4 columns approval">
            <label class="radio-inline">
                <input
                    type="radio"
                    name="approval-status-{{ $tweet->id }}"
                    value="1"
                    @if($tweet->approved)
                    checked="checked"
                    @endif
                    >
                Approved
            </label>
            <label class="radio-inline">
                <input
                    type="radio"
                    name="approval-status-{{ $tweet->id }}"
                    value="0"
                    @unless($tweet->approved)
                    checked="checked"
                    @endif
                    >
                Unapproved
            </label>
        </div>
    </div>
@endforeach

<div class="row">
    <div class="small-12 column">
        <input type="submit" class="button primary float-right" value="Approve Tweets">
    </div>
</div>

</form>

{!! $tweets->links() !!}
