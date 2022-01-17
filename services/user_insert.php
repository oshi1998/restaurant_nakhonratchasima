<?php

if (isset($_POST['username'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    //ตรวจสอบชื่อผู้ใช้งาน
    $sql = "SELECT * FROM users WHERE user_username='$username'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 1) {
        echo "<script>
            alert('ชื่อผู้ใช้งาน $username ถูกใช้งานแล้ว');
            window.history.back()
        </script>";
    } else {
        //insert
        $sql = "INSERT INTO users (user_username,user_firstname,user_lastname,user_email,user_role,user_password)
        VALUES ('$username','$firstname','$lastname','$email','$role','$password')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>
            alert('สำเร็จ');
            window.location = '../admin/user.php'
        </script>";
        } else {
            echo "<script>
            alert('ไม่สำเร็จ');
            window.history.back()
        </script>";
        }
    }
}
