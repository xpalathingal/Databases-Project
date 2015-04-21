<?php
$con = mysqli_connect("stardock.cs.virginia.edu", "cs4750xvp2he", "dammityujin", "cs4750xvp2he");
        // Check connection
if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>