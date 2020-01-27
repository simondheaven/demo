<script>
    function hideError(){
      document.getElementById('errorbox').style.display = 'none';
      document.getElementById('fadeBox').style.display = 'none';
    }

    function updater(type,id,yorn){
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", "/customer/void/detail/"+type+"/"+id+"/"+yorn, true);
      xhttp.send();
    }

</script>
<div id="fadeBox" style="background-color:black; position:fixed; width:100%; height: 150vh; opacity:0.4; top:0px; left:0px;"></div>
<div id="errorbox" style="position:absolute; top: 30%; width:80%; left:10%;">
  <div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
      <div class="panel-heading custom-heading">
        <button type="button" style="color:white;" class="close" onclick="hideError()" data-dismiss="modal" aria-hidden="true">×</button>
        Void Contact Detail
      </div>
        <input type="hidden" name="custId" value="{{$customer->id}}"/>
        <input type="hidden" name="type" value="{{ session('voidSomething') }}"/>
      <div class="panel-body custom-body" style="overflow-y: auto">
        @if(session('voidSomething') == "address")
        <?php
          $i = 1;
          ?>
          <legend>Void Addresses</legend>
            @foreach($customer->addresses()->get()->each->decryption() as $addy)
              <h4>Address {{$i++}}:</h4>
                {{$addy->address_line1}}</br>
                {{$addy->address_line2}}</br>
                {{$addy->address_line3}}</br>
                {{$addy->address_line4}}</br>
                {{$addy->address_line5}}</br>
                {{$addy->address_line6}}</br>
                {{$addy->address_line7}}</br>
                Verified?
                @if ($addy->verified == 1)
                <select oninput="updater('mail', {{$addy->id}}, this.value)" class="form-control">
                  <option value="1" selected>Yes</option>
                  <option value="0">No</option>
                </select>
                @else
                <select oninput="updater('mail', {{$addy->id}}, this.value)" class="form-control">
                  <option value="1">Yes</option>
                  <option value="0" selected>No</option>
                </select>
                @endif
              <hr>
            @endforeach
        @endif
        @if(session('voidSomething') == "email")
        <?php
          $i = 1;
          ?>
          <legend>Void Email Addresses</legend>
            @foreach($customer->emails()->get()->each->decryption() as $email)
              <h4>Email Address {{$i++}}:</h4>
                {{$email->email_address}}</br></br>
                Verified?
                @if ($email->verified == 1)
                <select oninput="updater('email', {{$email->id}}, this.value)" class="form-control">
                  <option value="1" selected>Yes</option>
                  <option value="0">No</option>
                </select>
                @else
                <select oninput="updater('email', {{$email->id}}, this.value)" class="form-control">
                  <option value="1">Yes</option>
                  <option value="0" selected>No</option>
                </select>
                @endif
              <hr>
            @endforeach
        @endif

        @if(session('voidSomething') == "phone")
        <?php
          $i = 1;
          ?>
          <legend>Void Phone Numbers</legend>
            @foreach($customer->phones()->get()->each->decryption() as $email)
              <h4>Phone Number {{$i++}}:</h4>
                @if($email->phone_type == 1)
                  Type: Home
                @elseif($email->phone_type==2)
                  Type: Work
                @elseif($email->phone_type==3)
                  Type: Mobile
                @elseif ($email->phone_type==4)
                  Type: Connection
                @endif
              </br>
                Number: {{$email->phone_number}}</br>
                Verified?
                @if ($email->verified == 1)
                <select oninput="updater('phone', {{$email->id}}, this.value)" class="form-control">
                  <option value="1" selected>Yes</option>
                  <option value="0">No</option>
                </select>
                @else
                <select oninput="updater('phone', {{$email->id}}, this.value)" class="form-control">
                  <option value="1">Yes</option>
                  <option value="0" selected>No</option>
                </select>
                @endif
              <hr>
            @endforeach
        @endif

      </div>
    <div class="modal-footer">
      <img id="loadinggif" src="/img/loading.gif" style="margin-right:15px; opacity:0;">
        <button type="reset" class="btn btn-primary custom-btn-submit" onclick="hideError()" data-dismiss="modal">OK</button>
        <!--button class="btn btn-primary custom-btn-submit">Update</button-->
    </div>
  </div>
</div>
</div>
