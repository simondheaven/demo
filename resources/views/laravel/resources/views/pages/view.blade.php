@extends('layouts.app')

@section('content')

<div class="container">
                  @if(isset($activecall))
                      @include('partials.view.customertoolbar')
                @endif
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
          
                    @include('partials.view.standardcusttoolbar')
                    @include('partials.view.customerdetails')
                    @include('partials.view.customercomments')
                    @include('partials.view.historyindicator')
        </div>
    </div>
</div>
@if(session('updateAddress'))
  @if(session('updateAddress') == true)
    @include('partials.view.updateaddress')
  @endif
@endif
@if(session('updatePhone'))
  @if(session('updatePhone') == true)
    @include('partials.view.updatephonenumber')
  @endif
@endif
@if(session('updateEmail'))
  @if(session('updateEmail') == true)
    @include('partials.view.updateemail')
  @endif
@endif
@if(session('updateCheque'))
  @if(session('updateCheque') == true)
    @include('partials.view.updatecheque')
  @endif
@endif
@if(session('updateName'))
  @if(session('updateName') == true)
    @include('partials.view.updatename')
  @endif
@endif
@if(session('voidSomething'))
    @include('partials.view.void')
@endif
@endsection
