<script>
var currentPhoneUpdateIds = [
  <?php
      foreach ($phonebounces as $upload){
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
              SMS Bounce Updates in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($phonebounces as $upload)
             <div class="upload-container">
                <p><strong>SMS Bounce File #{{$upload->id}}: <span id="msg-u2p-a{{$upload->id}}">File validated. Update in progress.</span></strong></p>
                <p><span id="prog-u2p-a{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-u2pa{{$upload->id}}">{{$upload->number_of_records}}</span> Customer records updated.</p>
                <div class="prog-bar" id="prog-u2p-abar-a{{$upload->id}}" style="width:<?php if($upload->number_of_records>0){echo (100/$upload->number_of_records)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdatesa(){
  var xhtta= new XMLHttpRequest();
  xhtta.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var dataa = JSON.parse(this.responseText);
      for (var i=0; i<dataa.length; i++){
        for (var u=0; u<currentPhoneUpdateIds.length; u++){
          if (dataa[i].id == currentPhoneUpdateIds[u]){
            if(dataa[i].import_complete ==1 ){
              //complete
              var pbida = "prog-u2p-abar-a" + currentPhoneUpdateIds[u];
              var msgida = "msg-u2p-a" + currentPhoneUpdateIds[u];
              var pida = "prog-u2p-a" + currentPhoneUpdateIds[u];
              document.getElementById(pbida).style.opacity = "0";
              document.getElementById(msgida).innerHTML = "Bounce update complete.";
              document.getElementById(msgida).style.color = "green";
              document.getElementById(pida).innerHTML = dataa[i].records_imported;
            } else if(dataa[i].import_error == 1){
            //else errors
              var pbida = "prog-u2p-abar-a" + currentPhoneUpdateIds[u];
              var msgida = "msg-u2p-a" + currentPhoneUpdateIds[u];
              document.getElementById(msgida).innerHTML = dataa[i].error_description;
              document.getElementById(msgida).style.color = "red";
              document.getElementById(pbida).style.opacity = "0";
            } else {
            //else updates
              var pida = "prog-u2p-a" + currentPhoneUpdateIds[u];
              var pbida = "prog-u2p-abar-a" + currentPhoneUpdateIds[u];
              var tid = "total-u2pa" + currentPhoneUpdateIds[u];
              if (dataa[i].number_of_records > 0){
                var perca = (100 / dataa[i].number_of_records) * dataa[i].records_imported;
              } else {
                var perca = 0;
              }
              document.getElementById(tid).innerHTML = dataa[i].number_of_records;
              document.getElementById(pida).innerHTML = dataa[i].records_imported;
              document.getElementById(pbida).style.width = perca + "%";
              document.getElementById(pbida).title = "" + Math.floor(perca) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhtta.open("GET", "{{route('update.more.ajax')}} ", true);
  xhtta.send();
}
</script>
<script>
function callUpdateProgressa(){
  setTimeout(function(){
    getUpdatesa();
      setTimeout(function(){
        callUpdateProgressa();
      }, 1000);
    }, 1000);
  }
  getUpdatesa();
  callUpdateProgressa();
</script>
