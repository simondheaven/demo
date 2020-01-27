<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Everest') }}</title>
    <script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/fh-3.1.4/datatables.min.css"/>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/b-html5-1.5.1/cr-1.4.1/r-2.2.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/b-1.5.1/b-html5-1.5.1/cr-1.4.1/r-2.2.1/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-1.10.16/b-1.5.1/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if(session('success'))
    <script>
        function beginImport(){
          var customerImportXHTTP{{session('success')}} = new XMLHttpRequest();
          customerImportXHTTP{{session('success')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if(this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginImport();
              }, 500);
            }
          };
          customerImportXHTTP{{session('success')}}.open("GET", "{{url('/begin/import/'.session('success'))}} ", true);
          customerImportXHTTP{{session('success')}}.send();
        }

        setTimeout(function(){
          beginImport();
        }, 500);
    </script>
    @endif

    @if(session('emailBounce'))
    <script>
        function beginEmailBounceImport(){
          var emailBounceImportXHTTP{{session('emailBounce')}} = new XMLHttpRequest();
          emailBounceImportXHTTP{{session('emailBounce')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if(this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginEmailBounceImport();
              }, 500);
            }
          };
          emailBounceImportXHTTP{{session('emailBounce')}}.open("GET", "{{url('/begin/update/'.session('emailBounce'))}} ", true);
          emailBounceImportXHTTP{{session('emailBounce')}}.send();
        }

        setTimeout(function(){
          beginEmailBounceImport();
        }, 500);
    </script>
    @endif

    @if(session('mailBounce'))
    <script>
        function beginMailBounceImport(){
          var mailBounceImportXHTTP{{session('mailBounce')}} = new XMLHttpRequest();
          mailBounceImportXHTTP{{session('mailBounce')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if(this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginMailBounceImport();
              }, 500);
            }
          };
          mailBounceImportXHTTP{{session('mailBounce')}}.open("GET", "{{url('/begin/goneaway/'.session('mailBounce'))}} ", true);
          mailBounceImportXHTTP{{session('mailBounce')}}.send();
        }

        setTimeout(function(){
          beginMailBounceImport();
        }, 500);
    </script>
    @endif

    @if(session('phoneBounce'))
    <script>
        function beginPhoneBounceImport(){
          var phoneBounceImportXHTTP{{session('phoneBounce')}} = new XMLHttpRequest();
          phoneBounceImportXHTTP{{session('phoneBounce')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if(this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginPhoneBounceImport();
              }, 500);
            }
          };
          phoneBounceImportXHTTP{{session('phoneBounce')}}.open("GET", "{{url('/begin/phone/update/'.session('phoneBounce'))}} ", true);
          phoneBounceImportXHTTP{{session('phoneBounce')}}.send();
        }

        setTimeout(function(){
          beginPhoneBounceImport();
        }, 500);
    </script>
    @endif

    @if(session('chequeUpload'))
    <script>
        function beginChequeUpload(){
          var chequeUploadXHTTP{{session('chequeUpload')}} = new XMLHttpRequest();
          chequeUploadXHTTP{{session('chequeUpload')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if(this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginChequeUpload();
              }, 500);
            }
          };
          chequeUploadXHTTP{{session('chequeUpload')}}.open("GET", "{{ url('/begin/cheque/update/'.session('chequeUpload')) }} ", true);
          chequeUploadXHTTP{{session('chequeUpload')}}.send();
        }

        setTimeout(function(){
          beginChequeUpload();
        }, 500);
    </script>
    @endif

    @if(session('bacsUpload'))
    <script>
        function beginBacsUpload(){
          var beginBacsUploadXHTTP{{session('bacsUpload')}} = new XMLHttpRequest();
          beginBacsUploadXHTTP{{session('bacsUpload')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if (this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginBacsUpload();
              }, 500);
            }
          };
          beginBacsUploadXHTTP{{session('bacsUpload')}}.open("GET", "{{ url('/begin/bacs/update/'.session('bacsUpload')) }} ", true);
          beginBacsUploadXHTTP{{session('bacsUpload')}}.send();
        }

        setTimeout(function(){
          beginBacsUpload();
        }, 500);
    </script>
    @endif

    @if(session('custDeetUpload'))
    <script>
        function beginCustomerDetailsUpload(){
          var customerDetailsUploadXHTTP{{session('custDeetUpload')}} = new XMLHttpRequest();
          customerDetailsUploadXHTTP{{session('custDeetUpload')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //do nothing
            } else if (this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                beginCustomerDetailsUpload();
              }, 500);
            }
          };
          customerDetailsUploadXHTTP{{session('custDeetUpload')}}.open("GET", "{{ url('/begin/custdeet/update/'.session('custDeetUpload')) }} ", true);
          customerDetailsUploadXHTTP{{session('custDeetUpload')}}.send();
        }

        setTimeout(function(){
          beginCustomerDetailsUpload();
        }, 500);
    </script>
    @endif

    @if(session('reportGen'))
    <script>
        function beginReport(){
          var beginReportXHTTP{{session('reportGen')}} = new XMLHttpRequest();
          beginReportXHTTP{{session('reportGen')}}.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

            } else if (this.readyState == 4 && (this.status == 403 || this.status == 404)){
              setTimeout(function(){
                  beginReport();
              }, 500);
            }
          };
          beginReportXHTTP{{session('reportGen')}}.open("GET", "{{ url('/begin/report/gen/'.session('reportGen')) }} ", true);
          beginReportXHTTP{{session('reportGen')}}.send();
        }

        setTimeout(function(){
            beginReport();
        }, 500);
    </script>
    @endif

    <?php
        if (\Auth::user()){
          $uploads = \Auth::user()->uploads()->where('import_complete', 0)->where('import_error', 0)->orderBy('id','desc')->get();
          $bounces = \Auth::user()->bounces()->where('import_complete', 0)->where('import_error', 0)->orderBy('id','desc')->get();
          $phonebounces = \Auth::user()->phonebounces()->where('import_complete', 0)->where('import_error', 0)->orderBy('id','desc')->get();
          $mailbounces = \Auth::user()->mailbounces()->where('import_complete', 0)->where('import_error', 0)->orderBy('id','desc')->get();
          $exports = \Auth::user()->exports()->where('contact_completed', 0)->count();
          $chequeuploads = \Auth::user()->chequeuploads()->where('import_complete',0)->where('import_error',0)->orderBy('id','desc')->get();
          $bacsimports = \Auth::user()->bacsimports()->where('import_complete', 0)->where('import_error',0)->orderBy('id', 'desc')->get();
          $custdeetuploads = \Auth::user()->customerdetailsuploads()->where('import_complete', 0)->where('import_error',0)->orderBy('id', 'desc')->get();
          $reports = \Auth::user()->reports()->where('downloaded',0)->orderBy('id','desc')->get();
        }
     ?>
