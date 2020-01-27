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
            <button onclick="imports()" class="btn btn-primary custom-tab custom-tab-active">Manage Imports</button>
            <button onclick="exports()" class="btn btn-primary custom-tab custom-tab-inactive">Manage Exports</button>
            <button onclick="users()" class="btn btn-primary custom-tab custom-tab-inactive">Manage Users</button>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading custom-heading">
              Admin Panel
            </div>
            <div class="panel-body custom-body">
              <legend>Manage Imports</legend>
              <table id="importsTable" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                <thead>
                  <tr role="row">
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      ID:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      User Name:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Date:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Imported:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Total:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Error:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Complete:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Delete:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Restart:
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
  function del(id){
    window.location.replace('/admin/import/confirm/delete/' + id);
  }
  function res(id){
    window.location.replace('/admin/import/confirm/restart/' + id);
  }
  function emres(id){
    window.location.replace('/admin/email/confirm/restart/' + id);
  }
  function smsres(id){
    window.location.replace('/admin/phone/confirm/restart/' + id);
  }
  function chres(id){
    window.location.replace('/admin/cheque/confirm/restart/' + id);
  }
  function gores(id){
    window.location.replace('/admin/goneaway/confirm/restart/' + id);
  }
  function bacres(id){
    window.location.replace('/admin/bacs/confirm/restart/' + id);
  }
  function updres(id){
    window.location.replace('/admin/upd/confirm/restart/' + id);
  }
</script>

