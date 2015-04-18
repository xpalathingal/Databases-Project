<?php

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if(isset($_POST['login'])) {
    if(empty($_POST['username']) || empty($_POST['pass'])) {
        $error = "Invalid username/password";
    }
    else { // Define $username and $password
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $con = mysqli_connect("stardock.cs.virginia.edu", "cs4750ydc5yf", "yujin", "cs4750ydc5yf");
        // Check connection
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $computing_id = mysqli_real_escape_string($con, $_POST['username']);
      $employee_id = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['pass']);
        // SQL query to fetch information of registerd users and finds user match.
      $query = "SELECT * FROM student WHERE computing_id = '$computing_id' AND password = '$password'";
      $res = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($res);
      $role = $row['role'];
      
      $query2 = "SELECT * FROM professor WHERE employee_id = '$employee_id' AND password = '$password'";
      $res2 = mysqli_query($con, $query2);
      $row2 = mysqli_fetch_assoc($res2);
      $role2 = $row2['role'];
      
      if(($res->num_rows) > 0) {
            $_SESSION['login_user'] = $computing_id; // Initializing Session
            $_SESSION['user_role'] = $role;
            header("location: profile.php"); // Redirecting To Other Page
        }
        else if(($res2->num_rows) > 0) {
            $_SESSION['login_user'] = $employee_id; // Initializing Session
            $_SESSION['user_role'] = $role2;
            header("location: instructor.php"); // Redirecting To Other Page
        }
        else {
            $error = "Invalid username/password";
        }
        mysqli_close($con); // Closing Connection
    }
}
?>