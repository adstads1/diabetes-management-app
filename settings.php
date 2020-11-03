<?php
//Start session
session_start();
//If the username hasn't logged in send the user to the login page. 
if(!isset($_SESSION['ses_user'])){  
header("location:index.php");   
exit();
} 
//Else load the page
else {  
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
<title>Settings</title>
</head>

<body>

<!--Top red nav-->
<nav>
  <div class="nav-wrapper" > <a href="#" class="brand-logo left" >Settings</a> </div>
</nav>

<!--sub nav-->
<div class="subnav">
  <h4 class="subtext">Blood Glucose Configuration</h4>
</div>

<!--Blood Glucose Range-->
<div class="row mainContent" >
  <form method="POST" class="col s12" name="updateBGVal">
    <div class="row mainContent" >
      <div class="input-field col s10 offset-s1 " style="margin-top: 0px; ">
        <h4 style="margin-top: 0px;">Blood glucose range</h4>
        <div id="test-slider">
		  <input id="sliderBGValue1" type="hidden" value="" name="bgvval1" min = "0" max = "10"> 
		  <input id="sliderBGValue2" type="hidden" value="" name="bgvval2">
		</div>
      </div>
      <div class="input-field col s8 offset-s1 " style="margin-top: 0px; ">
        <button id="bgRangeUpdate" class="btn waves-effect waves-light " style="width:100%; width: 155px;" type="submit" name="bgRangeUpdate">BG range</button>
      </div>
    </div>
  </form>
</div>

<!--Medication entry-->
<div class="subnav">
  <h4 class="subtext">Medication Configuration</h4>
</div>
<div class="row mainContent">
  <form method="POST" class="col s12"  style="margin-top: 0px;">
    <div class="row mainContent" >
      <div class="input-field col s6 offset-s1 " style="margin-top: 15px;">
        <input id="med_name" type="text"  name="med_name" >
        <label for="med_nameLabel">New Medication name</label>
      </div>
      <div class="input-field col s6 offset-s1 " style="margin-top: 0px; ">
        <button id="medUpdate" class="btn waves-effect waves-light " style="width:100%; width: 155px;" type="submit" name="medUpdate">Add New Medication</button>
      </div>
    </div>
  </form>
</div>

<!--Logout button-->
<div class="subnav">
  <h4 class="subtext">Log out</h4>
</div>
<div class="row mainContent">
  <form method="POST" class="col s12" >
    <div class="row mainContent" >
      <div class="input-field col s6 offset-s1 " style="margin-top: 0px; ">
        <a href="logout.php"> <button class="btn waves-effect waves-light " style="width:100%; width: 155px;" type="submit" name="logout" onclick="window.location.href='logout.php';">Log out</button></a>
      </div>
    </div>
  </form>
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
			
//Blood Glucose range that ranges from 0-10 and automatically set to 4-7.
  var slider = document.getElementById('test-slider');
  noUiSlider.create(slider, {
   start: [4, 7],
   connect: true,
   step: 1,
   orientation: 'horizontal', // 'horizontal' or 'vertical'
   range: {
     'min': 0,
     'max': 10
   },
   format: wNumb({
     decimals: 0
   })
  });
	
	//Sidenav configuration
	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {edge:'left'}, {draggable: true});
  });
		
	// Get & read the slider value.
	document.getElementById('bgRangeUpdate').addEventListener('click', function () {
    var bgval = slider.noUiSlider.get();
	var bgvval1 = parseInt(bgval[0]);
	var bgvval2 = parseInt(bgval[1]);
	document.getElementById('sliderBGValue1').value = bgvval1;
	document.getElementById('sliderBGValue2').value = bgvval2;
});
</script>

<?php

//Removes php errors displayed on page.
error_reporting(0);

//If the BG range button is clicked
if(isset($_POST["bgRangeUpdate"])){

//Get the Blood Glucose range value
$bgVal1=$_POST['bgvval1'];
$bgVal2=$_POST['bgvval2'];
	
			$conn=mysqli_connect('localhost','root','', 'diabetes_db');  
			
			//If there's a connection problem
			if (!$conn)
			{
				//Display alert if connection to database was unsuccessful
				echo "<script type='text/javascript'>alert('Connection to database was not possible');</script>";
				die();
			}
			$user = $_SESSION['ses_user'];
			//Update the value SQL script
			$sql="UPDATE users SET bgRange1='$bgVal1', bgRange2='$bgVal2' WHERE userID='$user'";
			//If query run found the user
			if ($conn->query($sql) === TRUE) {
			  echo "<script>alert('Successfully updated Blood Glucose Range');</script>";
			} 
			else {
			  echo "<script>alert('there was an error updating the Blood Glucose range');</script>" . $conn->error;
			}
			//close connection
			$conn->close();		
	
}
//Gets medication button name
if(isset($_POST["medUpdate"])){
$medName=$_POST['med_name'];

		//If the medication field isn't empty.
		if(!empty($_POST['med_name'])){
			$conn=mysqli_connect('localhost','root','', 'diabetes_db');  
			
			//If there's a connection problem
			if (!$conn)
			{
				//Display alert if connection to database failed
				echo "<script type='text/javascript'>alert('Connection to database was not possible');</script>";
				die();
			}
			$user = $_SESSION['ses_user'];
			//Insert the value SQL script
			$sql="INSERT INTO med_name(medName, userID) VALUES('$medName','$user')";  
			//If query run found the user
			if ($conn->query($sql) === TRUE) {
			  echo "<script>alert('Successfully updated Medication name');</script>";
			} else {
			  echo "<script>alert('There was an error updating the Medication name');</script>" . $conn->error;
			}
			//close connection
			$conn->close();		
			}
		else{
		echo "<script>alert('Medication cannot be empty');</script>"; 
			}
}

//If the logout button is clicked
if(isset($_POST["logout"])){
	//Redirect user to logout.php which ends the session
	echo '<script type="text/javascript">window.location = "logout.php"</script>';
}
?>  	
</body>
</html>
<?php  
}  
?>