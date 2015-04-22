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

mysqli_query($con, "CREATE OR REPLACE VIEW student_reqs AS
SELECT computing_id, course_id, name, credits
FROM student NATURAL JOIN requirements NATURAL JOIN course
ORDER BY student.computing_id");

$results = mysqli_query($con, "SELECT *
    FROM student_reqs
    WHERE computing_id ='$login_session' AND course_id NOT IN 
        (SELECT course_id
        FROM takes NATURAL JOIN section
        WHERE computing_id = '$login_session')");

mysqli_close($con);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>

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
                                            Course Checklist
                                        </h2>
                                        <div class="art-PostContent">
                                            <b>Courses you still need to take: </b>
                                    <br><br>
                                    <?php
                                    echo "<table border='1'>
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Course Name</th>    
                                        <th>Credits</th>
                                    </tr>";

                                    while($row = mysqli_fetch_array($results)) {
                                      echo "<tr>";
                                      echo "<td>" . $row['department']. " " . $row['course_id'] . "</td>";
                                      echo "<td>" . $row['name'] . "</td>";
                                      echo "<td>" . $row['credits'] . "</td>";
                                      echo "</tr>";
                                  }

                                  echo "</table>";
                                  ?>
                                  </br>
<form action="export.php" method="post" name="export_excel">
 
            <div class="control-group">
                <div class="controls">
                    <button type="submit" id="export" name="export" class="btn btn-primary button-loading" data-loading-text="Loading...">Export MySQL Data to JSON</button>
                </div>
            </div>
        </form> 
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