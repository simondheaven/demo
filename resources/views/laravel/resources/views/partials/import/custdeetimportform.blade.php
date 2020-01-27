

<?php
echo Form::open(array('url' => route('upload.custdeets.file'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
echo '<fieldset>
    <legend>Import Name/Address Update File</legend>';
   echo 'Select the .csv file to upload.';
   echo Form::file('csvFile', ['required', 'accept' => '.csv']);
   echo '</br>';
   echo Form::submit('Upload CSV File', ['class' => 'btn btn-primary custom-btn-submit']);
   echo '</fieldset>';
   echo '<hr>';
   echo '<h4>Expected file headings:</h4>';
   echo '<div style="width:100%; overflow-x:auto;">';
   echo '<table class="table table-hover table-nomargin table-bordered">';
   echo '<thead>';
   echo '<tr>';
   $fields = [
     "POLICYNUMBERQUERY1WITHIMACS",
     "UNIQUE_ID",
     "CHEQUE_NUMBER",
     "CHEQUE_AMOUNT",
     "NAME",
     "LETTER_DATE",
     "T",
     "F",
     "S",
     "ADDR1",
     "ADDR2",
     "ADDR3",
     "ADDR4",
     "ADDR5",
     "ADDR6",
     "ADDR7"
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
