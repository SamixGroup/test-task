<ul>
    @foreach($items as $key=>$value)
        @if ($value instanceof stdClass || is_array($value))
            <li class="collapsable" onclick="setDisplay()"><i class="bi bi-caret-right-fill"></i> {{ $key }} : {{gettype($value)}}
                <div class="hide">
                    @include('items.item', array('items'=>$value))
                </div>
            </li>
        @else
            <li>{{$key}} : {{print_r($value)}} : {{gettype($value)}}</li>
        @endif
    @endforeach
</ul>


