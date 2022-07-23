<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlacklightSearchRequest;
use App\Traits\BlacklightTrait;
use Illuminate\Http\Request;

class BlacklightController extends Controller
{
    use BlacklightTrait;

    public function show() {
        $result = $this->executeHomePageSelect();

        return view('blacklight.home', [
            'baseQuery' => route('blacklight.search', [
                'q' => '',
            ]),
            'selectedFacets' => [],
            'solrResult' => $result,
        ]);
    }

    public function search(BlacklightSearchRequest $request) {
        $result = $this->executeHomePageSelect();

        $facets = $request->f;

        return view('blacklight.search', [
            'q' => $request->q ?? '',
            'baseQuery' => $request->getRequestUri(),
            'selectedFacets' => $facets ?? [],
            'solrResult' => $result,
        ]);
    }
    
    public function catalog(Request $request, string $solrDocumentId) {
        return view('blacklight.catalog');
    }
}
