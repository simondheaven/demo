<?php
   echo Form::open(array('url' => route('upload.sent'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
   echo '<input type="hidden" name="MAX_FILE_SIZE" value="4194304000" /> ';
echo '<fieldset>
    <legend>Import Sent File (CSV)</legend>';
   echo 'Select the .csv file to upload.';
   echo Form::file('csvFile', ['required', 'accept' => '.csv']);
   echo '</br>';
   echo Form::submit('Upload CSV File', ['class' => 'btn btn-primary custom-btn-submit']);
   echo '</fieldset>';
   echo Form::close();
?>
</br>
<?php
   echo Form::open(array('url' => route('upload.sent.xls'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
   echo '<input type="hidden" name="MAX_FILE_SIZE" value="4194304000" /> ';
echo '<fieldset>
    <legend>Import Sent File (XLS)</legend>';
   echo 'Select the .xls file to upload.';
   echo Form::file('xlsFile', ['required', 'accept' => '.xls']);
   echo '</br>';
   echo Form::submit('Upload XLS File', ['class' => 'btn btn-primary custom-btn-submit']);
   echo '</fieldset>';
   echo Form::close();
?>
