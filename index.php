<!DOCTYPE html>

<html>

<head>

	<!-- Compiled and minified CSS for materialze-->
	<link rel="stylesheet" href="materialize\materialize.css">

	<!-- Compiled and minified JavaScript -->
	<script src="materialize\materializejs.js"></script>
	<link rel="stylesheet" href="main.css">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Sign in</title>

</head>

<body>

	<h1 style="margin-top:159px; margin-bottom: 0px" class="center-align">Sign in</h1>

	<!--Form used for signing in with grids. This is from the materialize framework. Grid with a row and 12 equal width columns.-->
	<div class="row">
		<form method="POST" class="col s12" style="margin-top:40px; margin-bottom: 0px">
			<div class="row">
				<!--To center the fields I've distributed the textfields from column 2-8 out of the 12 equal width coloumns-->
				<div class="input-field col s8 offset-s2 ">
					<input id="username" type="text" class="validate" name="user">
					<label for="username">Username</label>
				</div>
				<div class="input-field col s8 offset-s2 ">
					<input id="password" type="password" class="validate" name="pword">
					<label for="password">Password</label>
				</div>
				<div class="input-field col s8 offset-s2 ">
					<button class="btn waves-effect waves-light btn-large" style="width:100%" type="submit" name="login">Login</button>
				</div>
			</div>
		</form>
	</div>

	<!--Links user to sign in page if text is clicked-->
	<h4 class="center-align">Don't have an account? <a href="sign_up.php" style="color: #AF0404;"><b>Sign up</b></a></h4>

	<?php

	//Removes php errors displayed on page.
	error_reporting(0);

	//If the login button is pressed	
	if (isset($_POST["login"])) {

		$user = $_POST['user'];
		$pword = $_POST['pword'];
		//if the username and password field isn't empty
		if (!empty($_POST['user']) && !empty($_POST['pword'])) {

			$conn = mysqli_connect('localhost', 'root', '', 'diabetes_db');

			//If there's a connection problem
			if (!$conn) {
				//Display alert if there's a connection problem and end connection
				echo "<script type='text/javascript'>alert('Connection to database was not possible');</script>";
				die();
			}

			//Select statement which retrieves the username and password
			$sql = "SELECT * FROM users WHERE userID='" . $user . "' AND password='" . $pword . "'";
			$result = $conn->query($sql);

			//If the matched number of rows is at least one (not 0).
			if ($result->num_rows != 0) {
				//Gets result of row in user table of username and password.
				while ($row = mysqli_fetch_assoc($result)) {
					//username & password from user table retreived and assigned to variable
					$dbusername = $row['userID'];
					$dbpassword = $row['password'];
				}
				// When the username and password has successfully matched with the username and password from user table which is stored in $dbusername and $dbpassword.
				if ($user == $dbusername && $pword == $dbpassword) {
					//Start session
					session_start();
					$_SESSION['ses_user'] = $user;

					/* Redirect browser to the add reading page*/
					header("Location:add_reading.php");
					exit();
				}
			}
			//If the username and password couldn't be found
			else {
				echo "<script>alert('An invalid username or password has been entered');</script>";
			}
		}
		//If the fields are empty
		else {
			echo "<script>alert('All fields are required!')</script>";
		}
	}

	?>

</body>

</html>