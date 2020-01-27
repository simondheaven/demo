<div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
        <div class="panel-heading custom-heading">
          Export Customers
        </div>
        <div class="panel-body custom-body">
          <table id="selResTab" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
              <thead>
                  <tr role="row">
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Customer Name:
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Contact Attempt 1:
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Contact Attempt 2:
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Contact Attempt 3:
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Contact Attempt 4:
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Mobile Number:
                      </th>
                  </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
              </tbody>
          </table>
          @include('partials.select.exportform')
        </div>
    </div>
</div>
<script>
    var t;
    function populateTable(){
        t.clear();
        <?php
        $results = session('selResultsSms');
        foreach (session('selResultsSms') as $result)
            {
            echo 't.row.add([';
            echo '"';
            echo '<a href=\"/search/customer/view/';
            echo $result->id;
            echo '\">';
            echo $result->full_name;
            echo '</a>';
            echo '"';
            echo ',';
            echo $result->attempt_1;
            echo ',';
            echo $result->attempt_2;
            echo ',';
            echo $result->attempt_3;
            echo ',';
            echo $result->attempt_4;


              echo ',';
              echo '"';
              foreach($result->phones()->where('phone_type',3)->where('verified',1)->get() as $phone){
              echo $phone->phone_number;
              echo '</br>';
              }
              echo '"';




            echo ']);';
            };
        ?>
      t.draw(false);
    }
    </script>
    <script>
    function makeTables(){
        t = $('#selResTab').DataTable({
                    dom: 'frtip',
                    order: [[0,'desc']],
                    responsive: 'true',
                });
                populateTable();
    }
</script>
<script>
  makeTables();
</script>
