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
$password = mysqli_real_escape_string($con, $_POST['password']);
$confirm = mysqli_real_escape_string($con, $_POST['confirm']);
if($_SESSION['user_role'] == "student") {
    $query = "SELECT * FROM student WHERE computing_id = '$computing_id'";
}
else if($_SESSION['user_role'] == "instructor") {
    $query = "SELECT * FROM professor WHERE employee_id = '$computing_id'";
}
$res = mysqli_query($con, $query);

if(isset($_POST['reset'])) {
    if(empty($computing_id)) {
        $idErr = "Computing ID is required";
    }
    else if (!($res->num_rows)) {
        $idErr = "Account does not exist";
    }
    if(empty($password)) {
        $passErr = "Password is required";
    }
    if(empty($confirm)) {
        $conErr = "Retype your password to confirm it";
    }
    else if($password != $confirm) {
        $conErr = "The passwords do not match";
    }
}

if(($computing_id != "") and ($idErr != "Account does not exist") and ($password != "") and ($confirm != "") and ($conErr != "The passwords do not match")) {
    if($_SESSION['user_role'] == "student") {
        mysqli_query($con, "UPDATE student SET password = '$password' WHERE computing_id = '$computing_id'");

        $computing_id = $password = $confirm = "";
        
        if(isset($_POST['reset'])) { 
            $message = "Your password has been reset! Please try to login now.";
        }
    }
    else if($_SESSION['user_role'] == "instructor") {
        mysqli_query($con, "UPDATE professor SET password = '$password' WHERE employee_id = '$computing_id'");

        $computing_id = $password = $confirm = "";
        
        if(isset($_POST['reset'])) { 
            $message = "Your password has been reset! Please try to login now.";
        }
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
                                        Reset Your Password
                                    </h2>
                                    <div class="art-PostContent">
                                        <p>Oops, it seems like you've forgotten your password. Lucky for you we can reset it for you in just a few moments! Simply input your computing id and the password you would like to use.</p>
                                        <p><div class="form">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="register">
                                                <table><tr>
                                                    <td><label>Computing ID</label></td>
                                                    <td><input type="text" name="computing_id" value="<?php echo htmlentities($computing_id) ?>" placeholder="ex. mst3k"><span class="error"> * <?php echo $idErr;?></span></td></tr>
                                                    <tr><td><label>Password</label></td>
                                                        <td><input type="password" name="password" value="<?php echo htmlentities($password) ?>" placeholder="ex. password"><span class="error"> * <?php echo $passErr;?></span></td></tr>
                                                        <tr><td><label>Confirm Password</label></td>
                                                            <td><input type="password" name="confirm" value="<?php echo htmlentities($confirm) ?>" placeholder="ex. password"><span class="error"> * <?php echo $conErr;?></span></td></tr></table>
                                                            <p><span class="art-button-wrapper">
                                                                <span class="l"> </span>
                                                                <span class="r"> </span>
                                                                <input class="art-button" type="submit" name="reset" value="Reset Password" />
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
