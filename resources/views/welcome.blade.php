<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                background-image: url('/img/mainbg.svg');
                background-size: 55vw;
                background-position: bottom right;
                background-repeat: no-repeat;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
                opacity: 1;
                font-family: 'Raleway', sans-serif;
                -webkit-transition: opacity 3s ease-in-out;
                -moz-transition: opacity 3s ease-in-out;
                -ms-transition: opacity 3s ease-in-out;
                -o-transition: opacity 3s ease-in-out;
            }
            .fadeout {
              opacity: 0;
            }
            .selection-image {
              height:15vh;
              max-width: 20vw;
              filter:grayscale();
              opacity: 0.6;
              -webkit-transition: all 0.7s ease-in-out;
              -moz-transition: all 0.7s ease-in-out;
              -ms-transition: all 0.7s ease-in-out;
              -o-transition: all 0.7s ease-in-out;
            }
            .selection-container-container{
              max-height: 50vh;
              max-width: 90vw;
              overflow-y: hidden;
              margin-top: 0;
              -webkit-transition: all 3s ease-in-out;
              -moz-transition: all 3s ease-in-out;
              -ms-transition: all 3s ease-in-out;
              -o-transition: all 3s ease-in-out;
            }
            .selection-container{
              margin-top: 200vh;
              padding: 15px;
              border-radius: 15%;
              -webkit-transition: all 3s ease-in-out;
              -moz-transition: all 3s ease-in-out;
              -ms-transition: all 3s ease-in-out;
              -o-transition: all 3s ease-in-out;
            }
            .selection-container:hover > .selection-description{
              opacity: 1;
            }

            .selection-container:hover{
              background: silver;
              -webkit-box-shadow: inset 10px 10px 5px 0px rgba(0,0,0,0.75);
              -moz-box-shadow: inset 10px 10px 5px 0px rgba(0,0,0,0.75);
              box-shadow: inset 10px 10px 5px 0px rgba(0,0,0,0.75);
              border: 2px solid black;
            }

            .selection-container:hover > .selection-image{
              filter:none;
              height: 20vh;
              opacity: 1;
            }
            .selection-container-float-up{
              margin-top: 0;
            }
            .selection-description {
              opacity: 0;
              -webkit-transition: all 1s ease-in;
              -moz-transition: all 1s ease-in;
              -ms-transition: all 1s ease-in;
              -o-transition: all 1s ease-in;
            }
            .selection-container-container-float-up{
              margin-top: -25vh;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            #doc {
              -webkit-transition: all 1s ease-in;
              -moz-transition: all 1s ease-in;
              -ms-transition: all 1s ease-in;
              -o-transition: all 1s ease-in;

            }
        </style>
        <style src="{{asset('app.css')}}"></style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content" id="doc">

                <div id="welcome" class="title m-b-md">
                    Welcome
                </div>

                <div class="selection-container-container" id="selection-container-container" style="display:grid; grid-template-columns: 1fr 1fr 1fr; grid-gap: 5vw;">

                  <div id="selection-container-1" class="selection-container">
                    <img class="selection-image" src="/img/laravel.svg"></img>
                    <h4>Laravel</h4>
                    <div style="" class="selection-description">
                      <p>
                        <small>
                          View an example Laravel project
                        </small>
                      </p>
                      <button onclick="selectionMade(this.value)" value="LARAVEL" class="btn btn-primary">View</button>
                    </div>
                  </div>

                  <div id="selection-container-2" class="selection-container">
                    <img class="selection-image" src="/img/react.svg"></img>
                    <h4>React</h4>
                    <div style="" class="selection-description">
                      <p>
                        <small>
                          View an example React project
                        </small>
                      </p>
                      <button onclick="selectionMade(this.value)" value="REACT" class="btn btn-primary">View</button>
                    </div>
                  </div>

                  <div id="selection-container-3" class="selection-container">
                    <img class="selection-image" src="/img/java.svg"></img>
                    <h4>Java</h4>
                    <div style="" class="selection-description">
                      <p>
                        <small>
                          View an example Java project
                        </small>
                      </p>
                      <button onclick="selectionMade(this.value)" value="JAVA" class="btn btn-primary">View</button>
                    </div>
                  </div>

                </div>
            </div>
        </div>

        <script>

          function selectionMade(selection){
            //navigates away from this page
            document.getElementById('doc').classList.add('fadeout');
            window.location.href = "/" + selection.toLowerCase();
          }

          function startAnimation(){
            //Triggers animations using css transitions
            setTimeout(function(){
              document.getElementById('welcome').classList.add('fadeout');
              document.getElementById('selection-container-container').classList.add('selection-container-container-float-up');
              document.getElementById('selection-container-1').classList.add('selection-container-float-up');
              setTimeout(function(){
                document.getElementById('selection-container-2').classList.add('selection-container-float-up');
                setTimeout(function(){
                  document.getElementById('selection-container-3').classList.add('selection-container-float-up');
                },100);
              },100);
            },1000);
          }

          startAnimation();
        </script>

        <script src="{{asset('app.js')}}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
