

<?php
   echo Form::open(array('url' => route('upload.file'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
   echo '<input type="hidden" name="MAX_FILE_SIZE" value="4194304000" /> ';
echo '<fieldset>
    <legend>Import Customer Data</legend>';
   echo 'Select the .xlsx file to upload.';
   echo Form::file('csvFile', ['required', 'accept' => '.xlsx']);
   echo '</br>';
   echo Form::submit('Upload XLSX File', ['class' => 'btn btn-primary custom-btn-submit']);
   echo '</fieldset>';

   echo '<hr>';
   echo '<h4>Expected file headings:</h4>';
   echo '<div style="width:100%; overflow-x:auto;">';
   echo '<table class="table table-hover table-nomargin table-bordered">';
   echo '<thead>';
   echo '<tr>';
   $fields = [
     "Customer import files have dynamic numbers and of fields. Please contact development for further information.",
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
