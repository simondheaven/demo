<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      History
    </div>
    <div class="panel-body custom-body">
      <div class="row row-fluid">
        <?php
          $relevantOnes = [];
          foreach($export_import as $io){
            if(
              get_class($io) == "App\CustomerExport" || get_class($io) == "App\MailBounceUpload" || get_class($io) == "App\CustomerDetailsUpload" ||
              get_class($io) == "App\BacsImport" || get_class($io) == "App\PhoneBounceUpload" || get_class($io) == "App\ChequeUpload" ||
              get_class($io) == "App\EmailBounceUpload"
            ){
              $handled = false;
              $export_ids = json_decode($io->customer_ids_json);
              foreach($export_ids as $q){
                if($q == $customer->id){
                  $handled = true;
                }
              }
            } else if(get_class($io) == "App\Upload"){
              $handled = false;
              if($io->id == $customer->upload_id){
                $handled = true;
              }
            } else if(get_class($io) == "App\ManualUpdates"){
              $handled = true;
            }
            if($handled == true){
              array_push($relevantOnes, $io);
            }
          }
        ?>
        <div style="text-align:center; width:96%; margin-left:2%; margin-right:2%;">
          <h4>Key:</h4>
          <div style="display:grid; grid-template-columns: 1fr 1fr 1fr 1fr;">
            <p><strong>E</strong>: Customer Export</p>
            <p><strong>B</strong>: Bounce Upload</p>
            <p><strong>P</strong>: Payment Details Upload</p>
            <p><strong>D</strong>: Customer Details Update</p>
          </div>
        <div style="@if(count($relevantOnes) > 5) width:100%; @elseif(count($relevantOnes) > 3) width:50%; margin-left:auto; margin-right:auto; @else  width:15%; margin-left:auto; margin-right:auto; @endif display:grid; grid-template-columns: repeat({{count($relevantOnes) + count($relevantOnes) -1}},1fr);">
          <?php
            $riocounter = 1;
          ?>
          @foreach(array_reverse($relevantOnes) as $rio)
            <?php
              $description = "Included in an instance of ";
              $description .= str_replace("App\\","",get_class($rio));
              $description .= " - ";
              $description .= $rio->created_at->format('l d F Y');
              $description .= ".";
              if(get_class($rio) == "App\\ManualUpdates"){
                $description .= " Customer ".$rio->update_type." was updated.";
              }
              if(get_class($rio) == "App\\CustomerExport"){
                $description .= " File:\"".$rio->filename."\"";
              }
            ?>
            <div title="{{$description}}" style="text-align:center; background: url('/img/empty.png'); background-size:contain; background-position:center; background-repeat:no-repeat;">
              <span style="text-align:center;">
                @if(strpos(get_class($rio), "Export") !== false)
                  <img src="/img/e.svg" style="width:80%; height:80%; margin-top: 10%;margin-bottom:10%;"></img>
                @elseif(strpos(get_class($rio), "Bounce") !== false)

                  <img src="/img/b.svg" style="width:80%; height:80%; margin-top: 10%;margin-bottom:10%;"></img>

                @elseif(strpos(get_class($rio), "Bacs") !== false || strpos(get_class($rio), "Cheque") !== false)
                  <img src="/img/p.svg" style="width:80%; height:80%; margin-top: 10%;margin-bottom:10%;"></img>
                @else
                  <img src="/img/d.svg" style="width:80%; height:80%; margin-top: 10%; margin-bottom:10%;"></img>
                @endif
              </span>
            </div>
              @if($riocounter < count($relevantOnes))
              <div style="text-align:center";>
                <img src="/img/rightarrow.png" style="width:100%;"></img>
              </div>

              @endif
            <?php
              $riocounter++;
            ?>
          @endforeach
        </div>

      </div>
        <p>&nbsp;</p>
        <div style="width: 100%; text-align: center;">
          <button onclick="showHideContextualisedHistory(this)" class="btn btn-primary custom-btn-submit">Show contextualised history</button>
          <script>
            contextualisedHistoryVisible = false;
            function showHideContextualisedHistory(button){
              if(contextualisedHistoryVisible == false){
                document.getElementById('contextualised_history').style.display = "inherit";
                button.innerHTML = "Hide contextualised history";
              } else {
                document.getElementById('contextualised_history').style.display = "none";
                button.innerHTML = "Show contextualised history";
              }
              contextualisedHistoryVisible = !contextualisedHistoryVisible;
            }
          </script>
        </div>


        <div id="contextualised_history" class="col-md-12" style="margin-bottom:5px; padding-bottom:5px; background: #FAFAFA; display:none;">
          @foreach($export_import as $io)
          <div class="row row-fluid">
            <div class="col-md-8">

              @if(get_class($io) == "App\CustomerExport")
              <h4 style="margin-bottom:5px;" >Customer Export {{$io->id}}</h4>
              @elseif(get_class($io) == "App\Upload")
              <h4 style="margin-bottom:5px;" >Customer Import {{$io->id}}</h4>
              @elseif(get_class($io) == "App\BacsImport")
              <h4 style="margin-bottom:5px;" >BACS Import {{$io->id}}</h4>
              @elseif(get_class($io) == "App\EmailBounceUpload")
              <h4 style="margin-bottom:5px;" >Email Bounce Import {{$io->id}}</h4>
              @elseif(get_class($io) == "App\ChequeUpload")
              <h4 style="margin-bottom:5px;">Cheque File Import {{$io->id}}</h4>
              @elseif(get_class($io) == "App\PhoneBounceUpload")
              <h4 style="margin-bottom:5px;">SMS Bounce Import {{$io->id}}</h4>
              @elseif(get_class($io) == "App\MailBounceUpload")
              <h4 style="margin-bottom:5px;">Goneaways Import {{$io->id}}</h4>
              @elseif(get_class($io) == "App\ManualUpdates")
              <h4 style="margin-bottom:5px;">Manual Update {{$io->id}}</h4>
              @elseif(get_class($io) == "App\CustomerDetailsUpload")
              <h4 style="margin-bottom:5px;">Customer Details Update {{$io->id}}</h4>
              @else
              <h4 style="margin-bottom:5px;" >{{get_class($io)}} Example</h4>
              @endif
              <span>File: <strong>{{basename($io->filepath)}}</strong></span> </br>
              <span>On: <i>{{date('dS M Y g:i A', strtotime($io->created_at))}}</i>&emsp;&emsp;By: <i>{{ App\User::find($io->uid)->name }}</i></span></br>
            </div>

            <div class="col-md-4" style="text-align:center;">
              </br>
              @if(get_class($io) == "App\CustomerExport")
              <?php
                $handled = false;
                $export_ids = json_decode($io->customer_ids_json);
                foreach($export_ids as $q){
                  if($q == $customer->id){
                    $handled = true;
                  }
                }
              ?>
                @if($handled == true)
                  <img title="Customer was contacted" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>

                @else
                  <img title="Customer was not contacted" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>

                @endif
              @elseif(get_class($io) == "App\Upload")
                <?php
                  $handled = false;
                  if($io->id == $customer->upload_id){
                    $handled = true;
                  }
                ?>
                @if($handled == true)
                  <img title="Customer was imported" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                @else
                  <img title="Customer was not imported" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>

                @endif
                @elseif(get_class($io) == "App\ManualUpdates")
                  @if($io->update_type == 'address')
                  <img title="Customer address was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @elseif($io->update_type == 'email')
                  <img title="Customer email address was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @elseif($io->update_type == 'name')
                  <img title="Customer name was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @elseif($io->update_type == 'phone')
                  <img title="Customer phone number was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @elseif($io->update_type == 'cheque')
                  <img title="Customer cheque was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @elseif($io->update_type == 'deceased')
                  <img title="Customer deceased status was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @elseif($io->update_type == 'suppress')
                  <img title="Customer suppression status was updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @endif

              @elseif(get_class($io) == "App\MailBounceUpload")
              <?php
                $handled = false;
                $export_ids = json_decode($io->customer_ids_json);
                foreach($export_ids as $q){
                  if($q == $customer->id){
                    $handled = true;
                  }
                }
              ?>
                @if($handled == true)
                  <img title="Customer was marked as goneaway" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                @else
                  <img title="Customer information was not changed" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>
                @endif
                @elseif(get_class($io) == "App\CustomerDetailsUpload")
                <?php
                  $handled = false;
                  $export_ids = json_decode($io->customer_ids_json);
                  foreach($export_ids as $q){
                    if($q == $customer->id){
                      $handled = true;
                    }
                  }
                ?>
                  @if($handled == true)
                    @if($io->update_type == "cheques")
                    <img title="Customer cheque details were updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                    @elseif($io->update_type == "nameaddress")
                    <img title="Customer name/address details were updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                    @endif
                  @else
                    <img title="Customer information was not changed" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>
                  @endif
                @elseif(get_class($io) == "App\BacsImport")
                <?php
                  $handled = false;
                  $export_ids = json_decode($io->customer_ids_json);
                  foreach($export_ids as $q){
                    if($q == $customer->id){
                      $handled = true;
                    }
                  }
                ?>
                  @if($handled == true)
                    <img title="Customer was marked as paid" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @else
                    <img title="Customer information was not changed" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>
                  @endif
                @elseif(get_class($io) == "App\PhoneBounceUpload")
                <?php
                  $handled = false;
                  $export_ids = json_decode($io->customer_ids_json);
                  foreach($export_ids as $q){
                    if($q == $customer->id){
                      $handled = true;
                    }
                  }
                ?>
                  @if($handled == true)
                    <img title="SMS bounce was recorded" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @else
                    <img title="Customer information was not changed" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>
                  @endif
                @elseif(get_class($io) == "App\ChequeUpload")
                <?php
                  $handled = false;
                  $export_ids = json_decode($io->customer_ids_json);
                  foreach($export_ids as $q){
                    if($q == $customer->id){
                      $handled = true;
                    }
                  }
                ?>
                  @if($handled == true)
                    <img title="Customer payment details were updated" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                  @else
                    <img title="Customer information was not changed" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>
                  @endif
                  @elseif(get_class($io) == "App\EmailBounceUpload")
                  <?php
                    $handled = false;
                    $export_ids = json_decode($io->customer_ids_json);
                    foreach($export_ids as $q){
                      if($q == $customer->id){
                        $handled = true;
                      }
                    }
                  ?>
                    @if($handled == true)
                      <img title="Email Bounce recorded" name="yes" id="yes" style="height:35px;" src="/img/yes.png"></img>
                    @else
                      <img title="Customer information was not changed" name="yes" id="yes" style="height:35px;" src="/img/empty.png"></img>
                    @endif
              @else
              <img title="History is loading..." name="load" id="load" style="height:35px;" src="/img/loading.gif"></img>
              @endif
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </div>
</div>
