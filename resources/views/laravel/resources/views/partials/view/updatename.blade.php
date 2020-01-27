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
        Update Name & Title
      </div>
      <form method="post" action="{{route('customer.new.name')}}">
        {{ csrf_field() }}
      <div class="panel-body custom-body">
        <legend>Update Name & Title</legend>
        <input type="hidden" name="custId" value="{{$customer->id}}"/>
        <label for="title">Title: </label>
        <input required class="form-control" name="title" value="{{$customer->title}}" type="text"/></br>
        <label for="first_name">First Name: </label>
        <input required class="form-control" name="first_name" value="{{$customer->first_name}}" type="text"/></br>
        <label for="surname">Surname: </label>
        <input required class="form-control" name="surname" value="{{$customer->surname}}" type="text"/></br>
        <label for="full_name">Full Name: </label>
        <input required class="form-control" name="full_name" value="{{$customer->full_name}}" type="text"/></br>
        <label for="salutation">Salutation: </label>
        <input required class="form-control" name="salutation" value="{{$customer->updated_salutation}}" type="text"/></br>
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
