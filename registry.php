<html lang="en">
<head>
<meta charset="utf-8">
<title>Fall 2015 CS Course Offerings</title>

<style>
label {
display: inline-block;
width: 5em;
}
</style>
</head>
<body>
 <a href="details.php">Class Details</a> 
 <br>

<?php
$con=mysqli_connect("stardock.cs.virginia.edu","cs4750ydc5yf","yujin","cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$department = mysqli_real_escape_string($con, $_GET['department']);
$course_id = mysqli_real_escape_string($con, $_GET['course_id']);
$name = mysqli_real_escape_string($con, $_GET['name']);
$desc = mysqli_real_escape_string($con, $_GET['desc']);
$credits = mysqli_real_escape_string($con, $_GET['credits']);
$first_name = mysqli_real_escape_string($con, $_GET['first_name']);
$last_name = mysqli_real_escape_string($con, $_GET['last_name']);
$results = mysqli_query($con,"SELECT * FROM course 
LEFT OUTER JOIN section on course.course_id = section.course_id 
LEFT OUTER JOIN teaches on section.section_id = teaches.section_id 
LEFT OUTER JOIN professor on teaches.employee_id = professor.employee_id 
WHERE fall2015=1 ");
echo "<table border='1'>
<tr>
<th>Course</th>
<th>Name</th>
<th>Description</th>
<th>Professor</th>
<th>Credits</th>
</tr>";
while($row = mysqli_fetch_array($results)) {
echo "<tr>";
echo "<td>" . $row['department']. " " . $row['course_id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['desc'] . "</td>";
echo "<td>" . $row['first_name']. " " . $row['last_name'] . "</td>";
echo "<td>" . $row['credits'] . "</td>";
echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

</body>
</html>
