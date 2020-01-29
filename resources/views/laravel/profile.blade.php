@extends('laravel.layouts.app')

@section('content')

<div class="profile-main-container">

  <div style="display:grid; grid-template-columns: 1fr 3fr; grid-gap: 15px;">

    <div value="1col" style="width: 150px;">

      <div>
        <?php
          $img = $user->profilePic()->first();
          if(!$img){
            $img = config('app.url').'/img/user.svg';
          } else {
            $img = config('app.url').'/images/'.$img->filename;
          }
        ?>
        <img style="max-width: 150px; width: 100%; border-radius:100%;" src="{{$img}}"></img>
      </div>
      <hr>
      @if($user->id == \Auth::user()->id)
      <div>
        <h9><small>Update profile picture:</small></h9>
        <form style="height: 15vh; box-sizing:border-box; overflow:auto; border-bottom:0px;" method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
          {{csrf_field()}}
        </form>
        <form method="POST" action ="{{route('update.profile.pic')}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
          <input type="hidden" name="fileIDs" id="imageFileIDs" value=""></input>
          <button style="width: 100%;" class="btn btn-outline-success">Submit</button>
        </form>
      </div>
      @endif
    </div>

    <div value="3col">
      <h3>{{$user->name}}</h3>
      <p style="margin-top: -10px;"><small>Member since {{Carbon\Carbon::parse($user->created_at)->format('l d F Y')}}</small></p>
      <hr>
      <h6>Posts: {{$user->posts()->count()}}</h6>
      <h6>Comments: {{$user->comments()->count()}}</h6>
      <h6>Updoots given: {{$user->doots()->where('value',1)->count()}}</h6>
      <h6>Downdoots given: {{$user->doots()->where('value',-1)->count()}}</h6>
      <hr>
      <div style="width:100%;"><h5>Recent activity:</h5></div>
      <div id="chart2" style="width:100%; height: 300px;">
        <div style="width:100%; text-align:center"><img src="/img/loading.gif"></img></div>
      </div>
      <hr>
      <div style="width:100%;"><h5>Posts by type:</h5></div>
      <div id="chart1" style="width:100%; height: 300px;">
        <div style="width:100%; text-align:center"><img src="/img/loading.gif"></img></div>
      </div>
    </div>

  </div>



</div>

<script>

  function drawChart1(){
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Post Type');
    data.addColumn('number', 'Posts');
    data.addRows([
      ['Text', {{ $user->posts()->where('post_type', 'TEXT')->count() }}],
      ['Image', {{ $user->posts()->where('post_type', 'IMAGE')->count() }}],
      ['Video', {{ $user->posts()->where('post_type', 'VIDEO')->count() }}],
      ['Link', {{ $user->posts()->where('post_type', 'LINK')->count() }}],
    ]);
    // Set chart options
    var options = {'backgroundColor': 'transparent',
                   'is3D':true,
                   'fontName': 'Calibri',
                   'sliceVisibilityThreshold':0,
                   'legend' : {
                     'position' : 'bottom',
                     'maxLines': 50,
                     'textStyle': {
                       'fontName': 'Calibri',
                       'fontSize': 14
                     }
                   }
                   };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart1'));
    chart.draw(data, options);
    drawChart2();
  }

  function drawChart2(){
    var data = google.visualization.arrayToDataTable([
          ['Day', 'Posts', 'Upvotes', 'Downvotes', 'Comments'],
          ['{{Carbon\Carbon::now()->addDays(-6)->format('l')}}',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->addDays(-6)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-6)->endOfDay())->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-6)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-6)->endOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-6)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-6)->endOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->addDays(-6)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-6)->endOfDay())->count()}}],
          ['{{Carbon\Carbon::now()->addDays(-5)->format('l')}}',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->addDays(-5)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-5)->endOfDay())->count()}}
            ,{{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-5)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-5)->endOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-5)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-5)->endOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->addDays(-5)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-5)->endOfDay())->count()}}],

          ['{{Carbon\Carbon::now()->addDays(-4)->format('l')}}',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->addDays(-4)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-4)->endOfDay())->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-4)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-4)->endOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-4)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-4)->endOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->addDays(-4)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-4)->endOfDay())->count()}}],

          ['{{Carbon\Carbon::now()->addDays(-3)->format('l')}}',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->addDays(-3)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-3)->endOfDay())->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-3)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-3)->endOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-3)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-3)->endOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->addDays(-3)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-3)->endOfDay())->count()}}],

          ['{{Carbon\Carbon::now()->addDays(-2)->format('l')}}',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->addDays(-2)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-2)->endOfDay())->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-2)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-2)->endOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-2)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-2)->endOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->addDays(-2)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-2)->endOfDay())->count()}}],

          ['Yesterday',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->addDays(-1)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-1)->endOfDay())->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-1)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-1)->endOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->addDays(-1)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-1)->endOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->addDays(-1)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-1)->endOfDay())->count()}}],

          ['Today',
            {{$user->posts()->where('created_at', '>', Carbon\Carbon::now()->startOfDay())->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->startOfDay())->where('value',1)->count()}},
            {{$user->doots()->where('created_at', '>', Carbon\Carbon::now()->startOfDay())->where('value',-1)->count()}},
            {{$user->comments()->where('created_at', '>', Carbon\Carbon::now()->startOfDay())->count()}}],

        ]);

        var options = {
          title: '',
          curveType: 'none',
          fontName: 'Calibri',
          backgroundColor: 'transparent',
          legend: { position: 'bottom', 'textStyle': {
            'fontName': 'Calibri',
            'fontSize': 14
          }}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart2'));

        chart.draw(data, options);
  }

  setTimeout(function(){
    updateNavLinks('nav-link-2');
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart1);
  }, 1000);

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@endsection
