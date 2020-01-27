<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}} Statistics</title>

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
        }

        body {
          padding: 2%;
          background-image: url('{{config("app.url")}}/img/undraw_setup_analytics_8qkl.svg');
          background-position: top right;
          background-repeat: no-repeat;
          background-size: 60%;
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
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .page-title-div {
          padding: 25px;
          text-align:center;
        }
    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      <?php
        $todaysExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->startOfDay())->get();
        $todaysExportCustomers = 0;
        foreach($todaysExports as $te){
          $todaysExportCustomers += $te->total_records;
        }
        $todaysManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->startOfDay())->count();

        $yesterdaysExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->addDays(-1)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-1)->endOfDay())->get();
        $yesterdaysExportCustomers = 0;
        foreach($yesterdaysExports as $te){
          $yesterdaysExportCustomers += $te->total_records;
        }
        $yesterdaysManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->addDays(-1)->startOfDay())->where('created_at', '<', Carbon\Carbon::now()->addDays(-1)->endOfDay())->count();

        $twodaysagosExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->addDays(-2)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-2)->endOfDay())->get();
        $twodaysagosExportCustomers = 0;
        foreach($twodaysagosExports as $te){
          $twodaysagosExportCustomers += $te->total_records;
        }
        $twodaysagosManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->addDays(-2)->startOfDay())->where('created_at', '<', Carbon\Carbon::now()->addDays(-2)->endOfDay())->count();
        $twodaysagoname = Carbon\Carbon::now()->addDays(-2)->format('l');

        $threedaysagosExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->addDays(-3)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-3)->endOfDay())->get();
        $threedaysagosExportCustomers = 0;
        foreach($threedaysagosExports as $te){
          $threedaysagosExportCustomers += $te->total_records;
        }
        $threedaysagosManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->addDays(-3)->startOfDay())->where('created_at', '<', Carbon\Carbon::now()->addDays(-3)->endOfDay())->count();
        $threedaysagoname = Carbon\Carbon::now()->addDays(-3)->format('l');

        $fourdaysagosExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->addDays(-4)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-4)->endOfDay())->get();
        $fourdaysagosExportCustomers = 0;
        foreach($fourdaysagosExports as $te){
          $fourdaysagosExportCustomers += $te->total_records;
        }
        $fourdaysagosManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->addDays(-4)->startOfDay())->where('created_at', '<', Carbon\Carbon::now()->addDays(-4)->endOfDay())->count();
        $fourdaysagoname = Carbon\Carbon::now()->addDays(-4)->format('l');

        $fivedaysagosExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->addDays(-5)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-5)->endOfDay())->get();
        $fivedaysagosExportCustomers = 0;
        foreach($fivedaysagosExports as $te){
          $fivedaysagosExportCustomers += $te->total_records;
        }
        $fivedaysagosManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->addDays(-5)->startOfDay())->where('created_at', '<', Carbon\Carbon::now()->addDays(-5)->endOfDay())->count();
        $fivedaysagoname = Carbon\Carbon::now()->addDays(-5)->format('l');

        $sixdaysagosExports = \App\CustomerExport::where('created_at', '>', Carbon\Carbon::now()->addDays(-6)->startOfDay())->where('created_at','<',Carbon\Carbon::now()->addDays(-6)->endOfDay())->get();
        $sixdaysagosExportCustomers = 0;
        foreach($sixdaysagosExports as $te){
          $sixdaysagosExportCustomers += $te->total_records;
        }
        $sixdaysagosManualUpdateCustomers = \App\ManualUpdates::where('created_at', '>', Carbon\Carbon::now()->addDays(-6)->startOfDay())->where('created_at', '<', Carbon\Carbon::now()->addDays(-6)->endOfDay())->count();
        $sixdaysagoname = Carbon\Carbon::now()->addDays(-6)->format('l');

      ?>

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Customers Exported', 'Customer Details Updated'],
          ['{{$sixdaysagoname}}',{{$sixdaysagosExportCustomers}},{{$sixdaysagosManualUpdateCustomers}}],
          ['{{$fivedaysagoname}}',{{$fivedaysagosExportCustomers}},{{$fivedaysagosManualUpdateCustomers}}],
          ['{{$fourdaysagoname}}',{{$fourdaysagosExportCustomers}},{{$fourdaysagosManualUpdateCustomers}}],
          ['{{$threedaysagoname}}',{{$threedaysagosExportCustomers}},{{$threedaysagosManualUpdateCustomers}}],
          ['{{$twodaysagoname}}',{{$twodaysagosExportCustomers}},{{$twodaysagosManualUpdateCustomers}}],
          ['Yesterday', {{$yesterdaysExportCustomers}}, {{$yesterdaysManualUpdateCustomers}} ],
          ['Today',  {{$todaysExportCustomers}},      {{$todaysManualUpdateCustomers}}],
        ]);

        var options = {
          title: '',
          curveType: 'none',
          fontName: 'Calibri',
          backgroundColor: 'transparent',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        drawChart2();
      }

      <?php
      $paidCustomers = \App\Customer::where('completed',2)->count();
      $dsups = \App\Customer::where('contact_suppression', 1)->where('completed', '!=', 2)->count();
      $attempt0 = \App\Customer::where('contact_suppression',0)->where('completed', '!=',2)->where('attempt_1',0)->where('attempt_2',0)->where('attempt_3',0)->where('attempt_4',0)->where('attempt_5',0)->count();
      $attempt1 = \App\Customer::where('contact_suppression',0)->where('completed', '!=',2)->where('attempt_1',1)->where('attempt_2',0)->where('attempt_3',0)->where('attempt_4',0)->where('attempt_5',0)->count();
      $attempt2 = \App\Customer::where('contact_suppression',0)->where('completed', '!=',2)->where('attempt_1',1)->where('attempt_2',1)->where('attempt_3',0)->where('attempt_4',0)->where('attempt_5',0)->count();
      $attempt3 = \App\Customer::where('contact_suppression',0)->where('completed', '!=',2)->where('attempt_1',1)->where('attempt_2',1)->where('attempt_3',1)->where('attempt_4',0)->where('attempt_5',0)->count();
      $attempt4 = \App\Customer::where('contact_suppression',0)->where('completed', '!=',2)->where('attempt_1',1)->where('attempt_2',1)->where('attempt_3',1)->where('attempt_4',1)->where('attempt_5',0)->count();
      $attempt5 = \App\Customer::where('contact_suppression',0)->where('completed', '!=',2)->where('attempt_1',1)->where('attempt_2',1)->where('attempt_3',1)->where('attempt_4',1)->where('attempt_5',1)->count();
      ?>

      function drawChart2(){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Customers');
        data.addRows([
          ['Paid', {{ $paidCustomers }}],
          ['Not Yet Attempted', {{$attempt0}}],
          ['Attempted 1', {{  $attempt1 }}],
          ['Attempted 2', {{  $attempt2 }}],
          ['Attempted 3', {{  $attempt3 }}],
          ['Attempted 4', {{  $attempt4  }}],
          ['Attempted 5+', {{$attempt5}}],
          ['Data Suppressed', {{ $dsups}}],
        ]);
        // Set chart options
        var options = {'backgroundColor': 'transparent',
                       'is3D':true,
                       'fontName': 'Calibri',
                       'sliceVisibilityThreshold':0,
                       'colors': ['limegreen', 'black', '#e5e5ff', '#9999ff', '#4c4cff', '#0000ff', 'midnightblue', 'red'],
                       'legend' : {
                         'position' : 'right',
                         'maxLines': 50,
                         'textStyle': {
                           'fontName': 'Calibri',
                           'fontSize': 9
                         }
                       }
                       };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
        drawChart3();
      }

      <?php
      $allUnpaidCustomers = \App\Customer::where('completed','!=',2)->count();
      $mailCustomers = \App\Customer::where('completed','!=',2)->where('contact_suppression',0)->whereIn('id',\App\CustomerAddress::select('customer_id')->where('verified',1))->count();
      $emailCustomers = \App\Customer::where('completed','!=',2)->where('contact_suppression',0)->whereIn('id',\App\CustomerEmail::select('customer_id')->where(['verified' => 1]))->count();
      $smsCustomers = \App\Customer::where('completed','!=',2)->where('contact_suppression',0)->whereIn('id',\App\CustomerPhone::select('customer_id')->where(['verified' => 1]))->count();
      $dsups2 =\App\Customer::where('contact_suppression', 1)->where('completed', '!=', 2)->count();
      $phoneCustomers = \App\Customer::where('completed','!=',2)->where('contact_suppression',0)->whereIn('id',\App\CustomerPhone::select('customer_id'))->count();
      ?>

      function drawChart3(){
        var data = new google.visualization.DataTable();
        data.addColumn('string','Contact Type');
        data.addColumn('number', 'Customers');
        data.addColumn({type: 'string', role: 'annotation'});
        data.addRows([
          ['Total Unpaid', {{$allUnpaidCustomers}}, 'Σ'],
          ['Mailable', {{$mailCustomers}} ,'✎' ],
          ['Emailable', {{$emailCustomers}} , '✉'],
          ['SMSable', {{$smsCustomers}} , ':-)'],
          ['Callable', {{$phoneCustomers}} , '☏'],
          ['Suppressed', {{$dsups2}}, '✘']
        ]);
        var options = {'backgroundColor': 'transparent',
                       'is3D':true,
                       'bar': {groupWidth: "75%"},
                       'fontName': 'Calibri',
                       'colors': ['#0099A8','#0099A8'],
                       'legend': {
                         'position' : 'none'
                       }
                       };
        var chart = new google.visualization.BarChart(document.getElementById('unpaid_customer_chart'));
        chart.draw(data, options);
        drawChart4();
      }

      <?php
        $users = \App\User::all();
        $totalActivityCount = 0;
        $weeklyTotalActivityCount = 0;
        $sortedWeeklyUsers = [];
        $sortedUsers = [];
        $wuc = 0;
        $uc = 0;
        foreach($users as $user){
          $totalActivityCount += $user->activity();
          $weeklyTotalActivityCount += $user->lastSevenDaysActivity();
          $sortedUsers[$uc++] = ['user' => $user, 'activity' => $user->activity()];
          $sortedWeeklyUsers[$wuc++] = ['user' => $user, 'activity' => $user->lastSevenDaysActivity()];
        }
        array_multisort(array_column($sortedWeeklyUsers, 'activity'), SORT_DESC, $sortedWeeklyUsers);
        array_multisort(array_column($sortedUsers, 'activity'), SORT_DESC, $sortedUsers);

      ?>
      function drawChart4(){
        var data = new google.visualization.DataTable();
        data.addColumn('string','User');
        data.addColumn('number', 'Activity');
        data.addRows([
          @foreach($sortedWeeklyUsers as $user)
          ['{{$user['user']->name}}', {{ ($user['user']->lastSevenDaysActivity() / $weeklyTotalActivityCount) * 100 }}],
          @endforeach
        ]);
        var options = {'backgroundColor': 'transparent',
                       'pieHole': 0.2,
                       'fontName': 'Calibri',
                       'legend': {
                         'position': 'top',
                         'maxLines': 50,
                         'alignment': 'center',
                         'textStyle': {
                           'fontName': 'Calibri'
                         }
                       }
                       };
        var chart = new google.visualization.PieChart(document.getElementById('weekly_user_activity'));
        chart.draw(data, options);
        drawChart5();
      }

      function drawChart5(){
        var data = new google.visualization.DataTable();
        data.addColumn('string','User');
        data.addColumn('number', 'Activity');
        data.addRows([
          @foreach($sortedUsers as $user)
          ['{{$user['user']->name}}', {{ ($user['user']->activity() / $totalActivityCount) * 100 }}],
          @endforeach
        ]);
        var options = {'backgroundColor': 'transparent',
                       'pieHole': 0.2,
                       'fontName': 'Calibri',
                       'legend': {
                         'position': 'top',
                         'maxLines': 50,
                         'alignment': 'center',
                         'textStyle': {
                           'fontName': 'Calibri'
                         }
                       }
                       };
        var chart = new google.visualization.PieChart(document.getElementById('alltime_user_activity'));
        chart.draw(data, options);
      }

    </script>




  </head>

  <body style="max-height:296mm; box-sizing:border-box;">
    <div class="page-title-div">
      <h1>{{config('app.name')}} Statistics</h1>
      <h5 style="margin-top:-15px;">{{Carbon\Carbon::now()->format('l jS \of F Y')}}</h5>
    </div>

    <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; text-align:center; margin-top: -50px;">
      <h4><img src="{{config('app.url')}}/img/human.png" style="height:25px;"></img>Total customers: {{$paidCustomers + $allUnpaidCustomers}}</h4>
      <h4><img src="{{config('app.url')}}/img/human.png" style="height:25px;"></img>Paid customers: {{$paidCustomers}}</h4>
      <h4><img src="{{config('app.url')}}/img/human.png" style="height:25px;"></img>Unpaid customers: {{$allUnpaidCustomers}}</h4>
    </div>
    <div style="width:100%; text-align:center;">
      <h4>Application activity over the last seven days</h4>
    </div>
    <div id="curve_chart" style="width: 100%;margin-top:-45px; height: 200px;">
    </div>

    <div style="width:100%; display:grid; grid-template-columns: 1fr 1fr; text-align:center; margin-top: 10px;">
      <h4>Unpaid customer contact options</h4>
      <h4>Customer contact attempts overview</h4>
    </div>
    <div style="width: 100%; display:grid; grid-template-columns:1fr 1fr; margin-top:-55px; grid-gap: 0px;">
      <div id="unpaid_customer_chart" style="width:100%; height: 250px;">

      </div>
      <div id="pie_chart" style="width:100%;">

      </div>
    </div>
    <div style="width:100%;text-align:center; margin-top: -25px;">
      <h4>This week's user activity</h4>
    </div>
    <div style="width:100%; margin-top: -15px;" id="weekly_user_activity"></div>
    <div style="width:100%;text-align:center; margin-top: -25px;">
      <h4>All time user activity</h4>
    </div>
    <div style="width:100%; margin-top: -15px; margin-bottom:-40px; overflow-y: hidden;" id="alltime_user_activity"></div>
  </body>

</html>
