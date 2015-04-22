<?php
include('login.php'); // Includes Login Script
include('connect.php');

$person = $_SESSION['login_user'];
$query = "SELECT * FROM student WHERE computing_id = '$person'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
if($res->num_rows > 0) {
    $greet = $row['first_name'];
}
else {
    $query2 = "SELECT * FROM professor WHERE employee_id = '$person'";
    $res2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_assoc($res2);
    $greet = $row2['first_name'];
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
                                        CS Department
                                    </h2>
                                    <div class="art-PostContent">
                                        <p>The computer science department in the University of Virginia offers quality programs that emphasizes basic science, technical mastery, research opportunities and a firm grasp of scientific principles as well as strong communication skills and creative problem solving.</p>

                                        <p>The department offers a Bachelor of Science in Computer Science, a Bachelor of Science in Computer Engineering (in collaboration with the U.Va. Charles L. Brown Department of Electrical and Computer Engineering), a Bachelor of Arts in Computer Science (in collaboration with U.Va.’s College of Arts & Sciences), a Master of Computer Science, a Master of Science and a Ph.D. in Computer Science. The department also offers a Computer Science Minor for Undergraduates.</p>

                                        <p>The difference between the bachelor of science in computer science degree offered through the School of Engineering and Applied Sciences and the interdisciplinary major in computer science degree offered through the College is in general requirements, course sequence, required courses, electives and the thesis requirement. See differences between CS degrees for further information</p>

                                        <p>The department has a commitment to excellence in instruction, with a world-class undergraduate curriculum that has been adopted by many departments in the U.S. and a student/faculty ratio that facilitates mentorship, individual attention and research collaborations.</p>
                                        
                                        <p>Registration for computer science courses is done on a class by class basis. The intention of this registration policy is to ensure that students who are required to take a particular course have first access to class seats. Prudent students will register for computer science classes as soon as they are able to do so. Electronic waiting lists are being kept for computer science courses.<p>

                                            <p>The prerequisite structure is being strictly enforced. A detailed description of this policy is available. The enforcement of the prerequisites ensures that all class seats go to worthy students.</p>

                                            <p>The CS department is located in Rice Hall.</p>
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
                                        <?php

                                        if(isset($_SESSION['login_user']) AND $_SESSION['user_role'] == "student") {
                                        echo '<div class="art-header-tag-icon">';
                                        echo '<div class="t">Welcome back!</div></div>';
                                        echo '</div><div class="art-BlockContent">';
                                        echo '<div class="art-BlockContent-body">';
                                        echo '<div align="center">Hello there, ';
                                        echo $greet;
                                        echo '.<br><br><a href="schedule.php">My Schedule</a>';
                                        echo '<br><a href="history.php">Course History</a>';
                                        echo '<br><a href="checklist.php">Course Checklist</a>';
                                        echo '<br><a href="settings.php">Settings</a>';
                                        echo '<br><a href="logout.php">Log Out</a>';
                                    }
                                    else if(isset($_SESSION['login_user']) AND $_SESSION['user_role'] == "instructor") {
                                        echo '<div class="art-header-tag-icon">';
                                        echo '<div class="t">Welcome back!</div></div>';
                                        echo '</div><div class="art-BlockContent">';
                                        echo '<div class="art-BlockContent-body">';
                                        echo '<div align="center">Hello there, ';
                                        echo $greet;
                                        echo '<br><br><a href="managestudents.php">Manage Students</a>';
                                        echo '<br><a href="instrsettings.php">Settings</a>';
                                        echo '<br><a href="logout.php">Log Out</a>';
                                    }
                                        else {
                                            echo '<div class="art-header-tag-icon">';
                                            echo '<div class="t">Login</div></div>';
                                            echo '</div><div class="art-BlockContent">';
                                            echo '<div class="art-BlockContent-body">';
                                            echo '<form class="loginform" method="post" action=""><table><tr>';
                                            echo '<td><label>Username</label></td>';
                                            echo '<td><input type="text" name="username" placeholder="ex. mst3k"></td></tr>';
                                            echo '<tr><td><label>Password</label></td>';
                                            echo '<td><input type="password" name="pass"></td></tr></table>';
                                            echo '<div align="center"><p><span class="error">';
                                            echo $error;
                                            echo '</span></p>';
                                            echo '<span class="art-button-wrapper">';
                                            echo '<span class="l"> </span>';
                                            echo '<span class="r"> </span>';
                                            echo '<input class="art-button" type="submit" name="login" value="Login" /></span></form>';
                                            echo '<p><div class="art-Footer-text"><a href="/~ydc5yf/register.php">Register</a> | <a href="/~ydc5yf/reset.php">Reset Password</a></div>';
                                        }
                                        ?>
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

</body>
</html>