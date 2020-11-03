<?php
$dbhost = 'elephant.ecs.westminster.ac.uk';
$dbuser = 'w1643667';
$dbpass = 'Y5kMK7opPIIL';
$dbname = 'w1643667_0';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) ;
if (!$conn)
{
  die('Could not connect: ' . mysqli_error($conn));
}
mysqli_select_db($conn, $dbname);
?>
