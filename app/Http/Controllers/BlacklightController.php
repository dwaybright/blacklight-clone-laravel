<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlacklightSearchRequest;
use Illuminate\Http\Request;

class BlacklightController extends Controller
{
    public function show() {
        return view('blacklight.home');
    }

    public function search(BlacklightSearchRequest $request) {
        return view('blacklight.search', [
            'q' => $request->q,
        ]);
    }
    
    public function catalog(Request $request, string $solrDocumentId) {
        return view('blacklight.catalog');
    }
}
