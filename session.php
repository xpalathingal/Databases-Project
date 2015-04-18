<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$con = mysqli_connect("stardock.cs.virginia.edu", "cs4750ydc5yf", "yujin", "cs4750ydc5yf");
// Check connection
if(mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
session_start(); // Starting Session
$user_check = $_SESSION['login_user']; // Storing Session
$_SESSION['user_role'] = "";
// SQL Query To Fetch Complete Information Of User
$query = "SELECT * FROM student WHERE computing_id = '$user_check'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
$login_session = $row['computing_id'];
$greet = $row['first_name'];
$role = $row['role'];
$_SESSION['user_role'] = $role;
if(!(($res->num_rows) > 0)) {
	$query2 = "SELECT * FROM professor WHERE employee_id = '$user_check'";
	$res2 = mysqli_query($con, $query2);
	$row2 = mysqli_fetch_assoc($res2);
	$login_session = $row2['employee_id'];
	$greet = $row2['first_name'];
	$role = $row2['role'];
	$_SESSION['user_role'] = $role;
	}
if(!isset($login_session)) {
	mysql_close($con); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}
?>