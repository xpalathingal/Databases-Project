<?php
include('connect.php');

session_start(); // Starting Session
$user_check = $_SESSION['login_user']; // Storing Session
$_SESSION['user_role'] = "";
// SQL Query To Fetch Complete Information Of User
$query = "SELECT * FROM student WHERE computing_id = '$user_check'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
$login_session = $row['computing_id'];
$greet = $row['first_name'];
$_SESSION['user_role'] = "student";
if(!(($res->num_rows) > 0)) {
	$query2 = "SELECT * FROM professor WHERE employee_id = '$user_check'";
	$res2 = mysqli_query($con, $query2);
	$row2 = mysqli_fetch_assoc($res2);
	$login_session = $row2['employee_id'];
	$greet = $row2['first_name'];
	$_SESSION['user_role'] = "instructor";
	}
if(!isset($login_session)) {
	mysql_close($con); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}
?>