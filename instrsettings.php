<?php
include('login.php'); // Includes Login Script
include('connect.php');

if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

if($_SESSION['user_role'] !== "instructor") {
    mysql_close($con); // Closing Connection
    header('Location: index.php'); // Redirecting To Home Page
}

$person = $_SESSION['login_user'];
$query = "SELECT * FROM professor WHERE employee_id = '$person'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
$greet = $row['first_name'];

$computing_id = mysqli_real_escape_string($con, $_SESSION['login_user']);
$first_name = mysqli_real_escape_string($con, $_POST['first_name']);
$last_name = mysqli_real_escape_string($con, $_POST['last_name']);
$officenum = mysqli_real_escape_string($con, $_POST['officenum']);
$offbuild = mysqli_real_escape_string($con, $_POST['offbuild']);
$phone =  mysqli_real_escape_string($con, $_POST['phone']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$confirm = mysqli_real_escape_string($con, $_POST['confirm']);
$pho = strlen($phone);

if(isset($_POST['update'])) {
    if(!empty($phone) AND (is_nan($phone) OR $pho < 7 OR $pho > 7)) {
        $phoneErr = "Phone number must be a 7 digit number";
        $phone = "";
    }
    if($password != $confirm) {
        $conErr = "The passwords do not match";
        $password = "";
        $confirm = "";
    }
    $message = "";
}

if(isset($_POST['update']) AND (!empty($first_name) OR !empty($last_name) OR !empty($officenum) OR !empty($offbuild) OR !empty($phone) OR (!empty($password) AND $password = $confirm)) AND $phoneErr != "Phone number must be a 7 digit number" AND $conErr != "The passwords do not match") {
    if($first_name != "") {
        mysqli_query($con, "UPDATE professor SET first_name = '$first_name' WHERE computing_id = '$computing_id'");
        $first_name = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($last_name != "") {
        mysqli_query($con, "UPDATE professor SET last_name = '$last_name' WHERE computing_id = '$computing_id'");
        $last_name = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($officenum != "") {
        mysqli_query($con, "UPDATE professor SET office_number = '$officenum' WHERE computing_id = '$computing_id'");
        $officenum = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($offbuild != "") {
        mysqli_query($con, "UPDATE professor SET office_building = '$offbuild' WHERE computing_id = '$computing_id'");
        $offbuild = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($phone != "") {
        mysqli_query($con, "UPDATE professor SET phone_number = '$phone' WHERE computing_id = '$computing_id'");
        $phone = "";
        $message = "Your information has been updated! Please refresh to see any changes applied.";
    }

    if($password != "") {
        mysqli_query($con, "UPDATE professor SET password = '$password' WHERE computing_id = '$computing_id'");
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
                                        Settings
                                    </h2>
                                    <div class="art-PostContent">
                                        <p>Here you can update your name, office number, office building, phone number, and password as necessary.</p>
                                        <p><div class="form">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="update">
                                                <table><tr>
                                                    <td><label>First Name</label></td>
                                                    <td><input type="text" name="first_name" value="<?php echo htmlentities($first_name) ?>" placeholder="ex. Bob"></td></tr>
                                                    <tr><td><label>Last Name</label></td>
                                                        <td><input type="text" name="last_name" value="<?php echo htmlentities($last_name) ?>" placeholder="ex. Kim"></td></tr>
                                                        <tr><td><label>Office Number</label></td>
                                                            <td><input type="text" name="officenum" value="<?php echo htmlentities($officenum) ?>" placeholder="ex. 309"><span class="error"> <?php echo $offErr;?></span></td></tr>
                                                            <tr><td><label>Office Building</label></td>
                                                                <td><input type="text" name="offbuild" value="<?php echo htmlentities($offbuild) ?>" placeholder="ex. Rice"><span class="error"> <?php echo $buildErr;?></span></td></tr>
                                                                <tr><td><label>Phone Number</label></td>
                                                                <td><input type="text" name="phone" value="<?php echo htmlentities($phone) ?>" placeholder="ex. 1234567890"><span class="error"> <?php echo $phoneErr;?></span></td></tr>
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
                                                                <div align="center">Hello there, <?php echo $greet; ?>.
                                                                    <br><br><a href="manageclasses.php">Manage Classes</a>
                                        <br><a href="managestudents.php">Manage Students</a>
                                        <br><a href="instrsettings.php">Settings</a>
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