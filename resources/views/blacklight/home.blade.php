@extends('layouts.base')

@section('content')
<div class="container">
    <form method="get" action="{{ route('blacklight.search') }}" >
        <div class="row">
            <x-search-bar />
        </div>

        <div class="row">
            <div class="col-3">
                <x-blacklight.facet-widget />
            </div>
            <div class="col-9">
                <x-landing />
            </div>
        </div>
    </form>
</div>
@endsection
