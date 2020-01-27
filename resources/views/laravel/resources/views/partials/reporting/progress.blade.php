<script>
var progIds = [
  <?php
      foreach ($reports as $upload){
        echo $upload->id.',';
      }
   ?>
];
</script>

<div class="container">
      <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <div class="panel panel-default">
            <div class="panel-heading custom-heading">
              Generating Reports
            </div>
            <div class="panel-body custom-body">
             @foreach ($reports as $upload)
             <div class="upload-container">
               {{ Form::open(array('url' => route('report.download'))) }}
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="hidden" name="id" value="{{$upload->id}}"/>
               <button id="repbutton{{$upload->id}}" disabled style="float:right;" class="btn btn-primary custom-btn-submit">Download</button>
               {{ Form::close() }}
                <p><strong>Report #{{$upload->id}}: <span id="msgrep{{$upload->id}}">is being generated. Please note that the number of operations does not necessarily equal the number of customers contained in the report.</span></strong></p>
                <span style="float:right; opacity:0.5;">{{basename($upload->filepath)}}</span>
                <p id="repprog{{$upload->id}}"><span id="progrep{{$upload->id}}">{{$upload->processed_records}}</span> of <span id="total-rep{{$upload->id}}">{{$upload->total_records}}</span> operations completed.</p>
                <div class="prog-bar" id="progrepbar-{{$upload->id}}" style="width:<?php if($upload->total_records>0){echo (100/$upload->total_records)*$upload->processed_records;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdatesf(){
  var xhttrep= new XMLHttpRequest();
  xhttrep.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var datarep = JSON.parse(this.responseText);
      for (var i=0; i<datarep.length; i++){
        for (var u=0; u<progIds.length; u++){
          if (datarep[i].id == progIds[u]){
            if(datarep[i].completed ==1 ){
              //complete
              var pbidm = "progrepbar-" + progIds[u];
              var msgidm = "msgrep" + progIds[u];
              var pidm = "progrep" + progIds[u];
              var pb = "repbutton" + progIds[u];
              document.getElementById(pbidm).style.opacity = "0";
              document.getElementById(msgidm).innerHTML = "Report complete.";
              document.getElementById(msgidm).style.color = "green";
              document.getElementById(pb).disabled = false;
              document.getElementById(pidm).innerHTML = datarep[i].processed_records;
            } else if(datarep[i].import_error == 1){
            //else errors
              var pbidm = "progrepbar-" + progIds[u];
              var msgidm = "msgrep" + progIds[u];
              document.getElementById(msgidm).innerHTML = datarep[i].error_description;
              document.getElementById(msgidm).style.color = "red";
              document.getElementById(pbidm).style.opacity = "0";
            } else {
            //else updates
              var pidm = "progrep" + progIds[u];
              var pbidm = "progrepbar-" + progIds[u];
              var tidm = "total-rep" + progIds[u];
              if (datarep[i].total_records > 0){
                var percf = (100 / datarep[i].total_records) * datarep[i].processed_records;
              } else {
                var percf = 0;
              }
              document.getElementById(tidm).innerHTML = datarep[i].total_records;
              document.getElementById(pidm).innerHTML = datarep[i].processed_records;
              document.getElementById(pbidm).style.width = percf + "%";
              document.getElementById("repprog{{$upload->id}}").title = "" + Math.floor(percf) + "% complete.";
              document.getElementById(pbidm).title = "" + Math.floor(percf) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhttrep.open("GET", "{{route('reports.ajax')}}", true);
  xhttrep.send();
}
</script>
<script>
function callUpdateProgressf(){
  setTimeout(function(){
    getUpdatesf();
      setTimeout(function(){
        callUpdateProgressf();
      }, 1000);
    }, 1000);
  }
  getUpdatesf();
  callUpdateProgressf();
</script>
