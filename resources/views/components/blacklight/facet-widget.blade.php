<div>
    @foreach($facetResults as $facetField => $facetResult)
        <x-blacklight.facet-box :selectedFacets="$selectedFacets" :facetField="$facetField" :facetResult="$facetResult" :baseQuery="$baseQuery" />
    @endforeach
</div>