</head>
<body>
    <div id="app">
        @include('partials.nav')

        @yield('content')

          @if(isset($uploads))
            @if($uploads->count() > 0)
              @include('partials.import.progress')
            @endif
          @endif

          @if(isset($bounces))
            @if($bounces->count() > 0)
              @include('partials.import.emmybounce')
            @endif
          @endif

          @if(isset($phonebounces))
            @if($phonebounces->count() > 0)
              @include('partials.import.smsbounceprogress')
            @endif
          @endif

          @if(isset($mailbounces))
            @if($mailbounces->count() > 0)
              @include('partials.import.mailbounceprogress')
            @endif
          @endif

          @if(isset($chequeuploads))
            @if($chequeuploads->count() > 0)
              @include('partials.import.chequeprogress')
            @endif
          @endif

          @if(isset($bacsimports))
            @if($bacsimports->count() > 0)
              @include('partials.import.bacsprogress')
            @endif
          @endif

          @if(isset($custdeetuploads))
            @if($custdeetuploads->count() > 0)
              @include('partials.import.custdetprogress')
            @endif
          @endif
          
          @if(isset($reports))
            @if($reports->count() > 0)
              @include('partials.reporting.progress')
            @endif
          @endif

    </div>
    @if(session('fileTypeError'))
      @include('partials.import.fileerror')
    @endif

    @if(session('userRegistered'))
      @include('partials.userregistered')
    @endif

    @if(session('passwordsDontMatch'))
          @include('partials.pwdmessage')
    @endif

    @if(session('passwordTooShort'))
          @include('partials.pwdmessage')
    @endif

    @if(session('passwordUpdated'))
          @include('partials.pwdmessage')
    @endif

    @if(session('passwordLowComplexity'))
          @include('partials.pwdmessage')
    @endif

    <!-- Scripts -->
    <!--script src="{{ asset('js/app.js') }}"></script-->
    <link href="{{ asset('css/everest.css') }}" rel="stylesheet">
</body>
</html>
