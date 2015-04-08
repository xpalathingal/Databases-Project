<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$con = mysqli_connect("stardock.cs.virginia.edu", "cs4750ydc5yf", "yujin", "cs4750ydc5yf");
// Check connection
if(mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
session_start(); // Starting Session
$user_check = $_SESSION['login_user']; // Storing Session
// SQL Query To Fetch Complete Information Of User
$query = "SELECT * FROM student WHERE computing_id = '$user_check'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
$login_session = $row['computing_id'];
$name = $row['first_name'];
if(!isset($login_session)) {
	mysql_close($con); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}
?>