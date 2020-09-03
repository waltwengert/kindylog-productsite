<?php include("inc/sessionStart.php");?>
<?php
  require_once "uq/auth.php";
  auth_require();

  $UQ = auth_get_payload();
?>

<!DOCTYPE html>
<html>
<head>
  <title>KindyLog Stats</title>

  <link rel="stylesheet" href="styles/main.css">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.load('current', {'packages':['table']});
    google.charts.setOnLoadCallback(drawChart);

    // array 2 expects to only have 2 columns
    function mergeWeeklyData(array1, array2) {
      var height = array1.length;
      var width = array1[0].length;

      //clone array1
      var merged = array1.slice(0);

      for (var i = 0; i < height; i++) {
        merged[i][width] = array2[i][1];
      }
      return merged;
    }

    function drawChart() {
      var sqlReturn = [];

      xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            sqlReturn = JSON.parse(this.responseText);

            var interestNoArr = sqlReturn[0];
            var interestLvlArr = sqlReturn[1];
            var visitArr = sqlReturn[2];
            var purchaseHitArr = sqlReturn[3];
            var interestAllArr = sqlReturn[4];

            //Merging arrays together for use in a single table:
            var merged = mergeWeeklyData(visitArr, purchaseHitArr);
            var trafficArr = mergeWeeklyData(merged, interestNoArr);

            var dataInterestNo = google.visualization.arrayToDataTable(interestNoArr);
            var dataInterestLvl = google.visualization.arrayToDataTable(interestLvlArr);
            var dataVisit = google.visualization.arrayToDataTable(trafficArr);

            //var dataInterestAll = google.visualization.arrayToDataTable(interestAllArr);

            var dataInterestAll = new google.visualization.DataTable();
            dataInterestAll.addColumn('string', 'Email');
            dataInterestAll.addColumn('string', 'First Name');
            dataInterestAll.addColumn('string', 'Last Name');
            dataInterestAll.addColumn('string', 'Interest Level');
            dataInterestAll.addColumn('string', 'Submit Date');
            dataInterestAll.addRows(interestAllArr);

            /*
            var optionsInterestNo = {
              title: 'Expressions of Interest Over Past Week',
              legend: { position: 'bottom' },
              hAxis: { direction: '-1' }
            };
            */
            var optionsInterestLvl = {
              title: 'Levels of Interest (1 = not interested; 5 - extremely interested)',
              legend: { position: 'bottom' }
            };
            var optionsVisit = {
              title: 'Website Visits Over Past Week',
              legend: { position: 'bottom' },
              hAxis: { direction: '-1' }
            };
            var optionsInterestAll = {
              title: 'Interested User Details',
              width: '100%',
              height: '100%'
            };

            //var interestNoChart = new google.visualization.LineChart(document.getElementById('interestNo_chart'));
            var interestLvlChart = new google.visualization.PieChart(document.getElementById('interestLvl_chart'));
            var visitChart = new google.visualization.LineChart(document.getElementById('visit_chart'));
            var interestTable = new google.visualization.Table(document.getElementById('interest_chart'));

            //interestNoChart.draw(dataInterestNo, optionsInterestNo);
            interestLvlChart.draw(dataInterestLvl, optionsInterestLvl);
            visitChart.draw(dataVisit, optionsVisit);
            interestTable.draw(dataInterestAll, optionsInterestAll);
          }
      };
      xmlhttp.open("GET","getstats.php", true);
      xmlhttp.send();
  }
  </script>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="index.php">KindyLog</a>

      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="purchase.php">Purchase</a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="stats.php">Statistics</a>
        </li>
      </ul>
    </nav>
  </header>

  <div class="container-fluid" style="margin-top:80px">
    <h1>Statistics</h1><br>
    <p>The following charts offer a way of visualising data received from website visitors and those
      who have signed up for an expression of interest for KindyLog.</p>
  </div><br>

  <div style="width: 900px; margin: auto">
    <b>Expressions of Interest Detailed Data</b>
    <div id="interest_chart" style="width: 900px; margin: auto"></div>
  </div><br><br>
  <div id="visit_chart" style="width: 900px; height: 500px; margin: auto"></div>
  <div id="interestLvl_chart" style="width: 900px; height: 500px; margin: auto"></div><br>
</body>
</html>
