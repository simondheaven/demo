@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading custom-heading">Change Password</div>

                <div class="panel-body custom-body">
                  <p><strong>Note:</strong> Passwords must be at least ten characters in length, contain at least one capital letter and one special character.</p>
                    <form class="form-horizontal" method="POST" action="{{ route('update.password') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="old_p" class="col-md-4 control-label">Old Password:</label>

                            <div class="col-md-6">
                                <input id="old_p" type="password" class="form-control" name="old_password" required autofocus>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary custom-btn-submit">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
