@foreach($solrResult as $document)
<div class="mb-2 p-3" style="border-style: solid;">
    <container-fluid>
        @foreach($document as $field => $value)
        @if(in_array($field, config('solrEndpoints.testing.searchResultFields')))
        <div class="row">
            <div class="col-4">
                <span>{{ $field }}</span>
            </div>
            <div class="col-8">
                <span>{{ $value }}</span>
            </div>
        </div>
        @endif
        @endforeach
    </container-fluid>
</div>
@endforeach
