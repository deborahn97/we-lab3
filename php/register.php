<?php

    if(isset($_POST['register'])) {
        include_once("db_connect.php");

        $email = addslashes($_POST['email']);
        $name = addslashes($_POST['name']);
        $phone = addslashes($_POST['phone']);
        $password = sha1(($_POST['password']));
        $home_address = addslashes($_POST['home_address']);
        $status = "Unverified";

        $sql_insert = "INSERT INTO tbl_users(user_email, user_name, user_phone, user_password, user_home_address, user_status) VALUES ('$email', '$name', '$phone', '$password', '$home_address', '$status')";

        try {
            $conn -> exec($sql_insert);

            if (file_exists($_FILES["image"]["tmp_name"]) || is_uploaded_file ($_FILES["image"]["tmp_name"])) {
                $last_id = $conn -> lastInsertId();
                upload_img($last_id);
                echo "<script>alert('Registration successful. You may now login.')</script>";
                echo "<script>window.location.replace('../index.php')</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Registration failed. Please try again.')</script>";
            echo "<script>window.location.replace('../index.php')</script>";

        }
    }

    function upload_img($filename)
    {
        $target_dir = "../img/user/";
        $target_file = $target_dir . $filename . ".png";
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

?>
