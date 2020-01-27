@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <div class="custom-tabs">
            <script>
              function bouncedEmail(){
                window.location.replace('/import/emails');
              }
              function custData(){
                window.location.replace('/import');
              }
              function phoneData(){
                window.location.replace('/import/phones');
              }
              function chqStatus(){
                window.location.replace('/import/cheque');
              }
              function goneAway(){
                window.location.replace('/import/goneaway');
              }
              function impBacs(){
                window.location.replace('/import/bacs');
              }
            </script>
            <button onclick="custData()" class="btn btn-primary custom-tab custom-tab-active">Customer Data</button>
            <button onclick="bouncedEmail()" class="btn btn-primary custom-tab custom-tab-inactive">Bounced Emails</button>
            <button onclick="phoneData()" class="btn btn-primary custom-tab custom-tab-inactive">Bounced SMS</button>
            <button onclick="goneAway()" class="btn btn-primary custom-tab custom-tab-inactive">Goneaways</button>
            <button onclick="chqStatus()" class="btn btn-primary custom-tab custom-tab-inactive">Cheques</button>
            <button onclick="impBacs()" class="btn btn-primary custom-tab custom-tab-inactive">BACS</button>
          </div>
            <div class="panel panel-default">

                <div id="page1">
                  <div class="panel-heading custom-heading">
                    Import Customer Data
                  </div>
                  <div class="panel-body custom-body">
                    @include('partials.import.importform')
                  </div>
                  <div class="panel-body custom-body">
                    @include('partials.import.custdeetimportform')
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
