<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      Customer Search
    </div>
    <div class="panel-body custom-body">
      <div class="row row-fluid">
        <div class="col-md-6">

{{ Form::open(['route' => 'search.execute']) }}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <legend>Search Customers</legend>
    <select style="width:100%;" class="form-control" name="search_field">
      <option value="id">Inc ID</option>
      <option value="customer_number">Customer Number</option>
      <option value="full_name">Customer Name</option>
      <option value="phone_number">Phone Number</option>
    </select>
    <input class="form-control" style="width:100%;" required name="search_term" placeholder="Enter your search term here..." type="text"></input>

    <div style="text-align:right;">
      </br>
      <button type="reset" class="btn btn-primary custom-btn custom-btn-cancel">Clear</button>
      <button type="submit" class="btn btn-primary custom-btn custom-btn-submit">Search</button>
    </div>
  </fieldset>
{{ Form::close() }}
</div>

<div class="col-md-6">
  {{ Form::open(['route' => 'browse.execute']) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
      <legend>Browse Customers</legend>
      <div class="row row-fluid">
        <div class="col-md-2">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios0" value="0" checked>
          <label  class="form-check-label" for="gridRadios0">
            Not Attempted
          </label>
        </div>
        <div class="col-md-2">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="1">
          <label  class="form-check-label" for="gridRadios1">
            One Attempt
          </label>
        </div>
        <div class="col-md-2">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="2">
          <label  class="form-check-label" for="gridRadios2">
            Two Attempts
          </label>
        </div>
        <div class="col-md-2">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="3">
          <label  class="form-check-label" for="gridRadios3">
            Three Attempts
          </label>
        </div>
        <div class="col-md-2">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="4">
          <label  class="form-check-label" for="gridRadios4">
            Four Attempts
          </label>
        </div>
        <div class="col-md-2">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios5" value="5">
          <label  class="form-check-label" for="gridRadios5">
            Five Attempts
          </label>
        </div>
      </div>

      <div style="text-align:right;">
        </br>

        <button type="submit" class="btn btn-primary custom-btn custom-btn-submit">Browse</button>
      </div>
    </fieldset>
  {{ Form::close() }}
</div>

</div>
</div>
</div>
