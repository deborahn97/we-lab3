<?php

    session_start();

    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please login');</script>";
        echo "<script> window.location.replace('../index.php')</script>";
    } else {
        $email = $_SESSION['email'];
    }

    include_once("db_connect.php");

    if(isset($_GET['tid'])) {
        $tid = $_GET['tid'];
        $sql_tutor = "SELECT * FROM tbl_tutors WHERE tutor_id = '$tid'";
        $stmt_tutor = $conn -> prepare($sql_tutor);
        $stmt_tutor -> execute();
        $number_of_result = $stmt_tutor -> rowCount();

        if($number_of_result > 0) {
            $result = $stmt_tutor -> setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt_tutor -> fetchAll();
        } else {
            echo "<script>alert('Product Not Found');</script>";
            echo "<script>window.location.replace('tutors.php');</script>";
        }
    } else {
        echo "<script>alert('Page Error');</script>";
        echo "<script>window.location.replace('../index.php');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/classroom.ico" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <script>
        // Sidebar
        function open_sb() {
            document.getElementById("main").style.marginLeft = "25%";
            document.getElementById("sidebar").style.width = "25%";
            document.getElementById("sidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }
        function close_sb() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("sidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }
    </script>
    <title>Tutor Details | MyTutor</title>
</head>
<body style="background: #E9FFFF">
    <!-- Sidebar Menu -->
    <div class="w3-sidebar w3-bar-block w3-card-4 w3-animate-left" style="display:none" id="sidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="close_sb()"><b>Close &times;</b></button><hr />
        <a href="courses.php" class="w3-bar-item w3-button"><i class="fa fa-book"></i> Courses</a>
        <a href="tutors.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i> Tutors</a>
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-credit-card"></i> Subscriptions</a>
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button" onclick="return confirm('Are you sure?')"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <div id="main">
        <div>
            <header class="header w3-card w3-center w3-padding-32">
            <button id="openNav" class="w3-button w3-xlarge w3-left" onclick="open_sb()">&#9776;</button>
                <div style="font-size: 225%; font-weight: bold"><i class="fa fa-graduation-cap"></i> MyTutor</div><br /><br />
                <div class="w3-bar w3-right" style="margin-right: 20px">
                    <a onclick="history.go(-1);" class="w3-bar-item w3-button w3-right">Back</a>
                </div><br />
            </header>
        </div>
        <div class="w3-container w3-padding-32" style="margin: 0 auto; padding-left: 64px; padding-right: 64px; word-wrap: keep-all">
            <h3>About Tutor</h3>
            <?php
            foreach ($rows as $tutor) {
                $tut_id = $tutor['tutor_id'];
                $tut_email = $tutor['tutor_email'];
                $tut_phone = $tutor['tutor_phone'];
                $tut_name = $tutor['tutor_name'];
                $tut_desc = $tutor['tutor_description'];
                $tut_datereg = date_format(new DateTime($tutor['tutor_datereg']), 'd M Y H:i:s');

                echo 
                "<div class='w3-container w3-padding'>
                    <img class='w3-card w3-image' src=../assets/tutors/$tut_id.jpg" . " onerror=this.onerror=null;this.src='../img/user_profile.png' style='border-radius: 15px; height: 250px; display: block; margin: auto' />
                    <br />
                </div>
                <div class='w3-container w3-padding'>
                    <div>
                        <h4><b>$tut_name</b></h4>
                    </div><hr />
                    <table class='w3-table w3-striped w3-white w3-card'>
                        <tr>
                            <th class='w3-cyan'>Email</th>
                            <td>$tut_email</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Phone</th>
                            <td>$tut_phone</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Description</th>
                            <td>$tut_desc</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Date Registered</th>
                            <td>$tut_datereg</td>
                        </tr>
                    </table>
                    <div>
                        <br /><input type='hidden' name='cid' />
                        <br /><input class='w3-button w3-cyan w3-round w3-center' type='submit' name='submit' value='Contact Tutor' />
                    </div>
                </div>";
            }
        ?>
        </div>
    </div>
    <footer class="footer w3-center w3-padding" style="position: relative">&copy; MyTutor 2022</footer>
</body>
</html>
