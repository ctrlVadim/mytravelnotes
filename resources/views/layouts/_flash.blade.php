<div class="flash-message position-absolute w-100">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has($msg))
            <p style="display: none" class="alert alert-{{ $msg }}">
                {{ Session::get($msg) }}
            </p>
        @endif
    @endforeach
</div>
