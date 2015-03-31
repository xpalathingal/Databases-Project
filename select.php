<?php

$con=mysqli_connect("stardock.cs.virginia.edu","cs4750ydc5yf","yujin","cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$employee_id = mysqli_real_escape_string($con, $_GET['employee_id']);
$first_name = mysqli_real_escape_string($con, $_GET['first_name']);
$last_name = mysqli_real_escape_string($con, $_GET['last_name']);

$results = mysqli_query($con,"SELECT * FROM professor");

echo "<table border='1'>
<tr>
<th>Computing ID</th>
<th>First Name</th>
<th>Last Name</th>
</tr>";

while($row = mysqli_fetch_array($results)) {
  echo "<tr>";
  echo "<td>" . $row['employee_id'] . "</td>";
  echo "<td>" . $row['first_name'] . "</td>";
  echo "<td>" . $row['last_name'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>