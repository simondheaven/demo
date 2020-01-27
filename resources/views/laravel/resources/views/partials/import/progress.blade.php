<script>
var currentUploadIds = [
  <?php
      foreach ($uploads as $upload){
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
              Customer Imports in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($uploads as $upload)
             <div class="upload-container">
                <p><strong>Customer Upload #{{$upload->id}}: <span id="msg-b{{$upload->id}}">File validated. Import in progress.</span></strong></p>
                <p><span id="prog-b{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-b{{$upload->id}}">{{$upload->total_records_in_file}}</span> operations completed.</p>
                <div class="prog-bar" id="prog-bar-b{{$upload->id}}" style="width:<?php if($upload->total_records_in_file>0){echo (100/$upload->total_records_in_file)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>
<script>
function getUserUploadsb(){
  var xhttbb= new XMLHttpRequest();
  xhttbb.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var datab = JSON.parse(this.responseText);
      for (var i=0; i<datab.length; i++){
        for (var u=0; u<currentUploadIds.length; u++){
          if (datab[i].id == currentUploadIds[u]){
            if(datab[i].import_complete ==1 ){
              //complete
              var pbidb = "prog-bar-b" + currentUploadIds[u];
              var msgidb = "msg-b" + currentUploadIds[u];
              var pidb = "prog-b" + currentUploadIds[u];
              document.getElementById(pbidb).style.opacity = "0";
              document.getElementById(msgidb).innerHTML = "Customer import complete.";
              document.getElementById(msgidb).style.color = "green";
              document.getElementById(pidb).innerHTML = datab[i].records_imported;
            } else if(datab[i].import_error == 1){
            //else errors
              var pbidb = "prog-bar-b" + currentUploadIds[u];
              var msgidb = "msg-b" + currentUploadIds[u];
              document.getElementById(msgidb).innerHTML = datab[i].error_description;
              document.getElementById(msgidb).style.color = "red";
              document.getElementById(pbidb).style.opacity = "0";
            } else {
            //else updates
              var pidb = "prog-b" + currentUploadIds[u];
              var pbidb = "prog-bar-b" + currentUploadIds[u];
              var tidb = "total-b" + currentUploadIds[u];
              if (datab[i].total_records_in_file > 0){
                var percb = (100 / datab[i].total_records_in_file) * datab[i].records_imported;
              } else {
                var percb = 0;
              }
              document.getElementById(tidb).innerHTML = datab[i].total_records_in_file;
              document.getElementById(pidb).innerHTML = datab[i].records_imported;
              document.getElementById(pbidb).style.width = percb + "%";
              document.getElementById(pbidb).title = "" + Math.floor(percb) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhttbb.open("GET", "{{route('upload.ajax')}} ", true);
  xhttbb.send();
}
</script>
<script>
function callUploadProgressb(){
  setTimeout(function(){
    getUserUploadsb();
      setTimeout(function(){
        callUploadProgressb();
      }, 1000);
    }, 1000);
  }
  getUserUploadsb();
  callUploadProgressb();
</script>
