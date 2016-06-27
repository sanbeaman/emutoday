@if (session()->has('flash_notification.message'))
    @if (session()->has('flash_notification.overlay'))
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => session('flash_notification.title'),
            'body'       => session('flash_notification.message')
        ])

    @else
        <div class="callout callout-{{ session('flash_notification.level') }} callout-dismissible" data-closable>
					<button type="button" class="close" data-dismiss="callout" aria-hidden="true">×</button>
					{!! session('flash_notification.message') !!}
        </div>
    @endif
@endif
