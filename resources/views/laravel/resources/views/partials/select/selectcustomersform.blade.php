<div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
        <div class="panel-heading custom-heading">
          Select Customers for Export
        </div>
        <div class="panel-body custom-body">
          <fieldset>
            <legend>Select Customers</legend>
            {{ Form::open(['route' => 'select.execute']) }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <h4>Max included customers:</h4>
              <input id="samplenum" type="number" value="500" class="form-control" max="5000" onchange="updateSampleSize(this.value)" onkeyup="updateSampleSize(this.value)">
              <input id="sampleran" onchange="updateSampleSize(this.value)" type="range" name="sample_size" max="5000" min="1" value="500" onmouseout="updateSampleSize(this.value)" class="form-control">

              <h4>Contact method:</h4>
              <div class="row row-fluid">
                <div class="col-md-4">
                  <input onclick="activateDeceased()" class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="mail" checked>
                  <label onclick="activateDeceased()" class="form-check-label" for="gridRadios4">
                    Direct Mail
                  </label>
                </div>
                <div class="col-md-4">
                  <input onclick="clearTable()" class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="email">
                  <label onclick="clearTable()" class="form-check-label" for="gridRadios1">
                    Email
                  </label>
                </div>
                <div class="col-md-4">
                  <input onclick="clearTable()"  class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="sms">
                  <label onclick="clearTable()" class="form-check-label" for="gridRadios2">
                    SMS
                  </label>
                </div>
                <!--div class="col-md-3">
                  <input  onclick="clearTable()" class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="phone">
                  <label onclick="clearTable()" class="form-check-label" for="gridRadios3">
                    For Contact By Phone
                  </label>
                </div-->
              </div>

              <h4>Filter by attempts:</h4>
              <div style="width:100%; display:grid; grid-template-columns: repeat(6,1fr);">
                <label >
									<input type="checkbox" name="contacted_0" checked> Not Yet Contacted
								</label>
                <label >
									<input type="checkbox" name="contacted_1"> Contacted Once
								</label>
                <label >
									<input type="checkbox" name="contacted_2"> Contacted Twice
								</label>
                <label >
									<input type="checkbox" name="contacted_3"> Contacted Three Times
								</label>
                <label >
									<input type="checkbox" name="contacted_4"> Contacted Four Times
								</label>
                <label >
									<input type="checkbox" name="contacted_5plus"> Contacted 5+ times
								</label>
              </div>
              <h4>Other options:</h4>
              <div class="row row-fluid">
                <div class="col-md-4">
                  <input title="Select deceased or not deceased customers." onclick="document.getElementById('nccb').checked = false" type="checkbox" id="deceasedcb" name="deceased" class="form-check-input">
                  <label title="Select deceased or not deceased customers." id="deceasedlb" class="form-check-label" for="deceasedcb">
                    Select deceased customers only&nbsp;&nbsp;&nbsp;&nbsp; <small>({{$deceasedcusts}})</small>
                  </label></br>
                  <input title="Select customers with a recently updated cheque number." onclick="document.getElementById('deceasedcb').checked = false" type="checkbox" id="nccb" name="nccb" class="form-check-input">
                  <label title="Select customers with a recently updated cheque number." id="nclb" class="form-check-label" for="nccb">
                    Select new cheque customers only&nbsp;&nbsp;&nbsp;&nbsp; <small>({{$newcheques}})</small>
                  </label>
                </div>
              </div>
              <div>
                </br>
                <button type="reset" class="btn btn-primary custom-btn custom-btn-cancel">Reset</button>
                <button type="submit" onclick="loadPlaceholder()" class="btn btn-primary custom-btn custom-btn-submit">Generate</button>
              </div>
                {{ Form::close() }}
          </fieldset>
        </div>
        @if(session('selResultsPhone'))
        <script>
        document.getElementById('deceasedcb').disabled = true;
        document.getElementById('deceasedlb').style.opacity = "0.5";
        document.getElementById('nccb').disabled = true;
        document.getElementById('nclb').style.opacity = "0.5";
        document.getElementById('gridRadios3').checked = true;
        document.getElementById('samplenum').value = {{ count(session('selResultsPhone')) }};
        document.getElementById('sampleran').value ={{ count(session('selResultsPhone')) }};
        </script>

        @endif
        @if(session('selResultsSms'))
        <script>
        document.getElementById('deceasedcb').disabled = true;
        document.getElementById('deceasedlb').style.opacity = "0.5";
        document.getElementById('nccb').disabled = true;
        document.getElementById('nclb').style.opacity = "0.5";
          document.getElementById('gridRadios2').checked = true;
          document.getElementById('samplenum').value = {{ count(session('selResultsSms')) }};
          document.getElementById('sampleran').value ={{ count(session('selResultsSms')) }};
        </script>
        @endif
        @if(session('selResultsEmail'))
        <script>
        document.getElementById('deceasedcb').disabled = true;
        document.getElementById('deceasedlb').style.opacity = "0.5";
        document.getElementById('nccb').disabled = true;
        document.getElementById('nclb').style.opacity = "0.5";
        document.getElementById('gridRadios1').checked = true;
          document.getElementById('samplenum').value = {{ count(session('selResultsEmail')) }};
          document.getElementById('sampleran').value ={{ count(session('selResultsEmail')) }};
        </script>
        @endif
        @if(session('selResultsMail'))
        <script>
          document.getElementById('gridRadios4').checked = true;
          document.getElementById('samplenum').value = {{ count(session('selResultsMail')) }};
          document.getElementById('sampleran').value ={{ count(session('selResultsMail')) }};
        </script>
        @endif
    </div>
    <!--
    {{ Form::open(['route' => 'search.execute', 'id' => 'phoneSearch']) }}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="search_field" value="with_callback_team"/>
      <input type="hidden" name="search_term" value="1"></input>
    {{ Form::close() }}
  -->
</div>
<script>
  function clearTable(){
    document.getElementById('panecontain').style.display = "none";
    document.getElementById('deceasedcb').disabled = true;
    document.getElementById('deceasedlb').style.opacity = "0.5";
    document.getElementById('nccb').disabled = true;
    document.getElementById('nclb').style.opacity = "0.5";
  }
  </script>
<script>
  function activateDeceased(){
    document.getElementById('panecontain').style.display = "none";
    document.getElementById('deceasedcb').disabled = false;
    document.getElementById('deceasedlb').style.opacity = "1";
    document.getElementById('nccb').disabled = false;
    document.getElementById('nclb').style.opacity = "1";
  }
</script>
<script>
  function updateSampleSize(size){
    if (size > 5000){
      size = 5000;
    }
    if (size < 1){
      size = 1;
    }
    document.getElementById('samplenum').value = size;
    document.getElementById('sampleran').value = size;
  }
  function loadPlaceholder(){
    document.getElementById('loadWheel').style.opacity = "1";
  }
</script>
