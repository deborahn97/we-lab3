<?php

    if(isset($_POST['login'])) {
        include_once("db_connect.php");

        $email = addslashes($_POST['email']);
        $password = sha1(($_POST['password']));

        $sql_login = "SELECT * FROM tbl_users WHERE user_email = '$email' AND user_password = '$password'";

        $stmt = $conn -> prepare($sql_login);
        $stmt -> execute();

        $num_of_rows = $stmt -> fetchColumn();

        if($num_of_rows > 0) {
            session_start();
            $_SESSION["sessionid"] = session_id();
            $_SESSION['email'] = $email;
            
            echo "<script>alert('Login Success');</script>";
            echo "<script>window.location.replace('courses.php');</script>";
        } else {
            echo "<script>alert('Login Failed');</script>";
            echo "<script>window.location.replace('../index.php');</script>";
        }
    }

?>
