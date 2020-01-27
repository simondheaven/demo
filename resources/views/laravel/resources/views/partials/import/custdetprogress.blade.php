<script>
var custDetidds = [
  <?php
      foreach ($custdeetuploads as $upload){
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
              Customer Details Updates in Progress
            </div>
            <div class="panel-body custom-body">
             @foreach ($custdeetuploads as $upload)
             <div class="upload-container">
                <p><strong>Customer Details File #{{$upload->id}}: <span id="msg-u76767p-d{{$upload->id}}">File validated. Update in progress.</span></strong></p>
                <p><span id="prog-u76767p-d{{$upload->id}}">{{$upload->records_imported}}</span> of <span id="total-u76767p{{$upload->id}}">{{$upload->number_of_records}}</span> Customer records updated.</p>
                <div class="prog-bar" id="prog-u76767p-dbar-{{$upload->id}}" style="width:<?php if($upload->number_of_records>0){echo (100/$upload->number_of_records)*$upload->records_imported;}else{echo 0;} ?>%;"></div>
              </div>
             @endforeach
           </div>
         </div>
       </div>
     </div>
</div>


<script>
function getUpdatesd(){
  var xhttdd= new XMLHttpRequest();
  xhttdd.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var datadd = JSON.parse(this.responseText);
      for (var i=0; i<datadd.length; i++){
        for (var u=0; u<custDetidds.length; u++){
          if (datadd[i].id == custDetidds[u]){
            if(datadd[i].import_complete ==1 ){
              //complete
              var pbidd = "prog-u76767p-dbar-" + custDetidds[u];
              var msgidd = "msg-u76767p-d" + custDetidds[u];
              var pidd = "prog-u76767p-d" + custDetidds[u];
              document.getElementById(pbidd).style.opacity = "0";
              document.getElementById(msgidd).innerHTML = "Customer Details update complete.";
              document.getElementById(msgidd).style.color = "green";
              document.getElementById(pidd).innerHTML = datadd[i].records_imported;
            } else if(datadd[i].import_error == 1){
            //else errors
              var pbidd = "prog-u76767p-dbar-" + custDetidds[u];
              var msgidd = "msg-u76767p-d" + custDetidds[u];
              document.getElementById(msgidd).innerHTML = datadd[i].error_description;
              document.getElementById(msgidd).style.color = "red";
              document.getElementById(pbidd).style.opacity = "0";
            } else {
            //else updates
              var pidd = "prog-u76767p-d" + custDetidds[u];
              var pbidd = "prog-u76767p-dbar-" + custDetidds[u];
              var tidd = "total-u76767p" + custDetidds[u];
              if (datadd[i].number_of_records > 0){
                var percd = (100 / datadd[i].number_of_records) * datadd[i].records_imported;
              } else {
                var percd = 0;
              }
              document.getElementById(tidd).innerHTML = datadd[i].number_of_records;
              document.getElementById(pidd).innerHTML = datadd[i].records_imported;
              document.getElementById(pbidd).style.width = percd + "%";
              document.getElementById(pbidd).title = "" + Math.floor(percd) + "% complete.";
            }
          }
        }
      }
    }
  };
  xhttdd.open("GET", "{{route('update.custdet.ajax')}}", true);
  xhttdd.send();
}
</script>
<script>
function callUpdateProgressd(){
  setTimeout(function(){
    getUpdatesd();
      setTimeout(function(){
        callUpdateProgressd();
      }, 1000);
    }, 1000);
  }
  getUpdatesd();
  callUpdateProgressd();
</script>
