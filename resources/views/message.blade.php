@if(flash()->message)
    <div class="{{ flash()->class }}">
        @if (is_array(flash()->message))
            <ul>
                @foreach (flash()->message as $msg)
                    <li>{!! $msg !!}</li>
                @endforeach
            </ul>
        @else
            {!! flash()->message !!}
        @endif
    </div>
@endif
