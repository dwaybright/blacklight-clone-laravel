<?php

namespace App\View\Components\Blacklight;

use Illuminate\View\Component;
use Solarium\Component\Result\Facet\Field;

class FacetBox extends Component
{
    public string $facetField;
    public bool $containsSelectedFacets;
    public array $selectedFacetLinks = [];
    public Field $facetResult;
    public string $baseQuery;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($facetField, $selectedFacets, $facetResult, $baseQuery)
    {
        $this->facetField = $facetField;
        $this->baseQuery = $baseQuery;
        $this->facetResult = $facetResult;

        $this->containsSelectedFacets = array_key_exists($facetField, $selectedFacets);

        if($this->containsSelectedFacets) {
            foreach($selectedFacets[$facetField] as $facetValue) {
                array_push($this->selectedFacetLinks, $facetValue);
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
        return view('components.blacklight.facet-box');
    }
}
