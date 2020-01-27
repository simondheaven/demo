
<div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
        <div class="panel-heading custom-heading">
          Call List
        </div>
        <div class="panel-body custom-body">
          <legend>Call List</legend>
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
                          Status:
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                          Call:
                      </th>
                  </tr>
              </thead>
              <tbody role="alert" aria-live="polite" aria-relevant="all">
              </tbody>
          </table>


        </div>
    </div>
</div>
<script>
    var t;
    function populateTable(){
        t.clear();
        <?php
        $results = session('selResultsPhone');
        foreach (session('selResultsPhone') as $result)
            {
              $call = '<button class=\"btn btn-primary custom-btn-submit\" value=\"'.$result['id'].'\">Call</button>';
              if ($result['completed'] == -1){
                $completed = '"Contact Failed"';
              } else if ($result['completed'] == 0){
                $completed = '"Not Contacted"';
              } else if ($result['completed'] == 1){
                $completed = '"Payment Failed"';
              } else if ($result['completed'] == 2){
                $completed = '"Paid"';
              }
            echo 't.row.add([';
            echo '"';

            echo $result['full_name'];

            echo '"';
            echo ',';
            echo $result['attempt_1'];
            echo ',';
            echo $result['attempt_2'];
            echo ',';
            echo $result['attempt_3'];
            echo ',';
            echo $result['attempt_4'];
            echo ',';
            echo $completed;
            echo ',';
            echo '"';
            echo '<a href=\"/export/call/';
            echo $result['id'];
            echo '\">';
            echo $call;
            echo '</a>';
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
