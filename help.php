<!DOCTYPE html>

<html>

<head>

    <!-- Compiled and minified CSS for materialze-->
    <link rel="stylesheet" href="materialize\materialize.css">

    <!-- Compiled and minified JavaScript -->
    <script src="materialize\materializejs.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="main.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Help</title>

</head>

<body>

    <!--Main title for the add reading page-->
    <nav>
        <div class="nav-wrapper"> <a href="#" class="brand-logo left">Help</a> </div>
    </nav>

    <div class="subnav">
        <h4 class="subtext">Help Information</h4>
    </div>

    <div class="slider">
        <ul class="slides">
            <li>
                <img src=""> <!-- Empty image used for the grey background -->
                <div class="caption left-align">
                    <h2>Side Navigation</h2>
                    <h4 class="light grey-text text-lighten-3">Swipe your finger from the left hand side of the screen to the center to navigate around the application.</h4>
                </div>
            </li>
            <li>
                <img src="">
                <div class="caption left-align">
                    <h2>Readings</h2>
                    <h4 class="light grey-text text-lighten-3">You are able to view readings entered in the "Readings" page from the readings entered from the "Add Reading" page.
                </div>
            </li>
            <li>
                <img src="">
                <div class="caption left-align">
                    <h2>Report</h2>
                    <h4 class="light grey-text text-lighten-3">
                        You are also able to view a Data Visualized graph of the readings entered within the 24 hours period in the "Report" page.
                    </h4>
                </div>
            </li>
            <li>
                <img src=""> 
                <div class="caption left-align">
                    <h2>Settings</h2>
                    <h4 class="light grey-text text-lighten-3">You are also able to configure settings of the application in the "Settings" page.</h4>
                </div>
            </li>
            <li>
                <img src=""> 
                <div class="caption left-align">
                    <h2>Add Reading</h2>
                    <h4 class="light grey-text text-lighten-3">Lastly, You are able to add a reading in the "Add Reading" page.</h4>
                </div>
            </li>
        </ul>
    </div>

    <!--For mobile I've created a swipable side navigation for easy navigation between pages. The side navigation has a title and 5 options -->
    <ul id="slide-out" class="sidenav" style="background-color:#252525;">
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a class="subheader white-text" style="font-size: 24px;">Pages</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a href="readings.php" class="waves-effect white-text" style="font-size:20px;">
                <img class="circle responsive-img" src="images/Tab Icons/ballot-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Readings
            </a>
        </li>
        <li>
            <a class="waves-effect white-text" href="report.php" style="font-size:20px;">
                <img class="circle responsive-img" src="images/Tab Icons/timeline-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Report
            </a>
        </li>
        <li>
            <a class="waves-effect white-text" href="settings.php" style="font-size:20px;">
                <img class="circle responsive-img" src="images/Tab Icons/settings-24px.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Settings
            </a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a class="waves-effect white-text" href="add_reading.php" style="font-size:20px;">
                <img class="circle responsive-img" src="images/Tab Icons/blood-drop.svg" style="width: 35px; right: 20px; top: 10px; background-color: #ff0000;">Add Reading
            </a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
    </ul>

</body>

<script>

    M.AutoInit();

    //Sidenav configuration
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {
            edge: 'left'
        }, {
            draggable: true
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.slider');
        var instances = M.Slider.init(elems, {
            indicators: true
        });
    });

</script>

</html>