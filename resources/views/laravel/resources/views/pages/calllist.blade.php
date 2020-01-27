@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
                <div id="callloader" style="text-align:center;">
                </br>
                  <img style="height:35vh;" src="/img/newloading.gif"></img>
                  </br>
                  </br>
                  <p id="n1" style="opacity:0.7">Accessing records and generating table.</br>
                  Please wait...</p>
                  </br>
                </div>
                    @include('partials.call.calltable')
        </div>
    </div>
</div>

@endsection
