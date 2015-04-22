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

$sec_id = $_GET['sec_id'];
$sectionlist = mysqli_query($con, "SELECT section_id FROM section where semester = 2 AND year = 2015");
$validupdate = 0;

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
   while($row = mysqli_fetch_array($sectionlist)) {
        if (stristr($q, substr($row['section_id'], 0, $len))) {
            if ($hint === "") {
                $hint = $row['section_id'];
            } else {
                $hint .= ", ";
                $hint .= $row['section_id'];
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>