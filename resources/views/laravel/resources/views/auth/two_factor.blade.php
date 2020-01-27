@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
          <div class="panel panel-default">
            <div class="panel-heading custom-heading">
              Two Factor Authentication
            </div>
            <div class="panel-body custom-body">
              <legend>Two Factor Authentication</legend>
              <div style="text-align:center;">
                <p>For security reasons, an email has been sent to <strong>{{Auth::user()->email}}</strong> to verify your session.</p>
                <p>Please enter the one-time passcode sent to your account to continue.</p>
              <form role="form" method="POST" action="/2fa">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                  <input id="2fa" type="text" class="form-control" name="2fa" placeholder="Enter the code you received here." required autofocus autocomplete="off">
                  @if ($errors->has('2fa'))
                    <span class="help-block">
                      <strong>{{ $errors->first('2fa') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                  <button class="btn btn-primary custom-btn-submit" type="submit">Confirm</button>
                </div>
              </form>
            </div>
            </div>
          </div>
    </div>
</div>
</div>

@if(session('wrongCode'))
  @include('partials.wrongotp')
@endif

@endsection
