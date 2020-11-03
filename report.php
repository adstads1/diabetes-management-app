<?php
//Report no errors. Errors only appear from else statements specified in my code.
//error_reporting(0);
//Start session
session_start();
//If the username hasn't logged in send the user to the login page. 
if ( !isset( $_SESSION[ 'ses_user' ] ) ) {
  header( "location:index.php" );
  exit();
}
//Else load the page and graph
else {

  /* Database connection */
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'diabetes_db';
  $mysqli = new mysqli( $host, $user, $pass, $db )or die( $mysqli->error );

//Assigning data to variables
  $data1 = '';
  $data2 = '';
  $currentDate = date( 'Y-m-d' );
  $user = $_SESSION[ 'ses_user' ];
  //query to get data from the table
  $sql = "SELECT bgLevel, time FROM `readings` WHERE date='$currentDate' AND userid='$user'";
  $result = mysqli_query( $mysqli, $sql );

  //We loop through the returned data
  while ( $row = mysqli_fetch_array( $result ) ) {

    $data1 = $data1 . '"' . $row[ 'bgLevel' ] . '",';
    $data2 = $data2 . '"' . $row[ 'time' ] . '",';
  }

//We trim off uneccessary commmas
  $data1 = trim( $data1, "," );
  $data2 = trim( $data2, "," );
  ?>
<!doctype html>
<html>
<head>
<!-- Compiled and minified CSS for materialze-->
<link rel="stylesheet" href="materialize\materialize.css">

<!-- Compiled and minified JavaScript --> 
<script src="materialize\materializejs.js"></script>
<link rel="stylesheet" href="main.css">

<!--nouislider css and js-->
<link rel="stylesheet" href="nouislider\nouislider.css">
<script src="nouislider\nouislider.js"></script> 

<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="utf-8">
<title>Report</title>
</head>

<body>
    <!--Top red nav-->
    <nav>
        <div class="nav-wrapper" > <a href="#" class="brand-logo left" >Report</a> </div>
    </nav>

<h3 class="center-align">Daily Blood Glucose Graph</h3>
	
<!--Required imports for rendering graph -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script> 
	
<!--Canvas container for the chart-->
<canvas id="myChart" width="400" height="400" ></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> 

<!--For mobile I've created a swipable side nav for easy navigation between pages. The side navigation has a title and 5 options-->
<ul id="slide-out" class="sidenav" style="background-color:#252525;">
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="subheader white-text" style="font-size: 24px;">Pages</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="waves-effect white-text" href="readings.php" style="font-size:20px;"><img class="circle responsive-img" src="images/Tab Icons/ballot-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Readings</a></li>
  <li><a class="waves-effect white-text" href="report.php" style="font-size:20px;"> <img class="circle responsive-img" src="images/Tab Icons/timeline-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Report</a></li>
  <li><a class="waves-effect white-text" href="settings.php" style="font-size:20px;"> <img class="circle responsive-img" src="images/Tab Icons/settings-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Settings</a></li>
  <li>
    <div class="divider"></div>
  </li>
  <li><a class="waves-effect white-text" href="add_reading.php" style="font-size:20px;"> <img class="circle responsive-img" src="images/Tab Icons/blood-drop.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Add Reading</a></li>
  <li>
    <div class="divider"></div>
  </li>
</ul>
<script>
//Loading chart
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for the dataset. Which in this case is our blood glucose level and time
    data: {
        labels: [<?php echo $data2; ?>],
        datasets: [{
            label: 'Blood glucose level',
            backgroundColor: 'transparent',
            borderColor: '#DBD2D2',
            data: [<?php echo $data1; ?>]
        }]
    },

    // This is where the configuration is done for the graph.
    options: {
      scales: {
              xAxes: [{
                  type: 'time',
                  time: 
                  {
                    format: 'HH:mm',
                    tooltipFormat: 'HH:mm',
                    unit: 'minute',
                    parser: 'HH:mm',
                    stepSize: 120,
                    min: '00:00',
                    max: '23:59',
                    displayFormats: 
                    {
                      hour: 'HH:mm',
                      'minute': 'HH:mm',
                      'hour': 'HH:mm',
                    }
                  },
                  ticks: 
                  {
                    min: '00:00',
                    max: '23:59',
                    
                    stepSize: 60,
                    
                    fontColor: '#D2D2D2',
                    fontSize: 15,
                    maxRotation: 90,
                    minRotation: 80
                  },
                  scaleLabel: 
                  {
                    display: true,
                    fontColor: '#D2D2D2',
                    fontSize: 15,
                    labelString: "Time (24 Hours)"
                  }
                }],
        yAxes: [{
                  ticks: {
                    min: 0,
                    max: 15,
                    stepSize: 1,
                    source: 'data',
                    fontColor: '#D2D2D2',
                    fontSize: 15,
                    labelString: 'mmol'
                  },
                  scaleLabel: {
                    display: true,
                    fontColor: '#D2D2D2',
                    fontSize: 15,
                    labelString: "mmol"
                  }
                }]
              }
            }
          });
	
//Sidenav
	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {edge:'left'}, {draggable: true});
		
  });
	
</script>
</body>
</html>
<?php
}
?>