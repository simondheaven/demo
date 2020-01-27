<div id="dl_contain" class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
        <div class="panel-heading custom-heading">
          Download Export File
        </div>
        <div class="panel-body custom-body">
          <legend>File Export</legend>
          <div id="expload" style="opacity:1; text-align:center; height: 150px; width: 100%;">
          </br>
            Please wait... your export file is being generated.</br>
            Please do not navigate away or refresh the page.</br>
            Your download will begin momentarily.</br>
            <img src="/img/loading.gif"></img>
          </br></br>
            <div id="exp-prog-bar" class="prog-bar" style="width: 0px;"></div>
          </div>
          <script>
            function exploader(){
              document.getElementById('expload').style.height = '0px';
              document.getElementById('expload').style.opacity = '0';
              document.getElementById('dl_contain').style.display = "none";
              document.getElementById('action_contain').style.opacity = '1';
            }
            </script>
        </div>
    </div>
</div>
<div id="action_contain" style="opacity:0;" class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
        <div class="panel-heading custom-heading">
          Export File Generated
        </div>
        <div class="panel-body custom-body">
          Please select one of the options below:
        </br></br>
          <div class="row row-fluid" style="text-align:center;">
            <div class="col-md-4">
              {{ Form::open(['route' => 'get.export']) }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="expid" value="{{$expid}}"/>
              <button style="width: 200px; height:36px;" type="submit" class="btn btn-primary custom-btn-submit">Download File</button>
              {{ Form::close() }}
            </div>
            <div class="col-md-4">
              {{ Form::open(['route' => 'export.cancel']) }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="expid" value="{{$expid}}"/>
              <button style="width: 200px; height:36px;" type="submit" class="btn btn-primary custom-btn-cancel">Customer Contact Cancelled</button>
              {{ Form::close() }}
            </div>
            <div class="col-md-4">
              {{ Form::open(['route' => 'export.complete']) }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="expid" value="{{$expid}}"/>
              <button style="width: 200px; height:36px;" type="submit" class="btn btn-primary custom-btn-submit">Customer Communication Sent</button>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div>
</div>

@if($exptype == "email")

<script>
  setTimeout(function(){
      var emailexp = new XMLHttpRequest();
      emailexp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        }
      };
      emailexp.open("GET", "{{url('/export/email/'.$expid)}} ", true);
      emailexp.send();
    }
    ,100);
</script>
@endif

@if($exptype == "sms")
<script>
  setTimeout(function(){
      var emailexp = new XMLHttpRequest();
      emailexp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        }
      };
      emailexp.open("GET", "{{url('/export/sms/'.$expid)}} ", true);
      emailexp.send();
    }
    ,100);
</script>
@endif


@if($exptype == "mail")
<script>
  setTimeout(function(){
      var emailexp = new XMLHttpRequest();
      emailexp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        }
      };
      emailexp.open("GET", "{{url('/export/mail/'.$expid)}} ", true);
      emailexp.send();
    }
    ,100);
</script>
@endif




<script>
 var completed = false;
function czech(){
  var checkreq = new XMLHttpRequest();
  checkreq.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == 'true'){
        if (completed == false){
          exploader();
          completed = true;
          document.getElementById('getexport').submit();
          }
      } else if (this.responseText == 'false') {

      }
      else {
          document.getElementById('exp-prog-bar').style.width = this.responseText + "%";
      }
    }
  };
  checkreq.open("GET", "{{url('/export/check/'.$expid)}} ", true);
  checkreq.send();
}

function timer(){
  czech();
  setTimeout(function(){
    timer();
  },2500);
}

setTimeout(timer(),100);
</script>
{{ Form::open(['route' => 'get.export', 'id' => 'getexport']) }}
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="expid" value="{{$expid}}"/>
{{ Form::close() }}
