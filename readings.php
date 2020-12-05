<?php

//Start session
session_start();
//If the username hasn't logged in send the user to the login page. 
if (!isset($_SESSION['ses_user'])) {
    header("location:index.php");
    exit();
}

//Else load the page
else {

    //Removes php errors displayed on page.
    error_reporting(0);

    /* Database connection */
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'diabetes_db';

    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //Get readings from database query for the user specifically logged in
    $sql = "SELECT * FROM readings WHERE userID='" . $_SESSION['ses_user'] . "'";
    $result = mysqli_query($conn, $sql);

    //Created an empty array variable which will store all the readings data.
    $readings = array();

    //If more than one result is found
    if (mysqli_num_rows($result) > 0) {

        //While we are able to find results from the database 
        while ($row = mysqli_fetch_assoc($result)) {
            //We add to the Multi-dimensional Array all the readings from the database
            $readings[] = $row;
        }

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
            <title>Reading</title>
        </head>

        <body>

            <!--Top red nav-->
            <nav>
                <div class="nav-wrapper"> <a href="#" class="brand-logo left">Readings</a> </div>
            </nav>

            <div class="subnav">
                <h4 class="subtext">Reading Table</h4>
            </div>

            <div class="table-gap">
                <div class="table-border">
                    <table class="bordered striped white-text ">
                        <thead>
                            <tr>
                                <th>Activity Type</th>
                                <th>Date & Time</th>
                                <th>BG Level</th>
                                <th>Emotion</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //Get each reading stored from the multi-dimensional Array 
                            foreach ($readings as $reading) {
                                //Filling the table with the readings retrieved from the array.
                                echo "<tr>";
                                echo "<td>" . $reading['activityType'] . "</td>";
                                echo "<td>" . $reading['date'] . " <br> " . $reading['time'] . "</td>";
                                echo "<td>" . $reading['bgLevel'] . "</td>";
                                echo "<td>" . $reading['emotionalS'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--For mobile I've created a swipable side nav for easy navigation between pages. The side navigation has a title and 5 options-->
            <ul id="slide-out" class="sidenav" style="background-color:#252525;">
                <li>
                    <div class="divider"></div>
                </li>
                <li><a class="subheader white-text" style="font-size: 24px;">Pages</a></li>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a href="readings.php" class="waves-effect white-text" style="font-size:20px;">
                        <img class="circle responsive-img" src="images/Tab Icons/ballot-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Readings</a></li>
                <li><a class="waves-effect white-text" href="report.php" style="font-size:20px;">
                        <img class="circle responsive-img" src="images/Tab Icons/timeline-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Report</a></li>
                <li><a class="waves-effect white-text" href="settings.php" style="font-size:20px;">
                        <img class="circle responsive-img" src="images/Tab Icons/settings-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Settings</a></li>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a class="waves-effect white-text" href="add_reading.php" style="font-size:20px;">
                        <img class="circle responsive-img" src="images/Tab Icons/blood-drop.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Add Reading</a></li>
                <li>
                    <div class="divider"></div>
                </li>
            </ul>

            <script>

                //Sidenav configuration
                document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('.sidenav');
                    var instances = M.Sidenav.init(elems, {
                        edge: 'left'
                    }, {
                        draggable: true
                    });
                });
                
            </script>

        </body>

        </html>
<?php

    } else {
        echo "<script type='text/javascript'>alert('No results found of a reading from the database');</script>";
        die();
    }
}

?>