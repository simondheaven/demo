<script>
var bacsIds = [
  <?php
      foreach ($bacsimports as $upload){
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
              BACS File Imports in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($bacsimports as $upload)
             <div class="upload-container">
                <p><strong>BACS File #{{$upload->id}}: <span id="msg-u619p-f{{$upload->id}}">File validated. Update in progress.</span></strong></p>
                <p><span id="prog-u619p-f{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-u619pf{{$upload->id}}">{{$upload->number_of_records}}</span> Customer records updated.</p>
                <div class="prog-bar" id="prog-u619p-fbar-{{$upload->id}}" style="width:<?php if($upload->number_of_records>0){echo (100/$upload->number_of_records)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdatesf(){
  var xhtt619f= new XMLHttpRequest();
  xhtt619f.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var dataf = JSON.parse(this.responseText);
      for (var i=0; i<dataf.length; i++){
        for (var u=0; u<bacsIds.length; u++){
          if (dataf[i].id == bacsIds[u]){
            if(dataf[i].import_complete ==1 ){
              //complete
              var pbidf = "prog-u619p-fbar-" + bacsIds[u];
              var msgidf = "msg-u619p-f" + bacsIds[u];
              var pidf = "prog-u619p-f" + bacsIds[u];
              document.getElementById(pbidf).style.opacity = "0";
              document.getElementById(msgidf).innerHTML = "BACS update complete.";
              document.getElementById(msgidf).style.color = "green";
              document.getElementById(pidf).innerHTML = dataf[i].records_imported;
            } else if(dataf[i].import_error == 1){
            //else errors
              var pbidf = "prog-u619p-fbar-" + bacsIds[u];
              var msgidf = "msg-u619p-f" + bacsIds[u];
              document.getElementById(msgidf).innerHTML = dataf[i].error_description;
              document.getElementById(msgidf).style.color = "red";
              document.getElementById(pbidf).style.opacity = "0";
            } else {
            //else updates
              var pidf = "prog-u619p-f" + bacsIds[u];
              var pbidf = "prog-u619p-fbar-" + bacsIds[u];
              var tidf = "total-u619pf" + bacsIds[u];
              if (dataf[i].number_of_records > 0){
                var percf = (100 / dataf[i].number_of_records) * dataf[i].records_imported;
              } else {
                var percf = 0;
              }
              document.getElementById(tidf).innerHTML = dataf[i].number_of_records;
              document.getElementById(pidf).innerHTML = dataf[i].records_imported;
              document.getElementById(pbidf).style.width = percf + "%";
              document.getElementById(pbidf).title = "" + Math.floor(percf) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhtt619f.open("GET", "{{route('update.bacs.ajax')}}", true);
  xhtt619f.send();
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
