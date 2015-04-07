<html lang="en">
<head>
<meta charset="utf-8">
<title>Fall 2015 CS Course Offerings</title>

<script>
function showDesc(desc) {
    alert(desc);
}
</script>

<style>
label {
display: inline-block;
width: 5em;
}
</style>
</head>
<body>
 <a href="registry.php">Back to fall 2015 course listing</a> 

<?php
$con=mysqli_connect("stardock.cs.virginia.edu","cs4750ydc5yf","yujin","cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$department = mysqli_real_escape_string($con, $_GET['department']);
$course_id = mysqli_real_escape_string($con, $_GET['course_id']);
$name = mysqli_real_escape_string($con, $_GET['name']);
$building = mysqli_real_escape_string($con, $_GET['building']);
$room_number = mysqli_real_escape_string($con, $_GET['room_number']);
$days = mysqli_real_escape_string($con, $_GET['days']);
$start_time = mysqli_real_escape_string($con, $_GET['start_time']);
$end_time = mysqli_real_escape_string($con, $_GET['end_time']);
$results = mysqli_query($con,"SELECT * FROM course
	LEFT OUTER JOIN section on course.course_id = section.course_id
	LEFT OUTER JOIN held_in on section.section_id = held_in.section_id
	LEFT OUTER JOIN timeslots on section.timeslot_id = timeslots.timeslot_id
	WHERE fall2015=1");
echo "<table border='1'>
<tr>
<th>Course</th>
<th>Name</th>
<th>Location</th>
<th>Time</th>
</tr>";
while($row = mysqli_fetch_array($results)) {
echo "<tr>";
echo "<td>" . $row['department']. " " . $row['course_id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['building']. " " . $row['room_number'] . "</td>";
echo "<td>" . $row['days']. " " . $row['start_time']. "-" . $row['end_time'] . "</td>";
echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

</body>
</html>
