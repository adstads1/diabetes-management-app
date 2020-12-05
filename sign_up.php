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

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta charset="utf-8">

	<title>Sign up</title>

</head>

<body>

	<div class="back-btn">
		<a href="index.php">
			<img id="arrow" src="images\System interface\arrow_back_ios-24px.svg" alt="Back button">
		</a>
	</div>

	<h1 style="margin-top: 5px; margin-bottom: 0px" class="center-align">Sign up</h1>

	<!--Form used for signing in with grids used based from the materialize framework. Grid with a row and 12 equal width columns.-->
	<div class="row" style="margin-bottom: 0px">
		<form method="POST" action="" class="col s12" style="margin-top:15px; margin-bottom: 0px">
			<div class="row" style="margin-bottom: 0px">
				<!--To center the fields I've distributed the textfields from column 2-8 out of the 12 equal width coloumns-->
				<div class="input-field col s8 offset-s2 ">
					<input id="username" type="text" class="validate" name="user" style="margin-bottom: 5px">
					<label for="username">Username</label>
				</div>
				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; margin-bottom: 5px">
					<input id="first_name" type="text" class="validate" name="fname">
					<label for="first_name">First name</label>
				</div>
				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; margin-bottom: 5px">
					<input id="last_name" type="text" class="validate" name="sname">
					<label for="last_name">Surname</label>
				</div>
				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; margin-bottom: 5px">
					<input id="password" type="password" class="validate" name="pword">
					<label for="password">Password</label>
				</div>
				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; margin-bottom: 5px">
					<input id="date" type="text" class="datepicker" name="dob">
					<label for="date">Date of Birth</label>
				</div>
				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; margin-bottom: 5px">
					<select name="gender">
						<option value="" disabled selected>&nbsp;&nbsp; Genders</option>
						<option value="Female">Female</option>
						<option value="Male">Male</option>
					</select>

				</div>

				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; ">
					<input id="weight" type="number" step="any" class="validate" name="weight">
					<label for="weight">Weight (Pounds)</label>
				</div>

				<!--Blood glucose range-->
				<div class="input-field col s8 offset-s2 " style="margin-top: 0px; margin-bottom: 35px">
					<h4 style="margin-top: 0px;  margin-bottom: 25px">Blood glucose range</h4>
					<div id="test-slider">
						<input id="sliderBGValue1" type="hidden" value="" name="bgvval1" min="0" max="10">
						<input id="sliderBGValue2" type="hidden" value="" name="bgvval2">
					</div>
				</div>

				<div class="input-field col s8 offset-s2 " style="margin-bottom: 0px">
					<button id="signed_up" class="btn waves-effect waves-light btn-large" style="width:100%; margin-bottom: 5px;" type="submit" name="sign_up">Sign up</button>
				</div>

			</div>
		</form>
	</div>
	
	<script>

		//Datepicker with day, month and year format
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.datepicker');
			var instances = M.Datepicker.init(elems, {
				format: 'yyyy:mm:dd',
				yearRange: [1950, 2020]
			});
		});

		//BG range that ranges from 0-10 and automatically set to 4-7.
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

		//For Gender dropdown
		var classes = "..";
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('select');
			var instances = M.FormSelect.init(elems, classes);
		});

		// Get & read the slider value.
		document.getElementById('signed_up').addEventListener('click', function() {
			//Get slider values. This is stored in an array
			var bgval = slider.noUiSlider.get();
			//Get the first and second value from array and store in variable
			var bgvval1 = parseInt(bgval[0]);
			var bgvval2 = parseInt(bgval[1]);
			//Get hidden inputs element and set the value from the variable. The value will be retreived for php to use
			document.getElementById('sliderBGValue1').value = bgvval1;
			document.getElementById('sliderBGValue2').value = bgvval2;
		});

	</script>

	<?php

	//Removes php errors displayed on page.
	error_reporting(0);

	if (isset($_POST["sign_up"])) {
		
		$user = $_POST['user'];
		$fname = $_POST['fname'];
		$sname = $_POST['sname'];
		$pword = $_POST['pword'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$weight = $_POST['weight'];
		$bgVal1 = $_POST['bgvval1'];
		$bgVal2 = $_POST['bgvval2'];

		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $pword);
		$lowercase = preg_match('@[a-z]@', $pword);
		$number    = preg_match('@[0-9]@', $pword);
		$specialChars = preg_match('@[^\w]@', $pword);

		//If all the fields are not empty then start querying and executing scripts in the database
		if (
			!empty($_POST['user']) && !empty($_POST['fname']) && !empty($_POST['sname']) && !empty($_POST['pword']) && !empty($_POST['dob']) && !empty($_POST['gender'])
			&& !empty($_POST['weight'])
		) {
			//Password validation.
			if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pword) < 8) {
				echo "<script type='text/javascript'>alert(`Password should contain:\n 1. At least 8 characters in length \n 2. At least one upper case letter,\n 3. At least one number,\n 4. At least one special character.`);</script>";
			}
			//If fields are not empty and password validation is successful.
			else {
				$conn = mysqli_connect('localhost', 'root', '', 'diabetes_db');

				//If there's a connection problem
				if (!$conn) {
					//Display alert if connection to database was unsuccessful
					echo "<script type='text/javascript'>alert('Connection to database was not possible');</script>";
					die();
				}

				$sql = "SELECT * FROM users WHERE userID='" . $user . "'";
				$result = $conn->query($sql);
				
				//If the users table has no record of the same userID
				if ($result->num_rows == 0) {

					//Insert statement to add a new user to the users table.
					$sql = "INSERT INTO users(userID, fname, sName, password, dob, gender, weight, bgRange1, bgRange2) VALUES('$user','$fname','$sname','$pword','$dob','$gender','$weight','$bgVal1','$bgVal2')";
					//$sql="INSERT INTO $assignTable (userID ,medName, activityType, date, time, bgLevel, emotionalS, qAInsluin, backInsulin, injection_Location) VALUES('$user','$medName','$aType','$currentDate','$time','$bgLevel','$emotion','$qA','$bK', '$injectL')";

					$result = mysqli_query($conn, $sql);

					// When Account Successfully Created  
					if ($result) {
						echo "<script>alert('Successfully signed up');</script>";
					}
					//else if there was a problem with inserting the data.
					else {
						echo "<script>alert('Failed to create account!');</script>";
					}
				} 
				else {
					echo "<script>alert('That username already exists! Please try again with another.');</script>";
				}
			}
		}
		else {
			echo "<script>alert('All fields are required!');</script>";
		}
	}

	?>

</body>

</html>