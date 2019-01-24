@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-flash alert-dismissable
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif
            @if($message['level'] == 'success')
            <i class="fas fa-lg fa-check-circle text-success"></i> {!! $message['message'] !!}
            @elseif($message['level'] == 'danger')
            <i class="fas fa-lg fa-times-circle text-danger"></i> {!! $message['message'] !!}
             @elseif($message['level'] == 'warning')
            <i class="fas fa-lg fa-exclamation-triangle text-warning"></i> {!! $message['message'] !!}
            @else
            <i class="fas fa-lg fa-info-circle text-primary"></i> {!! $message['message'] !!}
            @endif
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
