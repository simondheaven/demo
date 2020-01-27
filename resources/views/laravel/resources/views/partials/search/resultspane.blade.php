
<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      Search Results
    </div>
    <div class="panel-body custom-body">

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <legend>Search Results</legend>
    <table id="resultTable" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                                    <thead>
                                        <tr role="row">
                                          <th style="text-transform:capitalize; width: 400px;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                            Customer
                                          </th>
                                          @foreach(\App\Customer::tableFieldSet() as $field)
                                            <th style="text-transform:capitalize;" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                              {{str_replace("_"," ", $field)}}
                                            </th>
                                          @endforeach
                                        </tr>
                                    </thead>
                                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    </tbody>
                                </table>
  </fieldset>

</div>
</div>
<script>
    var t;
    function populateTable(){
        t.clear();
        <?php
        $results = json_decode(session('searchResults'));
        $customerKeys = \App\Customer::tableFieldSet();
        foreach ($results as $result)
            {
              echo 't.row.add([';
              echo '"';
              echo '<a href=\"/call/customer/';
              echo $result->id;
              echo '\">';
              echo '<img style=\"height:15px; float:left; margin-top: 3px; margin-right: 5px;\" src=\"/img/human.png\"></img>';
              echo $result->first_name.' '.$result->surname;
              echo '</a>';
              echo '"';
              echo ',';
              foreach($result as $key => $val){
                if(in_array($key, $customerKeys)){
                  echo '"';
                  if($key == 'contact_suppression'){
                      $src = ($val == '1') ? "/img/no.png" : "/img/empty.png";
                      $ttl = ($val == '1') ? "Customer has requested not to be contacted" : "Customer has not requested suppression";
                      echo '<div style=\"width:75%; text-align:center;\"><span style=\"display:none\">'.$val.'</span><img style=\"height:15px;\" src=\"'.$src.'\" title=\"'.$ttl.'\"></img></div>';
                  } else if($key == "completed"){
                    if($val == '2'){
                      $src = "/img/yes.png";
                      $ttl = "Customer has been paid";
                    } else if ($val == '1'){
                      $src = "/img/no.png";
                      $ttl = "An attempt has been made to pay the customer, but it failed.";
                    } else if ($val == '0'){
                      $src = "/img/empty.png";
                      $ttl = "User not yet paid";
                    } else if ($val == '-1'){
                      $src = "/img/no.png";
                      $ttl = "Customer contacted 5+ times, not paid.";
                    } else {
                      $src = "/img/no.png";
                      $ttl = "Something went wrong.";
                    }
                    echo '<div style=\"width:75%; text-align:center;\"><span style=\"display:none\">'.$val.'</span><img style=\"height:15px;\" src=\"'.$src.'\" title=\"'.$ttl.'\"></img></div>';
                  } else if ($key == "with_callback_team"){
                    $src = ($val == '1') ? "/img/yes.png" : "/img/empty.png";
                    $ttl = ($val == '1') ? "Customer is allocated to the callback team" : "Customer has not been allocated to the callback team";
                    echo '<div style=\"width:75%; text-align:center;\"><span style=\"display:none\">'.$val.'</span><img style=\"height:15px;\" src=\"'.$src.'\" title=\"'.$ttl.'\"></img></div>';
                  } else if ($key == 'goneaway'){
                    $src = ($val == '1') ? "/img/yes.png" : "/img/empty.png";
                    $ttl = "";
                    echo '<div style=\"width:75%; text-align:center;\"><span style=\"display:none\">'.$val.'</span><img style=\"height:15px;\" src=\"'.$src.'\" title=\"'.$ttl.'\"></img></div>';
                  } else if ($key == "deceased") {
                    $src = ($val == '1') ? "/img/yes.png" : "/img/empty.png";
                    $ttl = "";
                    echo '<div style=\"width:75%; text-align:center;\"><span style=\"display:none\">'.$val.'</span><img style=\"height:15px;\" src=\"'.$src.'\" title=\"'.$ttl.'\"></img></div>';
                  } else {
                      echo $val;
                  }
                  echo '"';
                  echo ',';
                }
              }
              echo ']);';
            }
        ?>
      t.draw(false);
    }
    </script>
    <script>
    function makeTables(){
        t = $('#resultTable').DataTable({
                    dom: 'Bfrtip',
                    order: [[0,'desc']],
                    responsive: 'true',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
                populateTable();
    }
</script>
<script>
  makeTables();
</script>
