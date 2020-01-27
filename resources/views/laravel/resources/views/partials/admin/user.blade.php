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
        <button onclick="exports()" class="btn btn-primary custom-tab custom-tab-inactive">Manage Exports</button>
        <button onclick="users()" class="btn btn-primary custom-tab custom-tab-active">Manage Users</button>
      </div>
          <div class="panel panel-default">


            <div class="panel-heading custom-heading">
              Admin Panel
            </div>
            <div class="panel-body custom-body">
              <legend>Manage Users</legend>
              <div class="row row-fluid" style="text-align:right; padding-right:15px;">
                  <a href="{{route('register')}}" class="btn btn-primary custom-btn-submit">Add New User</a>
              </div>
            </br>
              <table id="usersTable" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                <thead>
                  <tr role="row">
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      ID:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      User Name:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Email Address:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Imports:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Exports:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Comments:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Admin:
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Remove User:
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
  function removeUser(id){
    window.location.replace('/admin/user/confirm/delete/' + id);
  }
</script>
<script>
  function setAdmin(id){
    window.location.replace('/admin/user/setadmin/' + id);
  }
</script>


<script>
  var t;
  function populateTable(){
    t.clear();
    <?php
        $results = $users;
        foreach ($results as $result)
            {
              $comments = count($result->comments()->get());
              $imports = count($result->uploads()->get()) + count($result->bounces()->get()) + count($result->phonebounces()->get()) + count($result->mailbounces()->get()) + count($result->chequeuploads()->get());
              if ($result->email != 'removedusers@incdirect.co.uk'){
                $id = '<strong>USR'.$result->id.'</strong>';
                if ($result->is_admin){
                  $admin = '<input value =\"'.$result->id.'\" onclick=\"setAdmin(this.value)\" style=\"width:15px; height:15px;\" type=\"checkbox\" class=\"form-control\" checked></input>';
                } else {
                  $admin = '<input value =\"'.$result->id.'\" onclick=\"setAdmin(this.value)\" style=\"width:15px; height:15px;\" type=\"checkbox\" class=\"form-control\"></input>';
                }
                $upd = '<button value =\"'.$result->id.'\" class=\"btn btn-primary custom-btn-submit\">Update</button>';
                $rem = '<button value =\"'.$result->id.'\" class=\"btn btn-primary custom-btn-cancel\" onclick=\"removeUser(this.value)\">Remove</button>';
              } else {
                $admin = '<span data-toggle=\"tooltip\" title=\"This is a required user and may not be edited.\">N/A</span>';
                $upd = '<span data-toggle=\"tooltip\" title=\"This is a required user and may not be edited.\">N/A</span>';
                $rem = '<span data-toggle=\"tooltip\" title=\"This is a required user and may not be edited.\">N/A</span>';
                $id = '<span data-toggle=\"tooltip\" title=\"This is a required user and may not be edited.\">N/A</span>';
              }


            echo 't.row.add([';
            echo '"';
            echo $id;
            echo '"';
            echo ',';
            echo '"';
            echo $result->name;
            echo '"';
            echo ',';
            echo '"';
            echo $result->email;
            echo '"';
            echo ',';
            echo '"';
            echo $imports;
            echo '"';
            echo ',';
            echo '"';
            echo count($result->exports()->get());
            echo '"';
            echo ',';
            echo '"';
            echo $comments;
            echo '"';
            echo ',';
            echo '"';
            echo $admin;
            echo '"';
            echo ',';
            echo '"';
            echo $rem;
            echo '"';
            echo ']);';
          }
?>
    t.draw(false);
  }
</script>
    <script>
    function makeTables(){
        t = $('#usersTable').DataTable({
                    dom: 'Bfrtip',
                    order: [[0,'asc']],
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

@if(session('confirmDeleteUser'))
  @include('partials.admin.confirmdeleteuser')
@endif


@endsection
