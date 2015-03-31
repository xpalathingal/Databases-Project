<?php

$con=mysqli_connect("stardock.cs.virginia.edu","cs4750ydc5yf","yujin","cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$computing_id = mysqli_real_escape_string($con, $_POST['computing_id']);
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$year = mysqli_real_escape_string($con, $_POST['year']);
$major = mysqli_real_escape_string($con, $_POST['major']);
$password = mysqli_real_escape_string($con, $_POST['password']);

mysqli_query($con,"INSERT INTO student (computing_id, first_name, last_name, year, major, password)
VALUES ('$computing_id', '$first_name', '$last_name', '$year', '$major', '$password')");

  echo "You have been added to the system!";

mysqli_close($con);

?>