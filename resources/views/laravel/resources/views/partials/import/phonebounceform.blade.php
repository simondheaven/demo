<?php
   echo Form::open(array('url' => route('upload.phone.bounce'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
echo '<fieldset>
    <legend>Import SMS Bounce Data</legend>';
   echo 'Select the .csv file to upload.';
   echo Form::file('csvFile', ['required', 'accept' => '.csv']);
   echo '</br>';
   echo Form::submit('Upload CSV File', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'showa()']);
   echo '</fieldset>';
   echo '<hr>';
   echo '<h4>Expected file headings:</h4>';
   echo '<div style="width:100%; overflow-x:auto;">';
   echo '<table class="table table-hover table-nomargin table-bordered">';
   echo '<thead>';
   echo '<tr>';
   $fields = [
     "Sent Date",
     "Broadcast Name",
     "Contacts Group",
     "Mobile Number",
     "Message",
     "Delivery Status"
   ];
   $i = 1;
   foreach($fields as $field){
     echo '<th style="text-align:center;">';
     echo 'Field #'.$i++;
     echo '</th>';
   }
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   echo '<tr>';
   foreach($fields as $field){
     echo '<td style="text-align:center; white-space:nowrap;">';
     echo $field;
     echo '</td>';
   }
   echo '</tr>';
   echo '</tbody>';
   echo '</table>';
   echo '</div>';
   echo Form::close();
?>
