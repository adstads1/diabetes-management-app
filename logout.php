<?php  
//Ends the session for when the user wishes to logout when pressing the logout button in settings.php
session_start();  
unset($_SESSION['sess_user']);  
session_destroy();  
header("location:index.php");  
exit();
?> 