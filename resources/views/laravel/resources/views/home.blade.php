@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading custom-heading">
                  Statistics
                </div>
                <div class="panel-body custom-body">

                    <h3>Attempts overview</h3>
                  <div class="row">
                    <div style="width:100%; height:450px; margin-top:-45px;" id="chart_div"></div>
                  </div>
                  <h3 style="margin-top:-70px;">
                    Customers to be contacted
                  </h3>

                  <div class="row">
                      <div style="width:100%; height:450px; margin-top:-50px;" id="chart_div2">
<div id="loadingwheel" style="width:100%; margin-top: 50px; text-align: center;">Chart Loading...</br><img src="/img/loading.gif"></img></div>
                      </div>
                  </div>
                  <div style="display:grid; grid-template-columns: 1fr 1fr;">
                    <ul>
                      <li>Total Unpaid represents the number of customers in the system who have not yet been paid</li>
                      <li>Export Locked represents the number of customers who are currently exported for a contact attempt and may not be selected until that contact is resolved</li>
                      <li>Available represents the number of unpaid customers who are not export locked and are eligible for selection in an export</li>
                      <li>Mailable represents the number of unpaid, unlocked customers who have a valid direct mailing address and are eligble for selection</li>
                    </ul>
                    <ul>
                      <li>Emailable represents the number of unpaid, unlocked customers who have a valid email address and are eligble for selection</li>
                      <li>SMSable represents the number of unpaid, unlocked customers who have a valid mobile phone number for SMS and are eligible for selection</li>
                      <li>Callable represents the number of unpaid, unlocked customers who have a valid phone number and are eligible for call selection</li>
                      <li>Do Not Contact represents the number of unpaid customers who have elected not to be contacted</li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading custom-heading">
          Graphical PDF Generation
        </div>
        <div class="panel-body custom-body">
          <p>Here you may generate a graphical PDF document to demonstate the statistical progress of the redress campaign.</p>
          <button onclick="downloadPDF()" class="btn btn-primary btn-block custom-btn-submit">Generate PDF</button>
          <div id="pdf_download_loader" style="text-align:center; width:100%; display:none;"><img src="/img/loading.gif"></img></div>
          <script>
            function downloadPDF(){
              document.getElementById('pdf_download_loader').style.display = "block";
              hidePDFLoader();
              window.location.href = "/graphpdf";
            }
            async function hidePDFLoader(){
              setTimeout(function(){
                document.getElementById('pdf_download_loader').style.display = "none";
              }, 18000);
            }
          </script>
        </div>
    </div>
</div>



<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function secondChart(){
    setTimeout(function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('loadingwheel').style.display = "none";
        var stats = JSON.parse(this.responseText);
        var data2 = new google.visualization.DataTable();
        data2.addColumn('string','Contact Type');
        data2.addColumn('number', 'Customers');
        data2.addColumn({type: 'string', role: 'annotation'});
        data2.addRows([
          ['Total Unpaid', stats["allUnpaidCustomers"], 'Σ'],
          ['Export Locked', stats["exportLocked"], 'L'],
          ['Available', (stats["allUnpaidCustomers"] - stats["exportLocked"] - stats["dsups"]), 'A'],
          ['Mailable', stats["mail_customers"] ,'✎' ],
          ['Emailable', stats["email_customers"] , '✉'],
          ['SMSable', stats["sms_customers"] , ':-)'],
          ['Callable', stats["phone_customers"] , '☏'],
          ['Do Not Contact', stats["dsups"], '✘']
        ]);
        var options2 = {'backgroundColor': 'transparent',
                       'is3D':true,
                       'bar': {groupWidth: "75%"},
                       'fontName': 'Calibri',
                       'legend': {
                         'position': 'none'
                       },
                       'colors': ['#0099A8','#231F20'],
                       };
        var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    };
    xhttp.open("GET",  "{{ route('home.pots') }} ", true);
    xhttp.send();
  }, 100);

  }
  function drawChart() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Status');
    data.addColumn('number', 'Customers');
    data.addRows([
      ['Paid', {{ $stats["paid_customers"] }}],
      ['Not yet attempted', {{$stats["attempt_0_customers"]}}],
      ['Attempted once', {{  $stats["attempt_1_customers"] }}],
      ['Attempted twice', {{  $stats["attempt_2_customers"] }}],
      ['Attempted three times', {{  $stats["attempt_3_customers"] }}],
      ['Attempted four times', {{  $stats["attempt_4_customers"]  }}],
      ['Attempted five or more times', {{$stats["attempt_5_customers"]}}],
      ['Requested data suppression', {{ $stats["dsups"] }}],
    ]);
    // Set chart options
    var options = {'backgroundColor': 'transparent',
                   'is3D':true,
                   'fontName': 'Calibri',
                   'sliceVisibilityThreshold':0,
                   'colors': ['limegreen', 'black', '#e5e5ff', '#9999ff', '#4c4cff', '#0000ff', 'midnightblue', 'red'],
                   };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);

  }
</script>
<script>
secondChart();
</script>

@endsection
