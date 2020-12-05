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

		$user = $_SESSION['ses_user'];
		$conn = mysqli_connect('localhost', 'root', '', 'diabetes_db');

		//Gets all the medications that are taken by the user.
		$sql = "SELECT medName FROM  med_name WHERE userID='$user'";

		//Execute the statement.
		$result = $conn->query($sql);
		$row = mysqli_fetch_row($result);
		$conn->close();

	?>

  	<!DOCTYPE html>

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

  		<!--Getting material Design Icons-->
  		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  		<!--Let browser know website is optimized for mobile-->
  		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		  <meta charset="utf-8">
		  
		  <title>Add Reading</title>
		  
  	</head>

  	<body>
	  
  		<!--Main title for the add reading page-->
  		<nav>
  			<div class="nav-wrapper"> <a href="#" class="brand-logo left">Add Reading</a> </div>
  		</nav>

  		<div class="subnav">
  			<h4 class="subtext">Activity Type</h4>
  		</div>

  		<div class="row mainContent">
  			<form method="POST" class="col s12" name="updateBGVal">
  				<div class="row mainContent">

  					<!--To center the fields I've distributed the textfields  by taking up 6 columns out of the 12 starting from column 1-->
  					<div class="input-field col s6 offset-s1" style="margin-top: 5px; margin-bottom: 0px;">
  						<select name="activityTypes" id="activityTypes" onchange="activityT()">
  							<option value="" disabled selected>&nbsp;&nbsp; Activity Type List</option>
  							<option value="Before Breakfast">Before Breakfast</option>
  							<option value="After Breakfast">After Breakfast</option>
  							<option value="Before Lunch">Before Lunch</option>
  							<option value="After Lunch">After Lunch</option>
  							<option value="Before Dinner">Before Dinner</option>
  							<option value="Before Snack">Before Snack</option>
  							<option value="After Snack">After Snack</option>
  							<option value="Before Work">Before Work</option>
  							<option value="After Work">After Work</option>
  							<option value="Before Medication">Before Medication</option>
  							<option value="After Medication">After Medication</option>
  						</select>
  						<input id="assignATable" type="hidden" value="" name="assignATable" style="margin: 50px;">
  					</div>

  					<!--Medication dropdown-->
  					<div id="medications" class="input-field col s6 offset-s1 " style="margin-top: 5px; margin-bottom: 0px;">
  						<select name="medications" id="medications">
  							<option value="" disabled selected>&nbsp;&nbsp; Medication</option>
  							<!--Get Mednication name from med_name table. We get each medication name from the medName column created by the user in settings.-->
  							<?php foreach ($result as $medname) : ?>
  								<option value="<?= $medname['medName']; ?>"><?= $medname['medName']; ?></option>
  							<?php endforeach; ?>
  						</select>
  					</div>

  					<!--Workloads dropdown-->
  					<div id="workloads" class="input-field col s6 offset-s1 " style="margin-top: 5px; margin-bottom: 0px;">
  						<select name="workloads">
  							<option value="" disabled selected>&nbsp;&nbsp; Today's workload</option>
  							<option value="High">High</option>
  							<option value="Average">Average</option>
  							<option value="Low">Low</option>
  						</select>
  					</div>

  					<!--Work atmosphere dropdown-->
  					<div id="workatmospheres" class="input-field col s7 offset-s1 " style="margin-top: 5px; margin-bottom: 0px;">
  						<select name="workatmospheres">
  							<option value="" disabled selected>&nbsp;&nbsp; Today's work atmosphere</option>
  							<option value="Hectic">Hectic</option>
  							<option value="Social">Social</option>
  							<option value="Calm">Calm</option>
  						</select>
  					</div>
  				</div>

  		</div>

  		<div class="subnav">
  			<h4 class="subtext">Emotion</h4>
  		</div>

  		<!--Below are emotion images displayed in one row. Overflowed emotion icons are displayed by being scrolled-->
  		<div class="row mainContent" style="height: 70px; overflow-x: auto; margin-top:10px;">
  			<div class="row mainContent">
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/neutral.svg" style="background-color: #ff0000;" alt="neutral">
  					<h5 style="margin-top: 0px; text-align: center">Neutral</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/sad.svg" style=" background-color: #ff0000;" alt="sick">
  					<h5 style="margin-top: 0px; ">Sick</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/stress.svg" style=" background-color: #ff0000;" alt="stress">
  					<h5 style="margin-top: 0px; ">Stress</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/tired.svg" style=" background-color: #ff0000;" alt="tired">
  					<h5 style="margin-top: 0px; ">Tired</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/happy.svg" style=" background-color: #ff0000;" alt="happy">
  					<h5 style="margin-top: 0px; ">Happy</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/hypo.svg" style=" background-color: #ff0000;" alt="hypo">
  					<h5 style="margin-top: 0px; ">Hypo</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img " src="images/Emoji faces/SVG/Adrenalin.svg" style=" background-color: #ff0000;" alt="adrenalin">
  					<h5 style="margin-top: 0px; ">Adrenalin</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/allergy.svg" style=" background-color: #ff0000;" alt="allergy">
  					<h5 style="margin-top: 0px; ">Allergy</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/depressed.svg" style=" background-color: #ff0000;" alt="depressed">
  					<h5 style="margin-top: 0px; ">Depressed</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/drunk.svg" style=" background-color: #ff0000;" alt="drunk">
  					<h5 style="margin-top: 0px; ">Drunk</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/nervous.svg" style=" background-color: #ff0000;" alt="nervous">
  					<h5 style="margin-top: 0px; ">Nervous</h5>
  				</div>
  				<div id="emotion-styling" class="input-field col s1 center-align">
  					<img class="circle responsive-img emotionclass" src="images/Emoji faces/SVG/sad.svg" style=" background-color: #ff0000;" alt="sad">
  					<h5 style="margin-top: 0px; ">Sad</h5>
  				</div>

  				<!--The string to what the emotion image is referred to is stored in the value attribute in the input element below. This is assigned in the JavaScript code. The backend (php) will extract the value -->
  				<input id="emotionchosen" type="hidden" value="" name="emotionchosen" style="margin: 50px;">
  			</div>

  		</div>

  		<div class="subnav">
  			<h4 class="subtext">Measurements</h4>
  		</div>

  		<div class="row" style="margin-bottom: 0px">

  			<div class="row" style="margin-bottom: 0px">
  				<!--To center the fields I've distributed the textfields from column 1-10 out of the 12 equal width coloumns-->
  				<div id="carb" class="input-field col s10 offset-s1" style="margin-top:10px; margin-bottom: 0px;">
  					<input id="carbLevel" type="number" step="any" class="validate" name="carb" style="margin-top:0px; margin-bottom: 0px;">
  					<label for="carb">Carbohydrate</label>
  				</div>
  				<div class="input-field col s10 offset-s1 " style="margin-top:10px; margin-bottom: 0px;">
  					<input id="bg" type="number" step="any" class="validate" name="bg" style="margin-top:0px; margin-bottom: 0px;">
  					<label for="bg">Blood Glucose</label>
  				</div>
  				<div class="input-field col s10 offset-s1 " style="margin-top:10px; margin-bottom: 0px;">
  					<input id="qa" type="number" step="any" class="validate" name="qa" style="margin-top:0px; margin-bottom: 0px;">
  					<label for="qa">QA Insulin</label>
  				</div>
  				<div class="input-field col s10 offset-s1 " style="margin-top:10px; margin-bottom: 0px;">
  					<input id="bk" type="number" step="any" class="validate" name="bk" style="margin-top:0px; margin-bottom: 0px;">
  					<label for="bk">BK Insulin</label>
  				</div>
  				<div class="input-field col s10 offset-s1 " style="margin-top:10px; margin-bottom: 0px;">
  					<input id="time" type="text" class="timepicker" name="time" style="margin-top:0px; margin-bottom: 0px;">
  					<label for="time">Time</label>
  				</div>
  				<div class="input-field col s10 offset-s1 " style="margin-top:10px; margin-bottom: 0px;">
  					<select name="injectLocation" id="injectLocation" onchange="injectL()">
  						<option value="" disabled selected>&nbsp;&nbsp; Injection location</option>
  						<option value="Left Arm">Left Arm</option>
  						<option value="Right Arm">Right Arm</option>
  						<option value="Left Thigh">Left Thigh</option>
  						<option value="Right Thigh">Right Thigh</option>
  						<option value="Upper right Abdomen">Upper right Abdomen</option>
  						<option value="Lower right Abdomen">Lower right Abdomen</option>
  						<option value="Upper left Abdomen">Upper left Abdomen</option>
  						<option value="Lower left Abdomen">Lower left Abdomen</option>
  					</select>
  					<input id="assignILocation" type="hidden" value="" name="assignILocation" style="margin: 50px;">
  				</div>
  				<!--Button has been pushed to the bottom-->
  				<div id="save-button-position" class="input-field col s4 offset-s4 center-align">
  					<button id="save_reading" class="btn waves-effect waves-light center-align" type="submit" name="save_reading">Save</button>
  				</div>
  				<div class="input-field col s1">
  					<a class="btn-floating btn-large waves-effect waves-light" id="help-button" href="help.php"><i class="material-icons help-color" style="font-size: 56px;">help</i></a>
  				</div>

  			</div>
  			</form>
  		</div>

  		<!--For mobile I've created a swipable side navigation for easy navigation between pages. The side navigation has a title and 5 options -->
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

  			//Make the following elements hidden from the user. These will be displayed when the user choses a specific activity type
  			document.getElementById('medications').style.display = "none";
  			document.getElementById('workloads').style.display = "none";
  			document.getElementById('workatmospheres').style.display = "none";
  			document.getElementById('carb').style.display = "none";

  			//Timepicker 
  			document.addEventListener('DOMContentLoaded', function() {
  				var elems = document.querySelectorAll('.timepicker');
  				var instances = M.Timepicker.init(elems, {
  					twelveHour: false
  				});
  			});

  			//Sidenav configuration
  			document.addEventListener('DOMContentLoaded', function() {
  				var elems = document.querySelectorAll('.sidenav');
  				var instances = M.Sidenav.init(elems, {
  					edge: 'left'
  				}, {
  					draggable: true
  				});
  			});

  			//Configuring the dropdown used by all of the dropdown 
  			var classes = "..";
  			document.addEventListener('DOMContentLoaded', function() {
  				var elems = document.querySelectorAll('select');
  				var instances = M.FormSelect.init(elems, classes);
  			});

  			//An event lister which has been assigned to be used by multiple emotion images with the same class name. This is then for-looped to get the alt value to extract the emotional state. Then the alt value is put into the value attribute of hidden input element which is then extracted by the backend (php).
  			document.querySelectorAll('.emotionclass').forEach(item => {
  				item.addEventListener('click', function() {
  					var emotionStr = item.getAttribute('alt');
  					//var replace =  
  					document.getElementById('emotionchosen').value = emotionStr;
  					var checknewEVal = document.getElementById('emotionchosen').value;
  					alert("Emotion: " + checknewEVal + " chosen");
  				});
  			});

  			//This function is called by the Onchange attribute on the 'activityTypes' drop down list. This function allows pacific elements to appear and hide depending on the activity chosen which is done instide this method.
  			function activityT() {
  				//Hide elements
  				document.getElementById('medications').style.display = "none";
  				document.getElementById('workloads').style.display = "none";
  				document.getElementById('workatmospheres').style.display = "none";
  				document.getElementById('carb').style.display = "none";

  				//Get the string value from the dropdown option selected and store it in a variable.
  				var aDropdownTxt = document.getElementById('activityTypes').value;

  				//String variables used when specifying the table to save the results in
  				var medication_Table = "med_reading";
  				var nutrition_Table = "nutrition_reading";
  				var work_Table = "work_reading";

  				//if after a meal display the carbohydrate textfield
  				if (aDropdownTxt == "After Breakfast" || aDropdownTxt == "After Lunch" || aDropdownTxt == "After Dinner" || aDropdownTxt == "After Snack") {

  					document.getElementById('carb').style.display = "block";
  				}
  				//If any of the before Activities have been selected
  				else if (aDropdownTxt == "Before Breakfast" || aDropdownTxt == "Before Lunch" || aDropdownTxt == "Before Dinner" || aDropdownTxt == "Before Snack" || aDropdownTxt == "Before Work" || aDropdownTxt == "Before Medication") {
  					document.getElementById('medications').style.display = "none";
  					document.getElementById('workloads').style.display = "none";
  					document.getElementById('workatmospheres').style.display = "none";
  				}
  				//If After Medication selected
  				else if (aDropdownTxt == "After Medication") {
  					document.getElementById('medications').style.display = "block";

  				} 
				else if (aDropdownTxt == "After Work") {
  					document.getElementById('workloads').style.display = "block";
  					document.getElementById('workatmospheres').style.display = "block";
  				}

  				if (aDropdownTxt == "Before Breakfast" || aDropdownTxt == "Before Lunch" || aDropdownTxt == "Before Dinner" || aDropdownTxt == "Before Snack" || aDropdownTxt == "After Breakfast" || aDropdownTxt == "After Lunch" || aDropdownTxt == "After Dinner" || aDropdownTxt == "After Snack") {
  					document.getElementById('assignATable').value = nutrition_Table;

  				} 
				else if (aDropdownTxt == "Before Medication" || aDropdownTxt == "After Medication") {
  					document.getElementById('assignATable').value = medication_Table;

  				} 
				else if (aDropdownTxt == "Before Work" || aDropdownTxt == "After Work") {
  					document.getElementById('assignATable').value = work_Table;

  				}

  			}

  			//switch statement used instead for the injection location instead of if else as there's more conditions.
  			function injectL() {
  				var injectLTxt = document.getElementById('injectLocation').value;
  				switch (injectLTxt) {
  					case "Left Arm":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Right Arm":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Left Thigh":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Right Thigh":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Upper right Abdomen":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Upper left Abdomen":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Lower right Abdomen":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  					case "Lower left Abdomen":
  						document.getElementById('assignILocation').value = injectLTxt;
  						break;
  				}

  			}

  		</script>

  		<?php

			//Removes php errors displayed on page.
			error_reporting(0);

			//If the save button is pressed. We get the name attribute from the button element.
			if (isset($_POST["save_reading"])) {

				//Get the other elements for adding a reading
				$aType = $_POST['activityTypes'];
				$emotion = $_POST['emotionchosen'];
				$bgLevel = $_POST['bg'];
				$qA = $_POST['qa'];
				$bK = $_POST['bk'];
				$time = $_POST['time'];
				$currentDate = date('Y-m-d');

				//Get input values which have been processed from the JavaScript functions.
				//Removed for database and graph//$assignTable=$_POST['assignATable'];
				$injectL = $_POST['assignILocation'];

				$medName = $_POST['medications']; //For medication Activity
				$carb = $_POST['carb']; //For nutrition Activity
				$workLoad = $_POST['workloads']; //For work Activity
				$workAtm = $_POST['workatmospheres']; //For work Activity

				//If the main textfields are not empty when adding a reading, access database and execute the query. QA and BK insulin can be empty as the user may enter "0" as a value. 
				if (!empty($_POST['bg']) && !empty($_POST['time']) && !empty($_POST['assignATable'])) {
					$conn = mysqli_connect('localhost', 'root', '', 'diabetes_db');
					if (!$conn) {
						//Display alert
						echo "<script type='text/javascript'>alert('Connection to database was not possible');</script>";
						die();
					}

					//Insert the value SQL script
					if ($result) {
						$sql = "INSERT INTO readings(userID, workload, workAtmosphere, workEmotion, medName, carbIntake, activityType, date, time, bgLevel, emotionalS, qAInsluin, backInsulin, injection_Location) VALUES('$user', '$workLoad','$workAtm', '$emotion', '$medName', '$carb','$aType','$currentDate','$time','$bgLevel','$emotion','$qA','$bK', '$injectL')";
						$result = mysqli_query($conn, $sql);

						echo "<script>alert('Successfully added reading');</script>";
					}

				} 
				else {
					echo "<script type='text/javascript'>alert('Please fill in all fields');</script>";
				}
				
				//close connection
				$conn->close();
			}

			?>

  	</body>

  	</html>

  <?php
	}
	?>