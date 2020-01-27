

<?php
echo Form::open(array('url' => route('upload.custdeets.file.two'),'files'=>'true'));
   echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
echo '<fieldset>
    <legend>Import New Cheques File</legend>';
   echo 'Select the .csv file to upload.';
   echo Form::file('csvFile', ['required', 'accept' => '.csv']);
   echo '</br>';
   echo Form::submit('Upload CSV File', ['class' => 'btn btn-primary custom-btn-submit']);
   echo '</fieldset>';
   echo Form::close();
?>
