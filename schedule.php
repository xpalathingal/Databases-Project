<?php
include('session.php');

$con = mysqli_connect("stardock.cs.virginia.edu", "cs4750ydc5yf", "yujin", "cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_SESSION['user_role'] !== "student") {
    mysql_close($con); // Closing Connection
    header('Location: index.php'); // Redirecting To Home Page
}

$section_id = mysqli_real_escape_string($con, $_GET['section_id']);
$course_id = mysqli_real_escape_string($con, $_GET['course_id']);
$name = mysqli_real_escape_string($con, $_GET['name']);

$results = mysqli_query($con,"SELECT * FROM takes natural join section natural join course
 WHERE computing_id = '$login_session'AND semester = 2 AND year = 2015");

mysqli_close($con);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
<script>

function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "getclass.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>CompSci Buddy</title>

    <script type="text/javascript" src="script.js"></script>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
</head>
<body>
    <div id="art-main">
        <div class="art-Sheet">
            <div class="art-Sheet-tl"></div>
            <div class="art-Sheet-tr"></div>
            <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <div class="art-Sheet-tc"></div>
            <div class="art-Sheet-bc"></div>
            <div class="art-Sheet-cl"></div>
            <div class="art-Sheet-cr"></div>
            <div class="art-Sheet-cc"></div>
            <div class="art-Sheet-body">
                <div class="art-nav">
                	<div class="l"></div>
                	<div class="r"></div>
                	<ul class="art-menu">
                		<li>
                            <a href="/~ydc5yf" class=" active"><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
                        </li>
                        <li>
                            <a href="dept.php"><span class="l"></span><span class="r"></span><span class="t">CS Department</span></a>
                            <ul>
                                <li><a href="major.php">Major</a>
                                    <ul>
                                        <li><a href="bscs.php">Bachelor of Science</a></li>
                                        <li><a href="bacs.php">Bachelor of Arts</a></li>
                                    </ul>
                                </li>
                                <li><a href="minor.php">Minor</a></li>
                                <li><a href="faculty.php">Faculty</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="registry.php"><span class="l"></span><span class="r"></span><span class="t">Course Registry</span></a>
                        </li>       
                        <li>
                            <a href="about.php"><span class="l"></span><span class="r"></span><span class="t">About</span></a>
                        </li>
                    </ul>
                </div>
                <div class="art-Header">
                    <div class="art-Header-jpeg"></div>
                    <div class="art-Logo">
                        <h1 id="name-text" class="art-Logo-name"><a href="#">CompSci Buddy</a></h1>
                        <div id="slogan-text" class="art-Logo-text">A CS Major's Best Friend</div>
                    </div>
                </div>
                <div class="art-contentLayout">
                    <div class="art-content">
                        <div class="art-Post">
                            <div class="art-Post-body">
                                <div class="art-Post-inner">
                                    <h2 class="art-PostHeader">
                                        My Schedule
                                    </h2>
                                    <div class="art-PostContent">
                                        <?php
                                        echo "<table border='1'>
                                        <tr>
                                        <th>Section ID</th>
                                        <th>Course ID</th>
                                        <th>Course Name</th>
                                        </tr>";

                                        while($row = mysqli_fetch_array($results)) {
                                          echo "<tr>";
                                          echo "<td>" . $row['section_id'] . "</td>";
                                          echo "<td>" . $row['course_id'] . "</td>";
                                          echo "<td>" . $row['name'] . "</td>";
                                          echo "</tr>";
                                      }

                                      echo "</table>";

                                      ?>

                                      <p>Do you want to add a class to current class schedule?</p>

                                                                             

                                      <form action="addclass.php" method="GET">

                                        Section ID: <input type="text" name="sec_id" onkeyup="showHint(this.value)"><br>
                                         <p>Suggestions: <span id="txtHint"></span></p>
                                        <input type="submit" value = "Add Class">
                                    </form>

                                   

                                    <p>Do you want to delete a class from your current class schedule?</p>
                                    <form action="deleteclass.php" method="GET">

                                        Section ID: <input type="text" name="sec_id"><br>
                                        <input type="submit" value = "Delete Class">
                                    </div>
                                </div>

                                <div class="cleared"></div>
                            </div>
                        </div>
                    </div>
                    <div class="art-sidebar1">
                        <div class="art-Block">
                            <div class="art-Block-tl"></div>
                            <div class="art-Block-tr"></div>
                            <div class="art-Block-bl"></div>
                            <div class="art-Block-br"></div>
                            <div class="art-Block-tc"></div>
                            <div class="art-Block-bc"></div>
                            <div class="art-Block-cl"></div>
                            <div class="art-Block-cr"></div>
                            <div class="art-Block-cc"></div>
                            <div class="art-Block-body">
                                <div class="art-BlockHeader">
                                    <div class="l"></div>
                                    <div class="r"></div>
                                    <div class="art-header-tag-icon">
                                        <div class="t">Welcome back!</div>
                                    </div>
                                </div><div class="art-BlockContent">
                                <div class="art-BlockContent-body">
                                    <div align="center">Hello there, <?php echo $greet; ?>.
                                        <br><br><a href="schedule.php">My Schedule</a>
                                        <br><a href="history.php">Course History</a>
                                        <br><a href="checklist.php">Course Checklist</a>
                                        <br><a href="settings.php">Settings</a>
                                        <br><a href="logout.php">Log Out</a>
                                    </div>
                                    <div class="cleared"></div>
                                </div>
                            </div>
                            <div class="cleared"></div>
                        </div>
                    </div>
                    <div class="art-Block">
                        <div class="art-Block-tl"></div>
                        <div class="art-Block-tr"></div>
                        <div class="art-Block-bl"></div>
                        <div class="art-Block-br"></div>
                        <div class="art-Block-tc"></div>
                        <div class="art-Block-bc"></div>
                        <div class="art-Block-cl"></div>
                        <div class="art-Block-cr"></div>
                        <div class="art-Block-cc"></div>
                        <div class="art-Block-body">
                            <div class="art-BlockHeader">
                                <div class="l"></div>
                                <div class="r"></div>
                                <div class="art-header-tag-icon">
                                    <div class="t">Group Info</div>
                                </div>
                            </div><div class="art-BlockContent">
                            <div class="art-BlockContent-body">
                                <div>
                                    <b>Yujin Cho</b> (ydc5yf)
                                    <br><b>Casey Cooke</b> (cjc4gz)
                                    <br><b>Diane Lee</b> (dl4md)
                                    <br><b>Xavier Palathingal</b> (xvp2he)
                                </div>
                                <div class="cleared"></div>
                            </div>
                        </div>
                        <div class="cleared"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cleared"></div><div class="art-Footer">
        <div class="art-Footer-inner">
            <div class="art-Footer-text">
                <p>CS 4750 Database Systems (Spring 2015, Basit)</p>
            </div>
        </div>
        <div class="art-Footer-background"></div>
    </div>
    <div class="cleared"></div>
</div>
</div>
<div class="cleared"></div>
<p class="art-page-footer"><a href="http://webjestic.net/templates">CSS Template</a> created by <a href="http://webjestic.net">webJestic</a></p>
</div>

</body>
</html>