<?php
include('connect.php');

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if(isset($_POST['login'])) {
    if(empty($_POST['username']) || empty($_POST['pass'])) {
        $error = "Invalid username/password";
    }
    else { // Define $username and $password
      $id = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['pass']);
        // SQL query to fetch information of registerd users and finds user match.
      $query = "SELECT * FROM student WHERE computing_id = '$id' AND password = '$password'";
      $res = mysqli_query($con, $query);
      
      $query2 = "SELECT * FROM professor WHERE employee_id = '$id' AND password = '$password'";
      $res2 = mysqli_query($con, $query2);

      $_SESSION['login_user'] = $id; // Initializing Session
      
      if(($res->num_rows) > 0) {
            $_SESSION['user_role'] = "student";
            header("location: profile.php"); // Redirecting To Other Page
        }
        else if(($res2->num_rows) > 0) {
            $_SESSION['user_role'] = "instructor";
            header("location: instructor.php"); // Redirecting To Other Page
        }
        else {
            $error = "Invalid username/password";
        }
    }
}
mysqli_close($con); // Closing Connection
?>