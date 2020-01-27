
<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      Browsing <strong>{{session('browseResults')['total']}}</strong> Customers
    </div>
    <div class="panel-body custom-body">

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <legend>Browsing <strong>{{session('browseResults')['total']}}</strong> Customers</legend>
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
      <?php
        $results = json_decode(session('browseResults')['init_customers']);
        $customerKeys = \App\Customer::tableFieldSet();
        foreach($results as $result){
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
    function populateTableOld(){
        //t.clear();
        <?php
        /*
        $results = json_decode(session('browseResults')['init_customers']);
        foreach ($results as $result)
            {
              if($result->completed == -1){
                $completed = "Five attempts made, not paid";
              }
              if($result->completed == 0){
                $completed = "Not paid";
              }
              if($result->completed == 1){
                $completed = "Payment failed";
              }
              if($result->completed == 2){
                $completed = "Paid";
              }
              $add1 = "";
              $add2 = "";
              $add3 = "";
              $add4 = "";
              $add5 = "";
              $add6 = "";
              $add7 = "";
              $addv = "0";
              $emadd = "";
              $emv = "0";
              $hpn = "";
              $hpv = "0";
              $wpn = "";
              $wpv = "0";
              $mpn = "";
              $mpv = "0";
              $cpn = "";
              $cpv = "0";
              $cheque_num = $result->cheque_number;
              foreach(App\AdditionalCheque::where('cid', $result->id)->get() as $chq){
                $cheque_num = $chq->cheque_number;
              }
              foreach(App\CustomerAddress::where('customer_id', $result->id)->get() as $adds){
                $add1 = $adds->address_line1;
                $add2 = $adds->address_line2;
                $add3 = $adds->address_line3;
                $add4 = $adds->address_line4;
                $add5 = $adds->address_line5;
                $add6 = $adds->address_line6;
                $add7 = $adds->address_line7;
                $addv = $adds->verified;
              }
              foreach(App\CustomerEmail::where('customer_id', $result->id)->get() as $adds){
                $emadd = $adds->email_address;
                $emv = $adds->verified;
              }
              foreach(App\CustomerPhone::where('customer_id', $result->id)->where('phone_type',1)->get() as $adds){
                $hpn = $adds->phone_number;
                $hpv = $adds->verified;
              }
              foreach(App\CustomerPhone::where('customer_id', $result->id)->where('phone_type',2)->get() as $adds){
                $wpn = $adds->phone_number;
                $wpv = $adds->verified;
              }
              foreach(App\CustomerPhone::where('customer_id', $result->id)->where('phone_type',3)->get() as $adds){
                $mpn = $adds->phone_number;
                $mpv = $adds->verified;
              }
              foreach(App\CustomerPhone::where('customer_id', $result->id)->where('phone_type',4)->get() as $adds){
                $cpn = $adds->phone_number;
                $cpv = $adds->verified;
              }


            echo 't.row.add([';
            echo '"';
            echo '<a href=\"/call/customer/';
            echo $result->id;
            echo '\">';
            echo $result->full_name;
            echo '</a>';
            echo '"';
            echo ',';
            echo '"';
            echo $result->policy_number;
            echo '"';
            echo ',';
            echo $result->customer_number;
            echo ',';
            echo '"';
            echo $result->id;
            echo '"';
            echo ',';
            echo '"';
            echo $result->unique_id;
            echo '"';
            echo ',';
            echo '"';
            echo $result->initial_verified;
            echo '"';
            echo ',';
            echo '"';
            echo $result->initial_goneaway;
            echo '"';
            echo ',';
            echo '"';
            echo $completed;
            echo '"';
            echo ',';
            echo '"';
            echo $result->last_comm;
            echo '"';
            echo ',';
            echo '"';
            echo $result->last_comm_date;
            echo '"';
            echo ',';
            echo '"';
            echo $result->title;
            echo '"';
            echo ',';
            echo '"';
            echo $result->first_name;
            echo '"';
            echo ',';
            echo '"';
            echo $result->surname;
            echo '"';
            echo ',';
            echo '"';
            echo $add1;
            echo '"';
            echo ',';
            echo '"';
            echo $add2;
            echo '"';
            echo ',';
            echo '"';
            echo $add3;
            echo '"';
            echo ',';
            echo '"';
            echo $add4;
            echo '"';
            echo ',';
            echo '"';
            echo $add5;
            echo '"';
            echo ',';
            echo '"';
            echo $add6;
            echo '"';
            echo ',';
            echo '"';
            echo $add7;
            echo '"';
            echo ',';
            echo '"';
            echo $result->psd_date;
            echo '"';
            echo ',';
            echo '"';
            echo $result->mcd_date;
            echo '"';
            echo ',';
            echo '"';
            echo $result->ptd_date;
            echo '"';
            echo ',';
            echo '"';
            echo $result->ps_cancellation_reason;
            echo '"';
            echo ',';
            echo '"';
            echo $result->ps_policy_status;
            echo '"';
            echo ',';
            echo '"';
            echo $result->bps_branch_number;
            echo '"';
            echo ',';
            echo '"';
            echo $result->bps_branch_name;
            echo '"';
            echo ',';
            echo '"';
            echo $result->bps_channel_type;
            echo '"';
            echo ',';
            echo '"';
            echo $result->cover_code_number;
            echo '"';
            echo ',';
            echo '"';
            echo $result->cover_name;
            echo '"';
            echo ',';
            echo '"';
            echo $result->cover_descr;
            echo '"';
            echo ',';
            echo '"';
            echo $emadd;
            echo '"';
            echo ',';
            echo '"';
            echo $hpn;
            echo '"';
            echo ',';
            echo '"';
            echo $wpn;
            echo '"';
            echo ',';
            echo '"';
            echo $mpn;
            echo '"';
            echo ',';
            echo '"';
            echo $cpn;
            echo '"';
            echo ',';
            echo '"';
            echo $result->complaints;
            echo '"';
            echo ',';
            echo '"';
            echo $result->total_paid_to_date_base;
            echo '"';
            echo ',';
            echo '"';
            echo $result->original_canx_reason;
            echo '"';
            echo ',';
            echo '"';
            echo $result->sold_year;
            echo '"';
            echo ',';
            echo '"';
            echo $result->sold_month;
            echo '"';
            echo ',';
            echo '"';
            echo $result->customer_paid;
            echo '"';
            echo ',';
            echo '"';
            echo $result->refunded;
            echo '"';
            echo ',';
            echo '"';
            echo $result->free_premium;
            echo '"';
            echo ',';
            echo '"';
            echo 'Check';
            echo '"';
            echo ',';
            echo '"';
            echo $result->refund;
            echo '"';
            echo ',';
            echo '"';
            echo $result->gross_interest;
            echo '"';
            echo ',';
            echo '"';
            echo $result->not_used_in_letter;
            echo '"';
            echo ',';
            echo '"';
            echo $result->tax_deduct;
            echo '"';
            echo ',';
            echo '"';
            echo $result->cheque_amount;
            echo '"';
            echo ',';
            echo '"';
            echo $result->net_interest;
            echo '"';
            echo ',';
            echo '"';
            echo $addv;
            echo '"';
            echo ',';
            echo '"';
            echo $cheque_num;
            echo '"';
            echo ',';
            echo '"';
            echo $result->data_base;
            echo '"';
            echo ',';
            echo '"';
            echo $result->goneaway;
            echo '"';
            echo ',';
            echo '"';
            echo $result->deceased;
            echo '"';
            echo ',';
            echo '"';
            echo $result->cheque_minus_pound;
            echo '"';
            echo ',';
            echo '"';
            echo $result->cheque_amount_wording;
            echo '"';
            echo ',';
            echo '"';
            echo $result->updated_salutation;
            echo '"';
            echo ',';
            echo '"';
            echo $emv;
            echo '"';
            echo ',';
            echo '"';
            echo $hpv;
            echo '"';
            echo ',';
            echo '"';
            echo $wpv;
            echo '"';
            echo ',';
            echo '"';
            echo $mpv;
            echo '"';
            echo ',';
            echo '"';
            echo $cpv;
            echo '"';
            echo ',';
            echo '"';
            echo $result->sequence;
            echo '"';
            echo ']);';
            };
            */
        ?>
      t.draw(false);
    }
    </script>
    <script>
    function makeTables(){
        t = $('#resultTable').DataTable({
                    dom: 'Bfrtip',
                    order: [[3,'asc']],
                    responsive: 'true',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
                t.clear();
                populateTable();
    }
</script>
<script>
  makeTables();
</script>
<script>
  var attempts = {{session('browseResults')['attempts']}};
  var total = {{session('browseResults')['total']}};
  <?php
      $i = 0;
      $pages = round((session('browseResults')['total']) / 100);

        do{
          echo "var customerKeys=[";
          $p = 0;
          foreach($customerKeys as $ck){
            if($p > 0){
              echo ",";
            }
            echo "'"+$ck+"'";
            $p++;
          }
          echo "];";
          echo "setTimeout(function(){";
          echo "var xhttp".$i." = new XMLHttpRequest();";
          echo "xhttp".$i.".onreadystatechange = function() {";
          echo "if (this.readyState == 4 && this.status == 200) {";

            echo 'var results'.$i.' = JSON.parse(this.responseText);';
            echo 'for (var x = 0; x < results'.$i.'.length; x++){';
              echo 'var custOut = [';
              echo '"<a href=\'/call/customer/"+';
              echo 'results'.$i.'[x]["id"]';
              echo '+"\'><img style=\"height:15px; float:left; margin-top: 3px; margin-right: 5px;\" src=\"/img/human.png\"></img>" +';
              echo 'results'.$i.'[x]["first_name"] + " " + results'.$i.'[x]["surname"]';
              echo '+"</a>"';
              echo ',';
              $cki = 0;
              foreach($customerKeys as $ck){
                if($cki > 0){
                  echo ",";
                }
                echo 'results'.$i.'[x]['.$ck.']';
              }
              echo '];';
              echo 't.row.add(custOut);}';
              echo 't.draw(false);';

              echo "}";
              echo "};";
              echo "xhttp".$i.".open(\"GET\",  \"/ajax/browse/".session('browseResults')['attempts']."/".$i."\", true);";
              echo "xhttp".$i.".send();";
              echo "}, ".(($i * 15)+1).");";
              echo '
              ';

              /*echo 'var completed;';
              echo 'if(results'.$i.'[x]["completed"] == -1){ completed = "Five attempts made, not paid"; }';
              echo 'else if(results'.$i.'[x]["completed"] == 0){ completed = "Not paid"; }';
              echo 'else if(results'.$i.'[x]["completed"] == 1){ completed = "Payment failed"; }';
              echo 'else if(results'.$i.'[x]["completed"] == 2){ completed = "Paid"; }';

              echo 'var email = null;';
              echo 'var emv = 0;';
              echo 'for(var p=0; p<results'.$i.'[x]["emails"].length; p++){';
              echo 'if(results'.$i.'[x]["emails"][p]["verified"] == 1){email = results'.$i.'[x]["emails"][p]["email_address"]; emv=1}';
              echo '}';
              echo 'if(emv == 0){';
                echo 'for(var p=0; p<results'.$i.'[x]["emails"].length; p++){';
                  echo 'email = results'.$i.'[x]["emails"][p]["email_address"];';
                echo '}';
              echo '}';

              echo 'var add1 = null;';
              echo 'var add2 = null;';
              echo 'var add3 = null;';
              echo 'var add4 = null;';
              echo 'var add5 = null;';
              echo 'var add6 = null;';
              echo 'var add7 = null;';
              echo 'var adv = 0;';
              echo 'for(var p=0; p<results'.$i.'[x]["addresses"].length; p++){';
              echo 'if(results'.$i.'[x]["addresses"][p]["verified"] == 1){add1 = results'.$i.'[x]["addresses"][p]["address_line1"]; add2 = results'.$i.'[x]["addresses"][p]["address_line2"]; add3 = results'.$i.'[x]["addresses"][p]["address_line3"]; add4 = results'.$i.'[x]["addresses"][p]["address_line4"]; add5 = results'.$i.'[x]["addresses"][p]["address_line5"]; add6 = results'.$i.'[x]["addresses"][p]["address_line6"]; add7 = results'.$i.'[x]["addresses"][p]["address_line7"]; adv=1}';
              echo '}';
              echo 'if(adv == 0){';
                echo 'for(var p=0; p<results'.$i.'[x]["addresses"].length; p++){';
                  echo 'add1 = results'.$i.'[x]["addresses"][p]["address_line1"];';
                  echo 'add2 = results'.$i.'[x]["addresses"][p]["address_line2"];';
                  echo 'add3 = results'.$i.'[x]["addresses"][p]["address_line3"];';
                  echo 'add4 = results'.$i.'[x]["addresses"][p]["address_line4"];';
                  echo 'add5 = results'.$i.'[x]["addresses"][p]["address_line5"];';
                  echo 'add6 = results'.$i.'[x]["addresses"][p]["address_line6"];';
                  echo 'add7 = results'.$i.'[x]["addresses"][p]["address_line7"];';
                echo '}';
              echo '}';

              echo 'hphone = "None";';
              echo 'hpv = 0;';
              echo 'wphone = "None";';
              echo 'wpv = 0;';
              echo 'mphone = "None";';
              echo 'mpv = 0;';
              echo 'cphone = "None";';
              echo 'cpv = 0;';
              echo 'for(var p=0; p<results'.$i.'[x]["phones"].length; p++){';
                echo 'if(results'.$i.'[x]["phones"][p]["phone_type"] == 1 && hpv == 0){hphone = results'.$i.'[x]["phones"][p]["phone_number"]; hpv = results'.$i.'[x]["phones"][p]["verified"];}';
                echo 'if(results'.$i.'[x]["phones"][p]["phone_type"] == 2 && wpv == 0){wphone = results'.$i.'[x]["phones"][p]["phone_number"]; wpv = results'.$i.'[x]["phones"][p]["verified"];}';
                echo 'if(results'.$i.'[x]["phones"][p]["phone_type"] == 3 && mpv == 0){mphone = results'.$i.'[x]["phones"][p]["phone_number"]; mpv = results'.$i.'[x]["phones"][p]["verified"];}';
                echo 'if(results'.$i.'[x]["phones"][p]["phone_type"] == 4 && cpv == 0){cphone = results'.$i.'[x]["phones"][p]["phone_number"]; cpv = results'.$i.'[x]["phones"][p]["verified"];}';
              echo '}';

              echo 'cheque_number = results'.$i.'[x]["cheque_number"];';
              echo 'for(var p=0; p<results'.$i.'[x]["cheques"].length; p++){';
                echo 'cheque_number = results'.$i.'[x]["cheques"][p]["cheque_number"];';
              echo '}';

              echo 't.row.add([';
              echo '"<a href=\'/call/customer/"+';
              echo 'results'.$i.'[x]["id"]';
              echo '+"\'>" +';
              echo 'results'.$i.'[x]["full_name"]';
              echo '+"</a>"';
              echo ',';
              echo 'results'.$i.'[x]["customer_number"]';
              echo ',';
              echo 'results'.$i.'[x]["policy_number"]';
              echo ',';
              echo 'results'.$i.'[x]["id"]';
              echo ',';
              echo 'results'.$i.'[x]["unique_id"]';
              echo ',';
              echo 'results'.$i.'[x]["initial_verified"]';
              echo ',';
              echo 'results'.$i.'[x]["initial_goneaway"]';
              echo ',';
              echo 'completed';
              echo ',';
              echo 'results'.$i.'[x]["last_comm"]';
              echo ',';
              echo 'results'.$i.'[x]["last_comm_date"]';
              echo ',';
              echo 'results'.$i.'[x]["title"]';
              echo ',';
              echo 'results'.$i.'[x]["first_name"]';
              echo ',';
              echo 'results'.$i.'[x]["surname"]';
              echo ',';
              echo 'add1';
              echo ',';
              echo 'add2';
              echo ',';
              echo 'add3';
              echo ',';
              echo 'add4';
              echo ',';
              echo 'add5';
              echo ',';
              echo 'add6';
              echo ',';
              echo 'add7';
              echo ',';
              echo 'results'.$i.'[x]["psd_date"]';
              echo ',';
              echo 'results'.$i.'[x]["mcd_date"]';
              echo ',';
              echo 'results'.$i.'[x]["ptd_date"]';
              echo ',';
              echo 'results'.$i.'[x]["ps_cancellation_reason"]';
              echo ',';
              echo 'results'.$i.'[x]["ps_policy_status"]';
              echo ',';
              echo 'results'.$i.'[x]["bps_branch_number"]';
              echo ',';
              echo 'results'.$i.'[x]["bps_branch_name"]';
              echo ',';
              echo 'results'.$i.'[x]["bps_channel_type"]';
              echo ',';
              echo 'results'.$i.'[x]["cover_code_number"]';
              echo ',';
              echo 'results'.$i.'[x]["cover_name"]';
              echo ',';
              echo 'results'.$i.'[x]["cover_descr"]';
              echo ',';
              echo 'email';
              echo ',';
              echo 'hphone';
              echo ',';
              echo 'wphone';
              echo ',';
              echo 'mphone';
              echo ',';
              echo 'cphone';
              echo ',';
              echo 'results'.$i.'[x]["complaints"]';
              echo ',';
              echo 'results'.$i.'[x]["total_paid_to_date_base"]';
              echo ',';
              echo 'results'.$i.'[x]["original_canx_reason"]';
              echo ',';
              echo 'results'.$i.'[x]["sold_year"]';
              echo ',';
              echo 'results'.$i.'[x]["sold_month"]';
              echo ',';

              echo 'results'.$i.'[x]["customer_paid"]';
              echo ',';
              echo 'results'.$i.'[x]["refunded"]';
              echo ',';
              echo 'results'.$i.'[x]["free_premium"]';
              echo ',';

              echo '"Check"';
              echo ',';
              echo 'results'.$i.'[x]["refund"]';
              echo ',';
              echo 'results'.$i.'[x]["gross_interest"]';
              echo ',';
              echo 'results'.$i.'[x]["not_used_in_letter"]';
              echo ',';
              echo 'results'.$i.'[x]["tax_deduct"]';
              echo ',';
              echo 'results'.$i.'[x]["cheque_amount"]';
              echo ',';
              echo 'results'.$i.'[x]["net_interest"]';
              echo ',';
              echo 'adv';
              echo ',';
              echo 'cheque_number';
              echo ',';
              echo 'results'.$i.'[x]["data_base"]';
              echo ',';
              echo 'results'.$i.'[x]["goneaway"]';
              echo ',';
              echo 'results'.$i.'[x]["deceased"]';
              echo ',';
              echo 'results'.$i.'[x]["cheque_minus_pound"]';
              echo ',';
              echo 'results'.$i.'[x]["cheque_amount_wording"]';
              echo ',';
              echo 'results'.$i.'[x]["updated_salutation"]';
              echo ',';
              echo 'emv';
              echo ',';
              echo 'hpv';
              echo ',';
              echo 'wpv';
              echo ',';
              echo 'mpv';
              echo ',';
              echo 'cpv';
              echo ',';
              echo 'results'.$i.'[x]["sequence"]';
              echo ']);';

              echo '}';
              echo 't.draw(false);';

          echo "}";
          echo "};";
          echo "xhttp".$i.".open(\"GET\",  \"/ajax/browse/".session('browseResults')['attempts']."/".$i."\", true);";
          echo "xhttp".$i.".send();";
          echo "}, ".(($i * 15)+1).");";
          echo '
          ';*/
          $i++;
        } while ($i < $pages);

   ?>
</script>
