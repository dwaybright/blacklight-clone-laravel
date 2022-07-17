<?php

namespace App\View\Components\Blacklight;

use Illuminate\View\Component;

class FacetBox extends Component
{
    public string $header;
    public array $values;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($values)
    {
        $this->values = $values;
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
