<?php

namespace App\View\Components\Blacklight;

use Illuminate\View\Component;

class FacetLink extends Component
{
    public bool $selected;
    public string $field;
    public string $value;
    public string $count;
    public string $baseQuery;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selected, $field, $value, $count, $baseQuery)
    {
        $this->selected = $selected;
        $this->field = $field;
        $this->value = $value;
        $this->count = $count;
        $this->baseQuery = $baseQuery;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blacklight.facet-link');
    }
}
