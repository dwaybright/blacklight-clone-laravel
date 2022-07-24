<?php

use Solarium\QueryType\Select\Result\Result;

class FacetSelectResult
{
    public array $facets;

    public function __construct(Result $solrResult)
    {
        // use the active core
        $activeCore = config('solrEndpoints.active');

        // list facet returns and counts
        $this->facets = [];
        foreach(config("solrEndpoints.{$activeCore}.facetFields") as $facetField) {
            array_push($this->facets, $solrResult->getFacetSet()->getFacet($facetField));
        }
    }
}
