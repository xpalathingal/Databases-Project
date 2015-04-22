<?php
include('session.php');

if($_SESSION['user_role'] !== "student") {
    mysql_close($con); // Closing Connection
    header('Location: index.php'); // Redirecting To Home Page
}
mysqli_close($con);

$con = mysqli_connect("stardock.cs.virginia.edu", "cs4750xvp2hec", "student", "cs4750xvp2he");
        // Check connection
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$host = "stardock.cs.virginia.edu"; 
$username = "cs4750xvp2hec"; 
$password = "student"; 
$db_name = "cs4750yxvp2he"; 
$con = mysql_connect("$host", "$username", "$password") or die ("cannot connect");
mysql_select_db("$db_name") or die ("cannot select DB");
$sql = "SELECT course.department, course.course_id, course.name
    FROM student NATURAL JOIN requirements NATURAL JOIN course
    WHERE computing_id ='$login_session' AND course_id NOT IN 
        (SELECT course_id
        FROM takes NATURAL JOIN section
        WHERE computing_id = '$login_session')"; 
$result = mysql_query($sql);
$json = array();
if(mysql_num_rows($result)) {
	while($row=mysql_fetch_row($result)) {
		$json['Courses needed:'][]=$row;
	}
}
mysql_close($db_name);
echo json_encode($json);
?>