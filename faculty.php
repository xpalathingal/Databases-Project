<html lang="en">
<head>
<meta charset="utf-8">
<title>Computer Science Faculty</title>

<style>
label {
display: inline-block;
width: 5em;
}
</style>
</head>
<body>

<?php
$con=mysqli_connect("stardock.cs.virginia.edu","cs4750ydc5yf","yujin","cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$first_name = mysqli_real_escape_string($con, $_GET['first_name']);
$last_name = mysqli_real_escape_string($con, $_GET['last_name']);
$employee_id = mysqli_real_escape_string($con, $_GET['employee_id']);
$last_name = mysqli_real_escape_string($con, $_GET['last_name']);
$phone_number = mysqli_real_escape_string($con, $_GET['phone_number']);
$office_building = mysqli_real_escape_string($con, $_GET['office_building']);
$office_number = mysqli_real_escape_string($con, $_GET['office_number']);
$value = mysqli_real_escape_string($con, $_GET['value']);
$results = mysqli_query($con,"SELECT * FROM professor
LEFT OUTER JOIN rating on professor.employee_id = rating.employee_id");
echo "<table border='1'>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone #</th>
<th>Office</th>
<th>Rating</th>
</tr>";
while($row = mysqli_fetch_array($results)) {
echo "<tr>";
echo "<td>" . $row['first_name']. " " . $row['last_name'] . "</td>";
echo "<td>" . $row['employee_id']. "@virginia.edu" . "</td>";
echo "<td>" . $row['phone_number'] . "</td>";
echo "<td>" . $row['office_building']. " " . $row['office_number'] . "</td>";
echo "<td>" . $row['value'] . "</td>";
echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

</body>
</html>
