@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
                    @include('partials.select.selectcustomersform')
                    @if(session('selResultsEmail'))
                      @include('partials.select.exportform')
                    @endif
                    @if(session('selResultsSms'))
                      @include('partials.select.exportform')
                    @endif
                    <div id="panecontain">
                    @if(session('selResultsPhone'))
                      @include('partials.select.phoneresults')
                    @endif
                    </div>
                    @if(session('selResultsMail'))
                      @include('partials.select.exportform')
                    @endif
                    @include('partials.select.loading')
                    @if(session('novalid'))
                      @include('partials.select.novalid')
                    @endif
    </div>
</div>
@endsection
