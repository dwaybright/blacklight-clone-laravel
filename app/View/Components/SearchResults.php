<?php

namespace App\View\Components;

use Illuminate\View\Component;
use \Solarium\QueryType\Select\Result\Result;

class SearchResults extends Component
{
    public Result $solrResult;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Result $solrResult)
    {
        $this->solrResult = $solrResult;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blacklight.search-results');
    }
}
