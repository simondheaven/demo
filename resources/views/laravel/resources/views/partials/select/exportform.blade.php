<?php
  $ids = array();

  if (session('selResultsEmail')){
    $results = session('selResultsEmail');
  }
  else if (session('selResultsSms')){
    $results = session('selResultsSms');
  }
  else if (session('selResultsMail')){
    $results = session('selResultsMail');
  }

  foreach ($results as $result)
  {
    array_push($ids, $result['id']);
  }
 ?>
<div>
</br>

  {{ Form::open(['route' => 'export.download', 'id' => 'expform']) }}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="ids" value="{{ json_encode($ids) }}"/>
  @if(session('selResultsEmail'))
  <input type="hidden" name="exptype" value="email"/>
  @endif

  @if(session('selResultsSms'))
  <input type="hidden" name="exptype" value="sms"/>
  @endif

  @if(session('selResultsMail'))
  <input type="hidden" name="exptype" value="mail"/>
  @endif
  {{ Form::close() }}

</div>

<div id="expload" style="opacity:0; text-align:center; height: 0px; width: 100%;">
</br>
  Please wait... your export file is being generated.</br>
  Your will be redirected shortly.</br>
  <img src="/img/loading.gif"></img>
</div>
<script>
  function exploader(){
    document.getElementById('expload').style.height = '80px';
    document.getElementById('expload').style.opacity = '1';
  }
</script>
<script>
  setTimeout(function(){
    exploader();
    document.getElementById('expform').submit();
  }, 500);
</script>
