<!doctype html>
<html lang="{{ app()->getLocale() }}">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Laravel Social App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <style>
      body {
        background-image: url('/img/mainbg.svg');
        background-size: 65vw;
        background-position:bottom right;
        background-repeat: no-repeat;
        background-attachment: fixed;
        max-width: 100vw;
        width: 100vw;
        overflow-x: hidden;
      }
      .main-column {
        width: 80vw;
        margin-left: 10vw;
        margin-right: 10vw;
        background: radial-gradient(white,white,lightblue);
        box-shadow: 0px 0px 15px black;
        padding: 75px 15px 15px 15px;
      }

      .nav-item > a {
        -webkit-transition: all 1s ease-in;
        -moz-transition: all 1s ease-in;
        -ms-transition: all 1s ease-in;
        -o-transition: all 1s ease-in;
      }
    </style>
    <link rel="stylesheet" href="{{config('app.url').'/css/laravel/auth.css'}}"></link>
    <link rel="stylesheet" href="{{config('app.url').'/css/laravel/dashboard.css'}}"></link>
  <body>
    @include('laravel.partials.nav')
    <div class="main-column">
      @yield('content')
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
  <script type="text/javascript">
    Dropzone.options.dropzone = {
      maxFilesize: 50,
      renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        var ext = file.name.substr(file.name.lastIndexOf('.'));
        var random = Math.floor((Math.random() * 999) + 1);
        return random+"-"+time+ext;
      },
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
      addRemoveLinks: true,
      timeout: 5000,
      removedfile: function(file) {
        var name = file.upload.filename;
        var token = "{{csrf_token()}}";
        $.ajax({headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                url: '{{ url("image/delete") }}',
                data: {filename: name},
                success: function (data){
                  console.log("File has been successfully removed!!");
                },
                error: function(e) {
                        console.log(e);
                }
              });
        var fileRef;
        return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
      },
      success: function(file, response) {
        console.log(response);
        imageFileUploaded(response);
      }, error: function(file, response) {
        if (!file.accepted){
          alert("Sorry, only .jpeg, .jpg, .png and .gif images are accepted.");
          this.removeFile(file);
        }
        return false;
      }
    };

    jQuery(function($) {
            $('.timeline-inner').on('scroll', function() {
                if ($(this).scrollTop() +
                    $(this).innerHeight() >=
                    $(this)[0].scrollHeight) {
                    getTimelineChunk();
                }
            });
        });
  </script>
  <script>

    var navLinks = [
        'nav-link-1',
        'nav-link-2',
        'nav-link-3'
    ];

    function updateNavLinks(id){
      for(var i=0; i < navLinks.length; i++){
        document.getElementById(navLinks[i]).classList.remove("active");
      }
      document.getElementById(id).classList.add('active');
    }

    function imageFileUploaded(response){
      var fileIDs = document.getElementById('imageFileIDs');
      if(fileIDs.value == ""){
        fileIDs.value = response.success;
      } else {
        fileIDs.value = fileIDs.value + "," + response.success;
      }
    }

  </script>
</html>