<script>
  var t;
  function populateTable(){
    t.clear();
    <?php
        $results = $imports;
        foreach ($results as $result)
            {
              $id = '<span style=\"color: magenta;\" title=\"Customer Import File\"><strong>CUS'.$result->id.'</strong></span>';
              $user = $result->user()->get();
              if ($result->total_records_in_file != 0){
                $perc = round(((100 / $result->total_records_in_file) * $result->records_imported),1);
              } else {
                $perc = 0;
              }
              if ($result->import_error == 0){
                $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
              } else {
                $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
              }
              if ($result->import_complete == 1){
                $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
              } else {
                $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
              }
              $del = '<button value=\"'.$result->id.'\" onclick=\"del(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
              $res = '<button value=\"'.$result->id.'\" onclick=\"res(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

            echo 't.row.add([';
            echo '"';
            echo $id;
            echo '"';
            echo ',';
            echo '"';
            echo $user[0]->name;
            echo '"';
            echo ',';
            echo '"';
            echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
            echo '"';
            echo ',';
            echo '"';
            echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
            echo $result->records_imported;
            echo '</span>';
            echo '"';
            echo ',';
            echo '"';
            echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
            echo $result->total_records_in_file;
            echo '</span>';
            echo '"';
            echo ',';
            echo '"';
            echo $error;
            echo '"';
            echo ',';
            echo '"';
            echo $complete;
            echo '"';
            echo ',';
            echo '"';
            echo $del;
            echo '"';
            echo ',';
            echo '"';
            echo $res;
            echo '"';
            echo ']);';
          }

          $results = $emailimports;
          foreach ($results as $result)
              {
                $id = '<span style=\"color: brown;\" title=\"Email Bounce File\"><strong>EMA'.$result->id.'</strong></span>';
                $user = $result->user()->get();
                if ($result->number_of_records != 0){
                  $perc = round(((100 / $result->number_of_records) * $result->records_imported),1);
                } else {
                  $perc = 0;
                }
                if ($result->import_error == 0){
                  $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
                } else {
                  $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
                }
                if ($result->import_complete == 1){
                  $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
                } else {
                  $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
                }
                $del = '<button disabled data-toggle=\"tooltip\" title=\"Delete not available for this import type.\" value=\"4\" onclick=\"\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
                $res = '<button value=\"'.$result->id.'\" onclick=\"emres(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

              echo 't.row.add([';
              echo '"';
              echo $id;
              echo '"';
              echo ',';
              echo '"';
              echo $user[0]->name;
              echo '"';
              echo ',';
              echo '"';
              echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
              echo '"';
              echo ',';
              echo '"';
              echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
              echo $result->records_imported;
              echo '</span>';
              echo '"';
              echo ',';
              echo '"';
              echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
              echo $result->number_of_records;
              echo '</span>';
              echo '"';
              echo ',';
              echo '"';
              echo $error;
              echo '"';
              echo ',';
              echo '"';
              echo $complete;
              echo '"';
              echo ',';
              echo '"';
              echo $del;
              echo '"';
              echo ',';
              echo '"';
              echo $res;
              echo '"';
              echo ']);';
            }


            $results = $phoneimports;
            foreach ($results as $result)
                {
                  $id = '<span style=\"color: indigo;\" title=\"SMS Bounce File\"><strong>SMS'.$result->id.'</strong></span>';
                  $user = $result->user()->get();
                  if ($result->number_of_records != 0){
                    $perc = round(((100 / $result->number_of_records) * $result->records_imported),1);
                  } else {
                    $perc = 0;
                  }
                  if ($result->import_error == 0){
                    $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
                  } else {
                    $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
                  }
                  if ($result->import_complete == 1){
                    $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
                  } else {
                    $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
                  }
                  $del = '<button disabled data-toggle=\"tooltip\" title=\"Delete not available for this import type.\" value=\"4\" onclick=\"\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
                  $res = '<button value=\"'.$result->id.'\" onclick=\"smsres(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

                echo 't.row.add([';
                echo '"';
                echo $id;
                echo '"';
                echo ',';
                echo '"';
                echo $user[0]->name;
                echo '"';
                echo ',';
                echo '"';
                echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
                echo '"';
                echo ',';
                echo '"';
                echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
                echo $result->records_imported;
                echo '</span>';
                echo '"';
                echo ',';
                echo '"';
                echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
                echo $result->number_of_records;
                echo '</span>';
                echo '"';
                echo ',';
                echo '"';
                echo $error;
                echo '"';
                echo ',';
                echo '"';
                echo $complete;
                echo '"';
                echo ',';
                echo '"';
                echo $del;
                echo '"';
                echo ',';
                echo '"';
                echo $res;
                echo '"';
                echo ']);';
              }


              $results = $chequeimports;
              foreach ($results as $result)
                  {
                    $id = '<span style=\"color: orange;\" title=\"Cheque Update File\"><strong>CHQ'.$result->id.'</strong></span>';
                    $user = $result->user()->get();
                    if ($result->number_of_records != 0){
                      $perc = round(((100 / $result->number_of_records) * $result->records_imported),1);
                    } else {
                      $perc = 0;
                    }
                    if ($result->import_error == 0){
                      $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
                    } else {
                      $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
                    }
                    if ($result->import_complete == 1){
                      $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
                    } else {
                      $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
                    }
                    $del = '<button disabled data-toggle=\"tooltip\" title=\"Delete not available for this import type.\" value=\"4\" onclick=\"\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
                    $res = '<button value=\"'.$result->id.'\" onclick=\"chres(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

                  echo 't.row.add([';
                  echo '"';
                  echo $id;
                  echo '"';
                  echo ',';
                  echo '"';
                  echo $user[0]->name;
                  echo '"';
                  echo ',';
                  echo '"';
                  echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
                  echo '"';
                  echo ',';
                  echo '"';
                  echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
                  echo $result->records_imported;
                  echo '</span>';
                  echo '"';
                  echo ',';
                  echo '"';
                  echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
                  echo $result->number_of_records;
                  echo '</span>';
                  echo '"';
                  echo ',';
                  echo '"';
                  echo $error;
                  echo '"';
                  echo ',';
                  echo '"';
                  echo $complete;
                  echo '"';
                  echo ',';
                  echo '"';
                  echo $del;
                  echo '"';
                  echo ',';
                  echo '"';
                  echo $res;
                  echo '"';
                  echo ']);';
                }

                $results = $goneimports;
                foreach ($results as $result)
                    {
                      $id = '<span style=\"color: gold;\" title=\"Goneaway Update File\"><strong>GON'.$result->id.'</strong></span>';
                      $user = $result->user()->get();
                      if ($result->number_of_records != 0){
                        $perc = round(((100 / $result->number_of_records) * $result->records_imported),1);
                      } else {
                        $perc = 0;
                      }
                      if ($result->import_error == 0){
                        $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
                      } else {
                        $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
                      }
                      if ($result->import_complete == 1){
                        $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
                      } else {
                        $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
                      }
                      $del = '<button disabled data-toggle=\"tooltip\" title=\"Delete not available for this import type.\" value=\"4\" onclick=\"\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
                      $res = '<button value=\"'.$result->id.'\" onclick=\"gores(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

                    echo 't.row.add([';
                    echo '"';
                    echo $id;
                    echo '"';
                    echo ',';
                    echo '"';
                    echo $user[0]->name;
                    echo '"';
                    echo ',';
                    echo '"';
                    echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
                    echo '"';
                    echo ',';
                    echo '"';
                    echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
                    echo $result->records_imported;
                    echo '</span>';
                    echo '"';
                    echo ',';
                    echo '"';
                    echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
                    echo $result->number_of_records;
                    echo '</span>';
                    echo '"';
                    echo ',';
                    echo '"';
                    echo $error;
                    echo '"';
                    echo ',';
                    echo '"';
                    echo $complete;
                    echo '"';
                    echo ',';
                    echo '"';
                    echo $del;
                    echo '"';
                    echo ',';
                    echo '"';
                    echo $res;
                    echo '"';
                    echo ']);';
                  }

    $results = $bacsimports;
    foreach ($results as $result)
        {
          $id = '<span style=\"color: red;\" title=\"BACS File\"><strong>BAC'.$result->id.'</strong></span>';
          $user = $result->user()->get();
          if ($result->number_of_records != 0){
            $perc = round(((100 / $result->number_of_records) * $result->records_imported),1);
          } else {
            $perc = 0;
          }
          if ($result->import_error == 0){
            $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
          } else {
            $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
          }
          if ($result->import_complete == 1){
            $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
          } else {
            $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
          }
          $del = '<button disabled data-toggle=\"tooltip\" title=\"Delete not available for this import type.\" value=\"4\" onclick=\"\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
          $res = '<button value=\"'.$result->id.'\" onclick=\"bacres(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

        echo 't.row.add([';
        echo '"';
        echo $id;
        echo '"';
        echo ',';
        echo '"';
        echo $user[0]->name;
        echo '"';
        echo ',';
        echo '"';
        echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
        echo '"';
        echo ',';
        echo '"';
        echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
        echo $result->records_imported;
        echo '</span>';
        echo '"';
        echo ',';
        echo '"';
        echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
        echo $result->number_of_records;
        echo '</span>';
        echo '"';
        echo ',';
        echo '"';
        echo $error;
        echo '"';
        echo ',';
        echo '"';
        echo $complete;
        echo '"';
        echo ',';
        echo '"';
        echo $del;
        echo '"';
        echo ',';
        echo '"';
        echo $res;
        echo '"';
        echo ']);';
      }

      $results = $customerupdates;
      foreach ($results as $result)
          {
            $id = '<span style=\"color: lightblue;\" title=\"Customer Update File\"><strong>UPD'.$result->id.'</strong></span>';
            $user = $result->user()->get();
            if ($result->number_of_records != 0){
              $perc = round(((100 / $result->number_of_records) * $result->records_imported),1);
            } else {
              $perc = 0;
            }
            if ($result->import_error == 0){
              $error = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"No errors were detected.\">No</span>';
            } else {
              $error = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"'.$result->error_description.'\">Yes</span>';
            }
            if ($result->import_complete == 1){
              $complete = '<span style=\"color:limegreen;\" data-toggle=\"tooltip\" title=\"The import completed successfully.\">Yes</span>';
            } else {
              $complete = '<span style=\"color:red;\" data-toggle=\"tooltip\" title=\"The import was not completed.\">No</span>';
            }
            $del = '<button disabled data-toggle=\"tooltip\" title=\"Delete not available for this import type.\" value=\"4\" onclick=\"\" class=\"btn btn-primary custom-btn-cancel\">Delete</button>';
            $res = '<button value=\"'.$result->id.'\" onclick=\"updres(this.value)\" class=\"btn btn-primary custom-btn-cancel\">Restart</button>';

          echo 't.row.add([';
          echo '"';
          echo $id;
          echo '"';
          echo ',';
          echo '"';
          echo $user[0]->name;
          echo '"';
          echo ',';
          echo '"';
          echo "<small>(".$result->created_at."): </small></br>".date('dS M Y g:i A', strtotime($result->created_at));
          echo '"';
          echo ',';
          echo '"';
          echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#0099A8;\">';
          echo $result->records_imported;
          echo '</span>';
          echo '"';
          echo ',';
          echo '"';
          echo '<span data-toggle=\"tooltip\" title=\"'.$perc.'%'.'\" style=\"color:#231F20;\">';
          echo $result->number_of_records;
          echo '</span>';
          echo '"';
          echo ',';
          echo '"';
          echo $error;
          echo '"';
          echo ',';
          echo '"';
          echo $complete;
          echo '"';
          echo ',';
          echo '"';
          echo $del;
          echo '"';
          echo ',';
          echo '"';
          echo $res;
          echo '"';
          echo ']);';
        }
?>
    t.draw(false);
  }
</script>
    <script>
    function makeTables(){
        t = $('#importsTable').DataTable({
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

@if(session('confirmDelete'))
  @include('partials.admin.confirmdelete')
@endif
@if(session('confirmRestart'))
  @include('partials.admin.confirmrestart')
@endif
@if(session('confirmEmailRestart'))
  @include('partials.admin.confirmemailrestart')
@endif
@if(session('confirmPhoneRestart'))
  @include('partials.admin.confirmphonerestart')
@endif
@if(session('confirmChequeRestart'))
  @include('partials.admin.confirmchequerestart')
@endif
@if(session('confirmBacsRestart'))
  @include('partials.admin.confirmbacsrestart')
@endif
@if(session('confirmMailRestart'))
  @include('partials.admin.confirmmailrestart')
@endif
@if(session('confirmUpdRestart'))
  @include('partials.admin.confirmupdrestart')
@endif

@endsection
