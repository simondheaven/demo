

<?php
   echo Form::open(array('url' => route('upload.mail.bounce'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
echo '<fieldset>
    <legend>Import Goneaway Data</legend>';
   echo 'Select the .xlsx file to upload.';
   echo Form::file('xlsxFile', ['required', 'accept' => '.xlsx']);
   echo '</br>';
   echo Form::submit('Upload XLSX File', ['class' => 'btn btn-primary custom-btn-submit', 'onclick' => 'showa()']);
   echo '</fieldset>';
   echo '<hr>';
   echo '<h4>Expected file headings:</h4>';
   echo '<div style="width:100%; overflow-x:auto;">';
   echo '<table class="table table-hover table-nomargin table-bordered">';
   echo '<thead>';
   echo '<tr>';
   $fields = [
     "No Header row, unique_ids in a single column",
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
