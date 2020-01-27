<script>
var currentEmailUpdateIds = [
  <?php
      foreach ($bounces as $upload){
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
              Email Bounce Updates in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($bounces as $upload)
             <div class="upload-container">
                <p><strong>Email Bounce File #{{$upload->id}}: <span id="msg-up-{{$upload->id}}">File validated. Update in progress.</span></strong></p>
                <p><span id="prog-up-{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-up{{$upload->id}}">{{$upload->number_of_records}}</span> Customer email records updated.</p>
                <div class="prog-bar" id="prog-up-bar-{{$upload->id}}" style="width:<?php if($upload->number_of_records>0){echo (100/$upload->number_of_records)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdates(){
  var xhtt= new XMLHttpRequest();
  xhtt.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      for (var i=0; i<data.length; i++){
        for (var u=0; u<currentEmailUpdateIds.length; u++){
          if (data[i].id == currentEmailUpdateIds[u]){
            if(data[i].import_complete ==1 ){
              //complete
              var pbid = "prog-up-bar-" + currentEmailUpdateIds[u];
              var msgid = "msg-up-" + currentEmailUpdateIds[u];
              var pid = "prog-up-" + currentEmailUpdateIds[u];
              document.getElementById(pbid).style.opacity = "0";
              document.getElementById(msgid).innerHTML = "Bounce update complete.";
              document.getElementById(msgid).style.color = "green";
              document.getElementById(pid).innerHTML = data[i].records_imported;
            } else if(data[i].import_error == 1){
            //else errors
              var pbid = "prog-up-bar-" + currentEmailUpdateIds[u];
              var msgid = "msg-up-" + currentEmailUpdateIds[u];
              document.getElementById(msgid).innerHTML = data[i].error_description;
              document.getElementById(msgid).style.color = "red";
              document.getElementById(pbid).style.opacity = "0";
            } else {
            //else updates
              var pid = "prog-up-" + currentEmailUpdateIds[u];
              var pbid = "prog-up-bar-" + currentEmailUpdateIds[u];
              var tid = "total-up" + currentEmailUpdateIds[u];
              if (data[i].number_of_records > 0){
                var perc = (100 / data[i].number_of_records) * data[i].records_imported;
              } else {
                var perc = 0;
              }
              document.getElementById(tid).innerHTML = data[i].number_of_records;
              document.getElementById(pid).innerHTML = data[i].records_imported;
              document.getElementById(pbid).style.width = perc + "%";
              document.getElementById(pbid).title = "" + Math.floor(perc) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhtt.open("GET", "{{route('update.ajax')}} ", true);
  xhtt.send();
}
</script>
<script>
function callUpdateProgress(){
  setTimeout(function(){
    getUpdates();
      setTimeout(function(){
        callUpdateProgress();
      }, 1000);
    }, 1000);
  }
  getUpdates();
  callUpdateProgress();
</script>
