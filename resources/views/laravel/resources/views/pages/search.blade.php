@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">

                    @include('partials.search.searchform')

                    @if(session('searchResults'))
                      @include('partials.search.resultspane')
                    @endif
                    @if(session('browseResults'))
                      @include('partials.search.browsepane')
                    @endif

        </div>
    </div>
</div>
@endsection
