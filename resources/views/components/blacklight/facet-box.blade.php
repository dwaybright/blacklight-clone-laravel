<div class="accordion mb-2" id="accordion_{{ $facetField }}">
    <div class="card">
        <div class="card-header" id="heading_{{ $facetField }}">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_{{ $facetField }}" aria-expanded="true" aria-controls="collapse_{{ $facetField }}">
                    {{ $facetField }}
                </button>
            </h2>
        </div>

        <div id="collapse_{{ $facetField }}" class="collapse @if($containsSelectedFacets) show @endif" aria-labelledby="heading_{{ $facetField }}" data-parent="#accordion_{{ $facetField }}">
            <div class="card-body">
                <ui>
                    @foreach($facetResult as $value => $count)
                    @if($count > 0)
                    <x-blacklight.facet-link :field="$facetField" :selected="in_array($value, $selectedFacetLinks)" :value="$value" :count="$count" :baseQuery="$baseQuery" />
                    @endif
                    @endforeach
                </ui>
            </div>
        </div>
    </div>
</div>
