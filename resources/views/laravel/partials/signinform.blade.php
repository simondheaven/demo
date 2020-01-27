<div class="card" style="border-radius: 0px 25px 0px 25px; background:transparent; border-width: 0px; box-shadow: 0px 0px 15px;">

  <div class="card-header bg-dark" style="border-radius: 0px 25px 0px 0px; display:grid; grid-template-columns:5fr 1fr 5fr; text-align:center;">
    <a id="sign-in-link" class="auth-link auth-link-active" onclick="formSelector(this)" href="#">
      <h3 >Sign In</h3>
    </a>
    <h3 id="auth-link-divider" style="color:gray;">|</h3>
    <a id="register-link" class="auth-link auth-link-inactive" onclick="formSelector(this)" href="#">
      <h3>Register</h3>
    </a>
  </div>

  <div class="card-body">
    <form id="sign-in-form" method="POST" action="{{ route('login') }}">

      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="exampleInputEmail1">Email address</label>
        <input autofocus required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>

      @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif

      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
      </div>

      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif

      <div style="display:grid; grid-template-columns: 1fr 1fr; grid-gap: 15px;padding-top: 15px;">
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="submit" class="btn btn-success">Sign In</button>
      </div>

    </form>

    <form id="register-form" style="display:none;" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; grid-gap: 15px;padding-top: 15px;">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-success">Register</button>
        </div>
    </form>
  </div>

  <div class="card-footer bg-dark" style="text-align:right; color: #fff; border-radius: 0px 0px 0px 25px;">
    <a href="#" style="color:#fff;">
      <small>
        Can't remember your details?
      </small>
    </a>
  </div>

</div>

<script>

  var selected = "sign-in-link";

  function formSelector(selection){
    if(selection.id == selected){
      return;
    } else {
      selected = selection.id;
      if(selection.id == "sign-in-link"){
        var regLink = document.getElementById('register-link');
        regLink.classList.remove("auth-link-active");
        regLink.classList.add("auth-link-inactive");
        selection.classList.remove("auth-link-inactive");
        selection.classList.add("auth-link-active");
        document.getElementById('register-form').style.display = "none";
        document.getElementById('sign-in-form').style.display = "block";
      } else {
        var sigLink = document.getElementById('sign-in-link');
        sigLink.classList.remove("auth-link-active");
        sigLink.classList.add("auth-link-inactive");
        selection.classList.remove("auth-link-inactive");
        selection.classList.add("auth-link-active");
        document.getElementById('sign-in-form').style.display = "none";
        document.getElementById('register-form').style.display = "block";
      }
    }
  }

</script>
