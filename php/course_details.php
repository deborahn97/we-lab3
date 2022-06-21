<?php

    session_start();

    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please login');</script>";
        echo "<script> window.location.replace('../index.php')</script>";
    } else {
        $email = $_SESSION['email'];
    }

    include_once("db_connect.php");

    if(isset($_GET['cid'])) {
        $cid = $_GET['cid'];
        $sql_subject = "SELECT s.*, t.tutor_id, t.tutor_name FROM tbl_subjects s, tbl_tutors t WHERE subject_id = '$cid' AND s.tutor_id = t.tutor_id";
        $stmt_subject = $conn -> prepare($sql_subject);
        $stmt_subject -> execute();
        $number_of_result = $stmt_subject -> rowCount();

        if($number_of_result > 0) {
            $result = $stmt_subject -> setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt_subject -> fetchAll();
        } else {
            echo "<script>alert('Product Not Found');</script>";
            echo "<script>window.location.replace('courses.php');</script>";
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
    <title>Course Details | MyTutor</title>
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
                    <a href="courses.php" class="w3-bar-item w3-button w3-right">Back</a>
                </div><br />
            </header>
        </div>
        <div class="w3-container w3-padding-32" style="margin: 0 auto; padding-left: 64px; padding-right: 64px; word-wrap: keep-all">
            <h3>About Course</h3>
            <?php
            foreach ($rows as $subject) {
                $sub_id = $subject['subject_id'];
                $sub_name = $subject['subject_name'];
                $sub_desc = $subject['subject_description'];
                $sub_price = number_format((float)$subject['subject_price'], 2, '.', '');
                $sub_tutor = $subject['tutor_name'];
                $sub_sessions = $subject['subject_sessions'];
                $sub_rating = $subject['subject_rating'];

                echo 
                "<div class='w3-container w3-padding'>
                    <img class='w3-card w3-image' src=../assets/courses/$sub_id.png" . " onerror=this.onerror=null;this.src='../img/user_profile.png' style='border-radius: 15px; height: 250px; display: block; margin: auto' />
                    <br />
                </div>
                <div class='w3-container w3-padding'>
                    <div>
                        <h4><b>$sub_name</b></h4>
                    </div><hr />
                    <table class='w3-table w3-striped w3-white w3-card'>
                        <tr>
                            <th class='w3-cyan'>Description</th>
                            <td>$sub_desc</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Price</th>
                            <td>RM$sub_price</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Tutor</th>
                            <td>$sub_tutor</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Sessions</th>
                            <td>$sub_sessions</td>
                        </tr>
                        <tr>
                            <th class='w3-cyan'>Rating</th>
                            <td>$sub_rating / 5</td>
                        </tr>
                    </table>
                    <div>
                        <br /><input type='hidden' name='cid' />
                        <br /><input class='w3-button w3-cyan w3-round w3-center' type='submit' name='submit' value='Enroll Course' />
                    </div>
                </div>";
            }
        ?>
        </div>
    </div>
    <footer class="footer w3-center w3-padding" style="position: relative">&copy; MyTutor 2022</footer>
</body>
</html>
