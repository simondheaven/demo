@extends('laravel.layouts.app')

@section('content')

<div class="dashboard-main-container">

  @include('laravel.partials.poststatus')

  <hr>

  @include('laravel.partials.timeline')

</div>

<script>

  setTimeout(function(){
    updateNavLinks('nav-link-1');
  }, 1000);

</script>

@endsection
