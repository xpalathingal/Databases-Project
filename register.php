<?php
include('login.php'); // Includes Login Script
include('connect.php');

if(isset($_SESSION['login_user']) AND $_SESSION['user_role'] == "student") {
    header("location: profile.php");
}

if(isset($_SESSION['login_user']) AND $_SESSION['user_role'] == "instructor") {
    header("location: instructor.php");
}

$computing_id = mysqli_real_escape_string($con, $_POST['computing_id']);
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$year = mysqli_real_escape_string($con, $_POST['year']);
$major = mysqli_real_escape_string($con, $_POST['major']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$query = "SELECT * FROM student WHERE computing_id = '$computing_id'";
$res = mysqli_query($con, $query);
$maj = strlen($major);

mysqli_query($con, "ALTER TABLE student
    ADD CONSTRAINT student_registration_status
    CHECK (computing_id IN $computing_id)");

mysqli_query($con, "ALTER TABLE student
    ADD CONSTRAINT year_constraints
    CHECK (year > 999 OR year < 9999)");

if(isset($_POST['register'])) {
    if(empty($computing_id)) {
        $idErr = "Computing ID is required";
    }
    if (($res->num_rows) > 0) {
        $idErr = "Computing ID already registered";
    }
    if(empty($first_name)) {
        $fnErr = "First name is required";
    }
    if(empty($last_name)) {
        $lnErr = "Last name is required";
    }
    if(empty($year)) {
        $yearErr = "Year is required";
    }
    else if(is_nan($year) OR $year < 999 OR $year > 9999) {
        $yearErr = "Year must be a 4 digit number";
    }
    if(empty($major)) {
        $majErr = "Major is required";
    }
    if($maj < 2 OR $maj > 4) {
        $majErr = "Major must be the 2, 3, or 4 letter department abbreviation";
    }
    if(empty($major)) {
        $majErr = "Major is required";
    }
    if(empty($password)) {
        $passErr = "Password is required";
    }
}

if(($computing_id != "") and ($first_name != "") and ($last_name != "") and ($year != "") and ($major != "") and ($password != "")) {
    mysqli_query($con, "INSERT INTO student (computing_id, first_name, last_name, year, major, password)
        VALUES ('$computing_id', '$first_name', '$last_name', '$year', '$major', '$password')");

    $computing_id = $first_name = $last_name = $year = $major = $password = "";
    
    if(isset($_POST['register'])) { 
        $message = "You have been added to the system! Please try to login now.";
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
                                        Register
                                    </h2>
                                    <div class="art-PostContent">
                                        <p>If you haven't entered yourself into the system yet, pleae fill out this form to do so. However, if you've already registered before and simply can't remember your password, use the "Reset Password" link instead.</p>
                                        <p>If you're a professor and have not set up your instructor account yet, click <a href="instructorreg.php">here</a> to do so.</p>
                                        <p><div class="form">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="register">
                                                <table><tr>
                                                    <td><label>Computing ID</label></td>
                                                    <td><input type="text" name="computing_id" value="<?php echo htmlentities($computing_id) ?>" placeholder="ex. mst3k"><span class="error"> * <?php echo $idErr;?></span></td></tr>
                                                    <tr><td><label>First Name</label></td>
                                                        <td><input type="text" name="first_name" value="<?php echo htmlentities($first_name) ?>" placeholder="ex. Bob"><span class="error"> * <?php echo $fnErr;?></span></td></tr>
                                                        <tr><td><label>Last Name</label></td>
                                                            <td><input type="text" name="last_name" value="<?php echo htmlentities($last_name) ?>" placeholder="ex. Kim"><span class="error"> * <?php echo $lnErr;?></span></td></tr>
                                                            <tr><td><label>Year</label></td>
                                                                <td><input type="text" name="year" value="<?php echo htmlentities($year) ?>" placeholder="ex. 2015"><span class="error"> * <?php echo $yearErr;?></span></td></tr>
                                                                <tr><td><label>Major</label></td>
                                                                    <td><input type="text" name="major" value="<?php echo htmlentities($major) ?>" placeholder="ex. BACS"><span class="error"> * <?php echo $majErr;?></span></td></tr>
                                                                    <tr><td><label>Password</label></td>
                                                                        <td><input type="password" name="password" value="<?php echo htmlentities($password) ?>" placeholder="ex. password"><span class="error"> * <?php echo $passErr;?></span></td></tr></table>
                                                                        <p><span class="art-button-wrapper">
                                                                            <span class="l"> </span>
                                                                            <span class="r"> </span>
                                                                            <input class="art-button" type="submit" name="register" value="Register" />
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
                                                                    <div class="t">Login</div>
                                                                </div>
                                                            </div><div class="art-BlockContent">
                                                            <div class="art-BlockContent-body">
                                                                <div><form class="loginform" method="post" action="">
                                                                    <table><tr>
                                                                        <td><label>Username</label></td>
                                                                        <td><input type="text" name="username" placeholder="ex. mst3k"></td></tr>
                                                                        <tr><td><label>Password</label></td>
                                                                            <td><input type="password" name="pass"></td></tr></table>
                                                                            <div align="center">
                                                                                <p><span class="error"><?php echo $error;?></span></p>
                                                                                <span class="art-button-wrapper">
                                                                                    <span class="l"> </span>
                                                                                    <span class="r"> </span>
                                                                                    <input class="art-button" type="submit" name="login" value="Login" />
                                                                                </span></form>
                                                                                <p><div class="art-Footer-text"><a href="/~ydc5yf/register.php">Register</a> | <a href="/~ydc5yf/reset.php">Reset Password</a>
                                                                                </div>
                                                                            </div>
                                                                            
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
