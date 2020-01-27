<script>
var mailBounceUpdateIds = [
  <?php
      foreach ($mailbounces as $upload){
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
              Goneaway File Imports in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($mailbounces as $upload)
             <div class="upload-container">
                <p><strong>Goneaway File #{{$upload->id}}: <span id="msg-u345p-c{{$upload->id}}">File validated. Update in progress.</span></strong></p>
                <p><span id="prog-u345p-c{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-u345pc{{$upload->id}}">{{$upload->number_of_records}}</span> Customer records updated.</p>
                <div class="prog-bar" id="prog-u345p-cbar-{{$upload->id}}" style="width:<?php if($upload->number_of_records>0){echo (100/$upload->number_of_records)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdatesc(){
  var xhttcc= new XMLHttpRequest();
  xhttcc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var datac = JSON.parse(this.responseText);
      for (var i=0; i<datac.length; i++){
        for (var u=0; u<mailBounceUpdateIds.length; u++){
          if (datac[i].id == mailBounceUpdateIds[u]){
            if(datac[i].import_complete ==1 ){
              //complete
              var pbidc = "prog-u345p-cbar-" + mailBounceUpdateIds[u];
              var msgidc = "msg-u345p-c" + mailBounceUpdateIds[u];
              var pidc = "prog-u345p-c" + mailBounceUpdateIds[u];
              var tidc = "total-u345pc" + mailBounceUpdateIds[u];
              document.getElementById(pbidc).style.opacity = "0";
              document.getElementById(tidc).innerHTML = datac[i].number_of_records;
              document.getElementById(msgidc).innerHTML = "Customer update complete.";
              document.getElementById(msgidc).style.color = "green";
              document.getElementById(pidc).innerHTML = datac[i].records_imported;
            } else if(datac[i].import_error == 1){
            //else errors
              var pbidc = "prog-u345p-cbar-" + mailBounceUpdateIds[u];
              var msgidc = "msg-u345p-c" + mailBounceUpdateIds[u];
              document.getElementById(msgidc).innerHTML = datac[i].error_description;
              document.getElementById(msgidc).style.color = "red";
              document.getElementById(pbidc).style.opacity = "0";
            } else {
            //else updates
              var pidc = "prog-u345p-c" + mailBounceUpdateIds[u];
              var pbidc = "prog-u345p-cbar-" + mailBounceUpdateIds[u];
              var tidc = "total-u345pc" + mailBounceUpdateIds[u];
              if (datac[i].number_of_records > 0){
                var percc = (100 / datac[i].number_of_records) * datac[i].records_imported;
              } else {
                var percc = 0;
              }
              document.getElementById(tidc).innerHTML = datac[i].number_of_records;
              document.getElementById(pidc).innerHTML = datac[i].records_imported;
              document.getElementById(pbidc).style.width = percc + "%";
              document.getElementById(pbidc).title = "" + Math.floor(percc) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhttcc.open("GET", "{{route('update.goneaway.ajax')}}", true);
  xhttcc.send();
}
</script>
<script>
function callUpdateProgressc(){
  setTimeout(function(){
    getUpdatesc();
      setTimeout(function(){
        callUpdateProgressc();
      }, 1000);
    }, 1000);
  }
  getUpdatesc();
  callUpdateProgressc();
</script>
