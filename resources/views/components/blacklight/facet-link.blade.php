<li>
    @if($selected)
    <span style="color: green;">
        {{ $value }}
        <a rel="nofollow" href="{{ str_replace(str_replace(' ', '%20', "&f[{$field}][]={$value}"), '', $baseQuery) }}"> X</a>
    </span>
    <span>| {{ $count }}</span>
    @else
    <span>
        <a rel="nofollow" href="{{$baseQuery}}&f[{{ $field }}][]={{ $value }}">{{ $value }}</a>
    </span>
    <span>| {{ $count }}</span>
    @endif
</li>
