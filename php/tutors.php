<?php

    session_start();

    include_once("db_connect.php");

    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please login');</script>";
        echo "<script> window.location.replace('../index.php')</script>";
    } else {
        $email = $_SESSION['email'];
    }

    // Retrieve subjects
    $sql_tutors = "SELECT * FROM tbl_tutors";

    // Pagination
    $results_per_page = 10;

    if (isset($_GET['page_no'])) {
        $page_no = (int)$_GET['page_no'];
        $page_first_result = ($page_no - 1) * $results_per_page;
    } else {
        $page_no = 1;
        $page_first_result = 0;
    }

    $stmt_tutors = $conn -> prepare($sql_tutors);
    $stmt_tutors -> execute();

    $number_of_result = $stmt_tutors -> rowCount();
    $number_of_page = ceil($number_of_result / $results_per_page); // round off

    $sql_tutors = $sql_tutors . " LIMIT $page_first_result, $results_per_page";

    $stmt = $conn -> prepare($sql_tutors);
    $stmt -> execute();
    $result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt -> fetchAll();

    $conn = null; // close connection

    function truncate($string, $length, $dots = "...") {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
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
    <title>Tutors | MyTutor</title>
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
                    <?php echo "Welcome, <b>$email</b>!"; ?>
                </div>
            </header>
        </div>
        <div class="w3-container w3-padding-32" style="margin: 0 auto; padding-left: 64px; padding-right: 64px; word-wrap: keep-all">
            <h2>Tutors</h2>
            <div class="w3-grid-template" style='overflow-x: auto;'>
                <table class="w3-padding">
                <?php
                    $i = 0;

                    foreach ($rows as $tutors) {
                        $i++;

                        $tut_id = $tutors['tutor_id'];
                        $tut_email = truncate($tutors['tutor_email'], 15);
                        $tut_phone = $tutors['tutor_phone'];
                        $tut_name = truncate($tutors['tutor_name'], 15);
                        $tut_desc = $tutors['tutor_description'];
                        $tut_datereg = $tutors['tutor_datereg'];

                        echo 
                        "<a style='text-decoration: none' href='tutor_details.php?tid=$tut_id'><div class='w3-card-4 w3-round' style='margin: 6px'>
                            <header class='w3-container w3-cyan w3-padding w3-center'>
                                <b>$tut_name</b>
                            </header>
                            <p><img class='w3-image' src=../assets/tutors/$tut_id.jpg" .
                            " onerror=this.onerror=null;this.src='../img/user_profile.png' style='border-radius: 15px; height: 150px; display: block; margin: auto'></p>
                            <hr />
                            <div class='w3-container w3-center'>
                                <b>E-mail:</b> $tut_email<br />
                                <b>Phone:</b> $tut_phone<br />
                            </div>
                            <br />
                        </div></a>";
                    }
                ?>
                </table>
            </div>
        </div>
        <?php
            $num = 1;
            if ($page_no == 1) {
                $num = 1;
            } else if ($page_no == 2) {
                $num = ($num) + 10;
            } else {
                $num = $page_no * 10 - 9;
            }

            echo "<div class='w3-container w3-row'>";
            echo "<center>Page:";
            for ($page = 1; $page <= $number_of_page; $page++) {
                if($page == $page_no)
                {
                    echo '<a href = "?page_no=' . $page . '" style= "text-decoration: none; color: #18BFE6"><b>&nbsp&nbsp' . $page . ' </b></a>';
                } else {
                    echo '<a href = "?page_no=' . $page . '" style= "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
                }
            }
            echo "</center></div>";
        ?>
    </div>
    <br />
    <footer class="footer w3-center w3-padding" style="position: relative">&copy; MyTutor 2022</footer>
</body>
</html>
