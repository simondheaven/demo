<script>
    function hideError(){
      document.getElementById('errorbox').style.display = 'none';
      document.getElementById('fadeBox').style.display = 'none';
    }
    function confirmResUpd(){
      document.getElementById('loadinggif').style.opacity = '1';
      window.location.replace('/admin/upd/restart/{{session('confirmUpdRestart')}}');
    }
</script>
<div id="fadeBox" style="background-color:black; position:absolute; width:100%; height: 150vh; opacity:0.4; top:0px; left:0px;"></div>
<div id="errorbox" style="position:absolute; top: 30%; width:80%; left:10%;">
  <div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
      <div class="panel-heading custom-heading">
        <button type="button" style="color:white;" class="close" onclick="hideError()" data-dismiss="modal" aria-hidden="true">×</button>
        Confirm Customer Details Update Restart
      </div>
      <div class="panel-body custom-body">
        <p><strong style="color:red;">Warning!</strong></p>
        <p>This action will reapply the changes made to customer records by the initial upload of the file.</p>
        <p>Are you sure you want to continue?</p>
    </div>
    <div class="modal-footer">
      <img id="loadinggif" src="/img/loading.gif" style="margin-right:15px; opacity:0;">
        <button class="btn btn-primary custom-btn-cancel" onclick="hideError()" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary custom-btn-submit" onclick="confirmResUpd()" data-dismiss="modal">Confirm</button>
    </div>
  </div>
</div>
</div>
