<div id="action-toolbar" class="panel panel-default">
  <div class="panel-heading custom-heading-call">
    Call Actions
  </div>
  <div class="panel-body custom-body">
    <div id="atb-internal" class="row row-fluid">
      @if(count($activecall) == 0)
      @if ($customer->contact_suppression == 0)
      <div id="btn2" class="col-md-4">
        <button style="width:10.5vw;" onclick="begin()" class="btn btn-primary custom-btn-submit">Begin Call</button>
      </div>
      @else
      <div id="btn2" class="col-md-4">
        <button disabled style="width:10.5vw;" class="btn btn-primary custom-btn-submit">Begin Call</button>
      </div>
      @endif
      <div id="btn2" class="col-md-4">
        <button style="width:10.5vw;" onclick="comp()" disabled class="btn btn-primary custom-btn-submit">End Call</button>
      </div>
      <div id="btn4" class="col-md-4">
        <button style="width:10.5vw;" onclick="unlock()" disabled class="btn btn-primary custom-btn-cancel">Cancel Call</button>
      </div>
      @else
      <div id="btn2" class="col-md-4">
        <button disabled style="width:10.5vw;" class="btn btn-primary custom-btn-submit">Begin Call</button>
      </div>
      <div id="btn2" class="col-md-4">
        <?php
        $complete = "<form method='POST' action='/export/call/complete'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$activecall[0]->id."'><button style='width:10.5vw;' class='btn btn-primary custom-btn-submit'>End Call</button></form>";
        echo $complete;
        ?>

      </div>
      <div id="btn4" class="col-md-4">
        <?php
        $cancel = "<form method='POST' action='/export/call/cancel'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$activecall[0]->id."'><button style='width:10.5vw;' class='btn btn-primary custom-btn-cancel'>Cancel Call</button></form>";
        echo $cancel;
        ?>


      </div>
      @endif

    </div>
  </div>
</div>
<script>
  function begin(){
    window.location.replace('/export/call/{{ $customer->id }}');
  }

</script>
