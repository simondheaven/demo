@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
      <div class="custom-tabs">
        <script>
          function imports(){
            window.location.replace('/admin/import');
          }
          function exports(){
            window.location.replace('/admin/export');
          }
          function users(){
            window.location.replace('/admin/user');
          }
        </script>
        <button onclick="imports()" class="btn btn-primary custom-tab custom-tab-inactive">Manage Imports</button>
        <button onclick="exports()" class="btn btn-primary custom-tab custom-tab-active">Manage Exports</button>
        <button onclick="users()" class="btn btn-primary custom-tab custom-tab-inactive">Manage Users</button>
      </div>
          <div class="panel panel-default">


            <div class="panel-heading custom-heading">
              Admin Panel
            </div>
            <div class="panel-body custom-body">
              <legend>Manage Exports</legend>
              <table id="exportsTable" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                <thead>
                  <tr role="row">
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      ID:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      File Name:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      User Name:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Export Date:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Is Locked:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Customers:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Cancel & Unlock:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Mark as Completed:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Download File:
                    </th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                </tbody>
              </table>
            </div>
          </div>
    </div>
</div>
</div>

<script>
  var t;
  function populateTable(){
    t.clear();
    <?php
        $results = $exports;
        foreach ($results as $result)
            {
              $id = '<strong>EXP'.$result->id.'</strong>';
              $username = $result->users()->get();
              $username = $username[0]->name;
              $contacts = count(json_decode($result->customer_ids_json));


              if ($result->contact_completed == 1){
                $cancelled = "<form method='POST' action='/export/cancel'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-cancel'>Communication Sent</button></form>";
                $completed = "<form method='POST' action='/export/complete'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-submit'>Communication Sent</button></form>";
                $locked = "<span title='Contact completed.' style='color:green;'>No</span>";
                $generate = "<form method='POST' action='/get/export'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-submit'>Communication Sent</button></form>";
              }
              if ($result->contact_completed == 0){
                $cancelled = "<form method='POST' action='/export/cancel'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button class='btn btn-primary custom-btn-cancel'>Cancel & Unlock</button></form>";
                $completed = "<form method='POST' action='/export/complete'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button class='btn btn-primary custom-btn-submit'>Communication Sent</button></form>";
                $locked = "<span title='Customers in this export are locked from other selections.' style='color:red;'>Yes</span>";
                $generate = "<form method='POST' action='/get/export'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button class='btn btn-primary custom-btn-submit'>Download</button></form>";
                if ($result->filename == "Call"){
                  $generate = "<a href='".$result->filepath."'><button class='btn btn-primary custom-btn-submit'>Call</button></a>";
                } else if ($result->file_downloaded == 0){
                  $generate = "<form method='POST' action='/get/export'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-submit'>Download</button></form>";

                }
              }
              if ($result->contact_completed == -1){
                $cancelled = "<form method='POST' action='/export/cancel'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-cancel'>Export Cancelled</button></form>";
                $completed = "<form method='POST' action='/export/complete'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-submit'>Export Cancelled</button></form>";
                $locked = "<span title='Export cancelled.' style='color:green;'>No</span>";
                $generate = "<form method='POST' action='/get/export'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled class='btn btn-primary custom-btn-submit'>Export Cancelled</button></form>";
              }



            echo 't.row.add([';
            echo '"';
            echo $id;
            echo '"';
            echo ',';
            echo '"';
            echo $result->filename;
            echo '"';
            echo ',';
            echo '"';
            echo $username;
            echo '"';
            echo ',';
            echo '"';
            echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
            echo '"';
            echo ',';
            echo '"';
            echo $locked;
            echo '"';
            echo ',';
            echo $contacts;
            echo ',';
            echo '"';
            echo $cancelled;
            echo '"';
            echo ',';
            echo '"';
            echo $completed;
            echo '"';
            echo ',';
            echo '"';
            echo $generate;
            echo '"';
            echo ']);';
          }
?>
    t.draw(false);
  }
</script>
    <script>
    function makeTables(){
        t = $('#exportsTable').DataTable({
                    dom: 'Bfrtip',
                    order: [[3,'desc']],
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
@endsection
