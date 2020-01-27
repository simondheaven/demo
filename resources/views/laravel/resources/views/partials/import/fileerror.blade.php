<script>
    function hideError(){
      document.getElementById('errorbox').style.display = 'none';
      document.getElementById('fadeBox').style.display = 'none';
    }
</script>
<div id="fadeBox" style="background-color:black; position:absolute; width:100%; height: 100%; opacity:0.4; top:0px; left:0px;"></div>
<div id="errorbox" style="position:absolute; top: 30%; width:80%; left:10%;">
  <div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
      <div class="panel-heading custom-heading">
        <button type="button" style="color:white;" class="close" onclick="hideError()" data-dismiss="modal" aria-hidden="true">×</button>
        File Rejected
      </div>
      <div class="panel-body custom-body">
        <p>Sorry! Your file was rejected.</p>
        <p id="myModalMessage">
          {{session('fileTypeError')}}
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary custom-btn-cancel" onclick="hideError()" data-dismiss="modal">Close</button>
    </div>
  </div>
