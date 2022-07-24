@extends('layouts.base')

@section('content')
<div class="container">
    <form method="get" action="{{ route('blacklight.search') }}" >
        <div class="row">
            <x-search-bar :q="$q" />
        </div>

        <div class="row">
            <div class="col-4">
                <x-blacklight.facet-widget :selectedFacets="$selectedFacets" :baseQuery="$baseQuery" :solrResult="$solrResult" />
            </div>
            <div class="col-8">
                <x-search-results />
            </div>
        </div>
    </form>
</div>
@endsection
