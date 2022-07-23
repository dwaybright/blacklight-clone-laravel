<?php

namespace App\View\Components\Blacklight;

use Illuminate\View\Component;
use Solarium\QueryType\Select\Result\Result;

class FacetWidget extends Component
{
    public string $baseQuery;
    public array $selectedFacets = [];
    public array $facetResults = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selectedFacets, $baseQuery, $solrResult)
    {
        // track selected facets
        $this->selectedFacets = $selectedFacets;

        // expose the base query
        $this->baseQuery = $baseQuery;

        // use the active core
        $activeCore = config('solrEndpoints.active');

        // list facet returns and counts
        foreach(config("solrEndpoints.{$activeCore}.facetFields") as $facetField) {
            // pull result for this facet
            $facetResults = $solrResult->getFacetSet()->getFacet($facetField);

            // keep value/count for facet (if exist)
            if(count($facetResults) > 0) {
                $this->facetResults[$facetField] = $facetResults;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blacklight.facet-widget');
    }
}
