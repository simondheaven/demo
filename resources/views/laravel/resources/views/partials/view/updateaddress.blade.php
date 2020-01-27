<script>
    function hideError(){
      document.getElementById('errorbox').style.display = 'none';
      document.getElementById('fadeBox').style.display = 'none';
    }

</script>
<div id="fadeBox" style="background-color:black; position:fixed; width:100%; height: 150vh; opacity:0.4; top:0px; left:0px;"></div>
<div id="errorbox" style="position:absolute; top: 30%; width:80%; left:10%;">
  <div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
      <div class="panel-heading custom-heading">
        <button type="button" style="color:white;" class="close" onclick="hideError()" data-dismiss="modal" aria-hidden="true">×</button>
        Update Address
      </div>
      <form method="post" action="{{route('customer.new.address')}}">
        {{ csrf_field() }}
      <div class="panel-body custom-body">
        <legend>Enter New Address Details</legend>
        <input type="hidden" name="custId" value="{{$customer->id}}"/>
        <label for="add1">Address Line 1: </label>
        <input required class="form-control" name="add1" type="text"/></br>
        <label  for="add2">Address Line 2: </label>
        <input class="form-control" name="add2" type="text"/></br>
        <label  for="add3">Address Line 3: </label>
        <input class="form-control" name="add3" type="text"/></br>
        <label  for="add4">Address Line 4: </label>
        <input class="form-control" name="add4" type="text"/></br>
        <label  for="add5">Address Line 5: </label>
        <input class="form-control" name="add5" type="text"/></br>
        <label  for="add6">Address Line 6: </label>
        <input class="form-control" name="add6" type="text"/></br>
        <label  for="add7">Address Line 7: </label>
        <input class="form-control" name="add7" type="text"/></br>
      </div>
    <div class="modal-footer">
      <img id="loadinggif" src="/img/loading.gif" style="margin-right:15px; opacity:0;">
        <button type="reset" class="btn btn-primary custom-btn-cancel" onclick="hideError()" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary custom-btn-submit">Update</button>
    </div>
  </form>
  </div>
</div>
</div>
