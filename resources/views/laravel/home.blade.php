@extends('laravel.layouts.app')

@section('content')

<div class="home-page-main-container">

  <div id="home-page-main-hero-image-container">
    <img id="home-page-main-hero-image" src="/img/laravel.svg"></img>
  </div>

  <div>
    @include('laravel.partials.signinform')
  </div>

</div>

<hr>

<div style="text-align:center;">

  <h4>Welcome to the Laravel Social App</h4>
  <p>This application is a demonstration of Laravel system development created by Simon Heaven in 2020.</p>

</div>

@endsection
