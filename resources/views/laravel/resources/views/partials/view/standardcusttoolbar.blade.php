<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      Customer Actions
    </div>
    <div class="panel-body custom-body">
      <div class="row row-fluid">
        <div id="btn1" class="col-md-2">
          <button onclick="chNam()" style="width:100%;" class="btn btn-primary custom-btn-submit">Update Name & Title</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="chAdd()" style="width:100%;" class="btn btn-primary custom-btn-submit">Update Address</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="voidVal('address')" style="width:100%;" class="btn btn-primary custom-btn-cancel">Void Address</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="chPho()" style="width:100%;" class="btn btn-primary custom-btn-submit">Update Phone Number</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="voidVal('phone')" style="width:100%;" class="btn btn-primary custom-btn-cancel">Void Phone Number</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="chEma()" style="width:100%;" class="btn btn-primary custom-btn-submit">Update Email</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="voidVal('email')" style="width:100%;" class="btn btn-primary custom-btn-cancel">Void Email</button>
        </div>
        <div id="btn1" class="col-md-2">
          <button onclick="chChq()" style="width:100%;" class="btn btn-primary custom-btn-submit" disabled>Allocate New Cheque</button>
        </div>
      <div id="btn1" class="col-md-2">
      @if ($customer->contact_suppression == 0)
      <button style="width:100%;" onclick="dnc()" class="btn btn-primary custom-btn-cancel">Set Contact Suppression</button>
      @else
      <button style="width:100%;" onclick="dnc()" class="btn btn-primary custom-btn-cancel">Remove Suppression</button>
      @endif
      </div>
      <div id="btn1" class="col-md-2">
      @if ($customer->deceased == 0)
      <button style="width:100%;" onclick="deceased()" class="btn btn-primary custom-btn-cancel">Set Deceased</button>
      @else
      <button style="width:100%;" onclick="deceased()" class="btn btn-primary custom-btn-cancel">Set Not Deceased</button>
      @endif
      </div>
      <div id="btn4" class="col-md-2">
      <a href="#comments"><button style="width:100%;"class="btn btn-primary custom-btn-submit">Comments<label class="label" style="color: white;"><small>( {{$customer->comments()->count()}} )</small></label></button></a>
    </div>
      <div id="btn3" class="col-md-2">
      <button style="width:100%;" onclick="document.getElementById('commentbox').focus()" class="btn btn-primary custom-btn-submit">Add Comment</button>
      </div>
      </div>
    </div>
</div>
<script>
function voidVal(type){
  window.location.replace('/customer/void/{{ $customer->id }}/'+type);
}
function deceased(){
  window.location.replace('/customer/deceased/{{ $customer->id }}');
}
function dnc(){
  window.location.replace('/customer/dnc/{{ $customer->id }}');
}
function chAdd(){
  window.location.replace('/customer/update/address');
}
function chPho(){
  window.location.replace('/customer/update/phone');
}
function chEma(){
  window.location.replace('/customer/update/email');
}
function chChq(){
  window.location.replace('/customer/update/cheque');
}
function chNam(){
  window.location.replace('/customer/update/name');
}

</script>
