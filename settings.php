<?php
include('login.php'); // Includes Login Script
include('session.php');

if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

$con = mysqli_connect("stardock.cs.virginia.edu", "cs4750ydc5yf", "yujin", "cs4750ydc5yf");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$computing_id = mysqli_real_escape_string($con, $_SESSION['login_user']);
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$year = mysqli_real_escape_string($con, $_POST['year']);
$major = mysqli_real_escape_string($con, $_POST['major']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$confirm = mysqli_real_escape_string($con, $_POST['confirm']);
$maj = strlen($major);

if(isset($_POST['update'])) {
    if(!empty($year) AND (is_nan($year) OR $year < 999 OR $year > 9999)) {
        $yearErr = "Year must be a 4 digit number";
        $year = "";
    }
    if(!empty($major) AND ($maj < 2 OR $maj > 4)) {
        $majErr = "Major must be the 2, 3, or 4 letter department abbreviation";
        $major = "";
    }
    if($password != $confirm) {
        $conErr = "The passwords do not match";
        $password = "";
        $confirm = "";
    }
    $message = "";
}

if(isset($_POST['update']) AND (!empty($first_name) OR !empty($last_name) OR !empty($year) OR !empty($major) OR (!empty($password) AND $password = $confirm)) AND $yearErr != "Year must be a 4 digit number" AND $majErr != "Major must be the 2, 3, or 4 letter department abbreviation" AND $conErr != "The passwords do not match") {
    if($first_name != "") {
        mysqli_query($con, "UPDATE student SET first_name = '$first_name' WHERE computing_id = '$computing_id'");
        $first_name = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($last_name != "") {
        mysqli_query($con, "UPDATE student SET last_name = '$last_name' WHERE computing_id = '$computing_id'");
        $last_name = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($year != "") {
        mysqli_query($con, "UPDATE student SET year = '$year' WHERE computing_id = '$computing_id'");
        $year = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($major != "") {
        mysqli_query($con, "UPDATE student SET major = '$major' WHERE computing_id = '$computing_id'");
        $major = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($password != "") {
        mysqli_query($con, "UPDATE student SET password = '$password' WHERE computing_id = '$computing_id'");
        $password = "";
        $confirm = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }
}

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
                            <a href="dept.html"><span class="l"></span><span class="r"></span><span class="t">CS Department</span></a>
                            <ul>
                                <li><a href="major.html">Major</a>
                                    <ul>
                                        <li><a href="bscs.html">Bachelor of Science</a></li>
                                        <li><a href="bacs.html">Bachelor of Arts</a></li>
                                    </ul>
                                </li>
                                <li><a href="minor.html">Minor</a></li>
                                <li><a href="faculty.php">Faculty</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="registry.php"><span class="l"></span><span class="r"></span><span class="t">Course Registry</span></a>
                        </li>       
                        <li>
                            <a href="about.html"><span class="l"></span><span class="r"></span><span class="t">About</span></a>
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
                                            Settings
                                        </h2>
                                        <div class="art-PostContent">
                                            <p>Here you can update your name, year, major, and password as necessary.</p>
                                            <p><div class="form">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="update">
                                                <table><tr>
                                                <td><label>First Name</label></td>
                                                <td><input type="text" name="first_name" value="<?php echo htmlentities($first_name) ?>" placeholder="ex. Bob"></td></tr>
                                            <tr><td><label>Last Name</label></td>
                                                <td><input type="text" name="last_name" value="<?php echo htmlentities($last_name) ?>" placeholder="ex. Kim"></td></tr>
                                            <tr><td><label>Year</label></td>
                                                <td><input type="text" name="year" value="<?php echo htmlentities($year) ?>" placeholder="ex. 2015"><span class="error"> <?php echo $yearErr;?></span></td></tr>
                                            <tr><td><label>Major</label></td>
                                                <td><input type="text" name="major" value="<?php echo htmlentities($major) ?>" placeholder="ex. BACS"><span class="error"> <?php echo $majErr;?></span></td></tr>
                                            <tr><td><label>Password</label></td>
                                                <td><input type="password" name="password" value="<?php echo htmlentities($password) ?>" placeholder="ex. password"></td></tr>
                                            <tr><td><label>Confirm Password</label></td>
                                                <td><input type="password" name="confirm" value="<?php echo htmlentities($confirm) ?>" placeholder="ex. password"><span class="error"> <?php echo $conErr;?></span></td></tr></table>
                                            <p><span class="art-button-wrapper">
                                                    <span class="l"> </span>
                                                    <span class="r"> </span>
                                                    <input class="art-button" type="submit" name="update" value="Update" />
                                                </span></p>
                                                <p><?php echo $message; ?>
                                            </form>
                                            </div>
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
                                            <div align="center">Hello there, <?php echo $name; ?>.
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