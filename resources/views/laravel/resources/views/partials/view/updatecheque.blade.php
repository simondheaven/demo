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
        Allocate New Cheque Number
      </div>
      <form method="post" action="{{route('customer.new.cheque')}}">
        {{ csrf_field() }}
      <div class="panel-body custom-body">
        <legend>Allocate New Cheque Number</legend>
        <input type="hidden" name="custId" value="{{$customer->id}}"/>
        Allocate new cheque number to {{$customer->full_name}}?
      </div>
    <div class="modal-footer">
      <img id="loadinggif" src="/img/loading.gif" style="margin-right:15px; opacity:0;">
        <button type="reset" class="btn btn-primary custom-btn-cancel" onclick="hideError()" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary custom-btn-submit">Confirm</button>
        </form>
    </div>

  </div>
</div>
</div>
