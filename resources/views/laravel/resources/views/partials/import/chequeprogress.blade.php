<script>
var currentChequeUpdateIds = [
  <?php
      foreach ($chequeuploads as $upload){
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
              Cheque File Imports in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($chequeuploads as $upload)
             <div class="upload-container">
                <p><strong>Cheque File #{{$upload->id}}: <span id="msg-u3p-e{{$upload->id}}">File validated. Update in progress.</span></strong></p>
                <p><span id="prog-u3p-e{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-u3p{{$upload->id}}">{{$upload->number_of_records}}</span> Customer records updated.</p>
                <div class="prog-bar" id="prog-u3p-ebar-{{$upload->id}}" style="width:<?php if($upload->number_of_records>0){echo (100/$upload->number_of_records)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdatese(){
  var xhttee= new XMLHttpRequest();
  xhttee.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var datae = JSON.parse(this.responseText);
      for (var i=0; i<datae.length; i++){
        for (var u=0; u<currentChequeUpdateIds.length; u++){
          if (datae[i].id == currentChequeUpdateIds[u]){
            if(datae[i].import_complete ==1 ){
              //complete
              var pbide = "prog-u3p-ebar-" + currentChequeUpdateIds[u];
              var msgide = "msg-u3p-e" + currentChequeUpdateIds[u];
              var pidee = "prog-u3p-e" + currentChequeUpdateIds[u];
              document.getElementById(pbide).style.opacity = "0";
              document.getElementById(msgide).innerHTML = "Cheques update complete.";
              document.getElementById(msgide).style.color = "green";
              document.getElementById(pidee).innerHTML = datae[i].records_imported;
            } else if(datae[i].import_error == 1){
            //else errors
              var pbide = "prog-u3p-ebar-" + currentChequeUpdateIds[u];
              var msgide = "msg-u3p-e" + currentChequeUpdateIds[u];
              document.getElementById(msgide).innerHTML = datae[i].error_description;
              document.getElementById(msgide).style.color = "red";
              document.getElementById(pbide).style.opacity = "0";
            } else {
            //else updates
              var pidee = "prog-u3p-e" + currentChequeUpdateIds[u];
              var pbide = "prog-u3p-ebar-" + currentChequeUpdateIds[u];
              var tidee = "total-u3p" + currentChequeUpdateIds[u];
              if (datae[i].number_of_records > 0){
                var percee = (100 / datae[i].number_of_records) * datae[i].records_imported;
              } else {
                var percee = 0;
              }
              document.getElementById(tidee).innerHTML = datae[i].number_of_records;
              document.getElementById(pidee).innerHTML = datae[i].records_imported;
              document.getElementById(pbide).style.width = percee + "%";
              document.getElementById(pbide).title = "" + Math.floor(perce) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhttee.open("GET", "{{route('update.extra.ajax')}}", true);
  xhttee.send();
}
</script>
<script>
function callUpdateProgresse(){
  setTimeout(function(){
    getUpdatese();
      setTimeout(function(){
        callUpdateProgresse();
      }, 1000);
    }, 1000);
  }
  getUpdatese();
  callUpdateProgresse();
</script>
