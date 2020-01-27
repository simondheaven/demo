@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
          <div class="panel-heading custom-heading">
            Your Exports
          </div>
          <div class="panel-body custom-body">
            <legend>Locked Exports</legend>
            <table id="lockTable" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                                        File Name:
                                                    </th>
                                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                                        Locked Records:
                                                    </th>
                                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                                        Created At:
                                                    </th>
                                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                                        Cancel & Unlock:
                                                    </th>
                                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                                        Download:
                                                    </th>
                                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                                                        Mark as Communication Sent:
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
        foreach ($usrexps as $result)
            {
              if ($result->file_downloaded > 0){
                $cancel = "<form method='POST' action='/export/cancel'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button class='btn btn-primary custom-btn-cancel'>Cancel & Unlock</button></form>";
                $regen = "<form method='POST' action='/get/export'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button class='btn btn-primary custom-btn-submit'>Download</button></form>";
                $complete = "<form method='POST' action='/export/complete'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button class='btn btn-primary custom-btn-submit'>Communication Sent</button></form>";
              } else {
                $cancel = "<form method='POST' action='/export/cancel'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled title='File is still being generated.' class='btn btn-primary custom-btn-cancel'>Cancel & Unlock</button></form>";
                $regen = "<form method='POST' action='/get/export'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled title='File is still being generated.' class='btn btn-primary custom-btn-submit'>Download</button></form>";
                $complete = "<form method='POST' action='/export/complete'><input type='hidden' name='_token' value='".csrf_token()."'><input type='hidden' name='expid' value='".$result->id."'><button disabled title='File is still being generated.' class='btn btn-primary custom-btn-submit'>Communication Sent</button></form>";
              }
              if ($result->filename == "Call"){
                $regen = "<a href='".$result->filepath."'><button class='btn btn-primary custom-btn-submit'>Call</button></a>";
              }

            echo 't.row.add([';
            echo '"';
            echo $result->filename;
            echo '"';
            echo ',';
            echo $result->total_records;
            echo ',';
            echo '"';
            echo date('dS M Y g:i A', strtotime($result->created_at));
            echo '"';
            echo ',';
            echo '"';
            echo $cancel;
            echo '"';
            echo ',';
            echo '"';
            echo $regen;
            echo '"';
            echo ',';
            echo '"';
            echo $complete;
            echo '"';
            echo ']);';
            };
        ?>
      t.draw(false);
    }
    </script>
    <script>
    function makeTables(){
        t = $('#lockTable').DataTable({
                    dom: 'Bfrtip',
                    order: [[2,'desc']],
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
