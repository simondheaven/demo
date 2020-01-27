<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      Customer Profile: {{$customer->full_name}}
    </div>
    <div class="panel-body custom-body">

        <div class="row row-fluid">
            <div class="col-md-6">
              <legend>Customer Details</legend>
              <table id="customerTable1" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                <thead>
                  <tr role="row">
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      #
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Attribute
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Value
                    </th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <legend>Address Details</legend>
              <table id="customerTable2" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                <thead>
                  <tr role="row">
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      #
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Attribute
                    </th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                      Value
                    </th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                </tbody>
              </table>
            </div>
          </div>
          <div class="row row-fluid">
              <div class="col-md-6">
                <legend>Email Details</legend>
                <table id="customerTable3" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                  <thead>
                    <tr role="row">
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                        #
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                        Attribute
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                        Value
                      </th>
                    </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <legend>Phone Details</legend>
                <table id="customerTable4" class="table table-striped" aria-describedby="DataTables_Table_4_info" style="width:100%;">
                  <thead>
                    <tr role="row">
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                        #
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                        Attribute
                      </th>
                      <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_4" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >
                        Value
                      </th>
                    </tr>
                  </thead>
                  <tbody role="alert" aria-live="polite" aria-relevant="all">
                  </tbody>
                </table>
              </div>
            </div>
            <div>
              <div>
                <legend>Successful Contact Attempts</legend>
                <div style="display:grid; grid-template-columns:repeat(5,1fr);">
                  @if($customer->attempt_1 == 1)
                  <div style="background: radial-gradient(#e5e5ff,#e5e5ff,#fff,#fff); width:100%; text-align:center; " >
                    Attempt One
                    <img title="Contact attempted." style="width:94%;" src="/img/yes.png">
                  </div>
                  @else
                  <div style="width:100%; text-align:center; " >
                    Attempt One
                    <img title="Contact attempt not yet made." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                  @if($customer->attempt_2 == 1)
                  <div style="background: radial-gradient(#9999ff,#fff,#fff); width:100%; text-align:center; " >
                    Attempt Two
                    <img title="Contact attempted." style="width:94%;" src="/img/yes.png">
                  </div>
                  @else
                  <div style="width:100%; text-align:center; " >
                    Attempt Two
                    <img title="Contact attempt not yet made." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                  @if($customer->attempt_3 == 1)
                  <div style="background: radial-gradient(#4c4cff,#fff,#fff); width:100%; text-align:center; " >
                    Attempt Three
                    <img title="Contact attempted." style="width:94%;" src="/img/yes.png">
                  </div>
                  @else
                  <div style="width:100%; text-align:center; " >
                    Attempt Three
                    <img title="Contact attempt not yet made." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                  @if($customer->attempt_4 == 1)
                  <div style="background: radial-gradient(#0000ff,#fff,#fff); width:100%; text-align:center; " >
                    Attempt Four
                    <img title="Contact attempted." style="width:94%;" src="/img/yes.png">
                  </div>
                  @else
                  <div style="width:100%; text-align:center; " >
                    Attempt Four
                    <img title="Contact attempt not yet made." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                  @if($customer->attempt_5 == 1)
                  <div style="background: radial-gradient(midnightblue,#fff,#fff); width:100%; text-align:center; " >
                    Attempt Five
                    <img title="Contact attempted." style="width:94%;" src="/img/yes.png">
                  </div>
                  @else
                  <div style="width:100%; text-align:center; " >
                    Attempt Five
                    <img title="Contact attempt not yet made." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                </div>
                <div style="text-align:center; display:grid; grid-template-columns: 1fr 1fr;" >
                  @if($customer->contact_suppression)
                  <div style="width:100%; background: radial-gradient(#ff6961,#ff6961,#fff,#fff); text-align:center;  padding-left:25%; padding-right:25%;" >
                    Suppression
                    <img title="Do not contact." style="width:94%;" src="/img/no.png">
                  </div>
                  @else
                  <div style="width:100%; text-align:center;  padding-left:25%; padding-right:25%;" class="col-md-1">
                    Suppression
                    <img title="No contact suppression." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                  @if($customer->completed == 2)
                  <div style="width:100%; background: radial-gradient(#77dd77,#77dd77,#fff,#fff); text-align:center;  padding-left:25%; padding-right:25%;" class="col-md-1">
                    Completed
                    <img title="Customer paid." style="width:94%;" src="/img/yes.png">
                  </div>
                  @endif
                  @if($customer->completed == 1)
                  <div style="width:100%; background: radial-gradient(yellow,yellow,#fff,#fff); text-align:center;  padding-left:25%; padding-right:25%;" class="col-md-1">
                    Completed
                    <img title="An attempt at payment was made and rejected." style="width:94%;" src="/img/no.png">
                  </div>
                  @endif
                  @if($customer->completed == 0)
                  <div style="width:100%; text-align:center;  padding-left:25%; padding-right:25%;" class="col-md-1">
                    Completed
                    <img title="Customer not yet successfully contacted." style="width:94%;" src="/img/empty.png">
                  </div>
                  @endif
                  @if($customer->completed == -1)
                  <div style="width:100%; background: radial-gradient(#ff6961,#ff6961,#fff,#fff); text-align:center;  padding-left:25%; padding-right:25%;" class="col-md-1">
                    Completed
                    <img title="Customer contact failed." style="width:94%;" src="/img/no.png">
                  </div>
                  @endif
                </div>


              </div>
            </div>
        </div>
      </div>
      <script>
          var t1;
          var t2;
          var t3;
          var t4;
          function populateTabl(){
              t1.clear();
              t2.clear();
              t3.clear();
              t4.clear();
              var i = 1;

                t1.row.add([i++,'Customer Name:', '{{ $customer->first_name.' '.$customer->surname }}']);
                <?php
                foreach(array_keys($customer->toArray()) as $key){
                  if($key == "id"){
                    echo  "t1.row.add([i++, '<span style=\"text-transform:capitalize\">Inc ID</span>', '".$customer->{$key}."']);";
                  } else if(substr($key,0,8) == "attempt_" || $key == "contact_suppression"|| $key == "goneaway"|| $key == "deceased" || $key == "with_callback_team"|| $key == "completed"){
                    echo "t1.row.add([i++, '<span style=\"text-transform:capitalize\">".str_replace("_"," ",$key)."</span>', '";
                    echo ($customer->{$key} == 1) ? "<img src=\"/img/yes.png\" style=\"height:15px;\"></img>" : "<img src=\"/img/empty.png\" style=\"height:15px;\"></img>";
                    echo "']);";
                  } else {
                    echo  "t1.row.add([i++, '<span style=\"text-transform:capitalize\">".str_replace("_"," ",$key)."</span>', '".$customer->{$key}."']);";
                  }
                }

                $addresses = $customer->addresses()->get()->each->decryption();
                $firstAddress = $customer->addresses()->first();
                $addressIt = 1;
                echo "i=1;";
                foreach($addresses as $address){
                  echo  "t2.row.add([i++, '<span style=\"text-transform:capitalize\"><strong>Customer Address #".$addressIt."</strong></span>', '']);";
                  foreach(array_keys($firstAddress->toArray()) as $key){
                   if($key == "id"){
                     echo  "t2.row.add([i++, '<span style=\"text-transform:capitalize\">Address #".$addressIt.": ID</span>', '".$address->{$key}."']);";
                   } else if($key == "verified"|| $key == "paf"){
                     echo "t2.row.add([i++, '<span style=\"text-transform:capitalize\">".str_replace("_"," ",$key)."</span>', '";
                     echo ($address->{$key} == 1) ? "<img src=\"/img/yes.png\" style=\"height:15px;\"></img>" : "<img src=\"/img/empty.png\" style=\"height:15px;\"></img>";
                     echo "']);";
                   } else {
                     echo  "t2.row.add([i++, '<span style=\"text-transform:capitalize\">Address #".$addressIt.": ".str_replace("_"," ",$key)."</span>', '".$address->{$key}."']);";
                   }
                 }
                 $addressIt++;
                }

                $emails = $customer->emails()->get()->each->decryption();
                $firstEmail = $customer->emails()->first();
                $addressIt = 1;
                echo "i=1;";
                foreach($emails as $email){
                  echo  "t3.row.add([i++, '<span style=\"text-transform:capitalize\"><strong>Customer Email #".$addressIt."</strong></span>', '']);";
                  foreach(array_keys($firstEmail->toArray()) as $key){
                   if($key == "id"){
                     echo  "t3.row.add([i++, '<span style=\"text-transform:capitalize\">Email #".$addressIt.": ID</span>', '".$email->{$key}."']);";
                   } else if($key == "verified"|| $key == "successful"){
                     echo "t3.row.add([i++, '<span style=\"text-transform:capitalize\">".str_replace("_"," ",$key)."</span>', '";
                     echo ($email->{$key} == 1) ? "<img src=\"/img/yes.png\" style=\"height:15px;\"></img>" : "<img src=\"/img/empty.png\" style=\"height:15px;\"></img>";
                     echo "']);";
                   } else {
                     echo  "t3.row.add([i++, '<span style=\"text-transform:capitalize\">Email #".$addressIt.": ".str_replace("_"," ",$key)."</span>', '".$email->{$key}."']);";
                   }
                 }
                 $addressIt++;
                }

                $phones = $customer->phones()->get()->each->decryption();
                $firstPhone = $customer->phones()->first();
                $addressIt = 1;
                echo "i=1;";
                foreach($phones as $phone){
                  echo  "t4.row.add([i++, '<span style=\"text-transform:capitalize\"><strong>Customer Phone #".$addressIt."</strong></span>', '']);";
                  foreach(array_keys($firstPhone->toArray()) as $key){
                   if($key == "id"){
                     echo  "t4.row.add([i++, '<span style=\"text-transform:capitalize\">Phone #".$addressIt.": ID</span>', '".$phone->{$key}."']);";
                   } else if($key == "verified"|| $key == "successful"){
                     echo "t4.row.add([i++, '<span style=\"text-transform:capitalize\">".str_replace("_"," ",$key)."</span>', '";
                     echo ($phone->{$key} == 1) ? "<img src=\"/img/yes.png\" style=\"height:15px;\"></img>" : "<img src=\"/img/empty.png\" style=\"height:15px;\"></img>";
                     echo "']);";
                   } else if($key == "phone_type"){
                     //home,work,mobile,connection
                     echo "t4.row.add([i++, '<span style=\"text-transform:capitalize\">".str_replace("_"," ",$key)."</span>', '";
                     if($phone->{$key} == 1){
                       echo "Home";
                     } else if ($phone->{$key} == 2){
                       echo "Work";
                     } else if ($phone->{$key} == 3){
                       echo "Mobile";
                     } else if ($phone->{$key} == 4){
                       echo "Connection";
                     }
                     echo "']);";
                   } else {
                     echo  "t4.row.add([i++, '<span style=\"text-transform:capitalize\">Phone #".$addressIt.": ".str_replace("_"," ",$key)."</span>', '".$phone->{$key}."']);";
                   }
                 }
                 $addressIt++;
                }
                ?>



              t1.draw(false);
              t2.draw(false);
              t3.draw(false);
              t4.draw(false);
          }
          </script>
          <script>
          function makeTable(){
              t1 = $('#customerTable1').DataTable({
                          dom: 'Bfrtip',
                          responsive: 'true',
                          pageLength: 7,
                          buttons: [
                              'copy', 'csv', 'excel', 'pdf', 'print'
                          ]
                      });
                      t2 = $('#customerTable2').DataTable({
                                  dom: 'Bfrtip',
                                  responsive: 'true',
                                  pageLength: 7,
                                  buttons: [
                                      'copy', 'csv', 'excel', 'pdf', 'print'
                                  ]
                              });
                              t3 = $('#customerTable3').DataTable({
                                          dom: 'Bfrtip',
                                          responsive: 'true',
                                          pageLength: 8,
                                          buttons: [
                                              'copy', 'csv', 'excel', 'pdf', 'print'
                                          ]
                                      });
                                      t4 = $('#customerTable4').DataTable({
                                                  dom: 'Bfrtip',
                                                  responsive: 'true',
                                                  pageLength: 9,
                                                  buttons: [
                                                      'copy', 'csv', 'excel', 'pdf', 'print'
                                                  ]
                                              });
                      populateTabl();
          }
      </script>
      <script>
        makeTable();
      </script>
