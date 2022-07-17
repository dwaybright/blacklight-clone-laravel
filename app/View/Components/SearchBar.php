<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBar extends Component
{
    public string $q;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($q)
    {
        $this->q = $q;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blacklight.search-bar');
    }
}
