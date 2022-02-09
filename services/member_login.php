<?php

if (isset($_POST["username"])) {
    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    //login
    $sql = "SELECT * FROM users WHERE user_username='$username' AND user_password='$password' AND user_role='1'";
    $query = mysqli_query($conn, $sql);
    $userObj = mysqli_fetch_object($query);

    if (!empty($userObj)) {

        session_start();
        $_SESSION["AUTH_MEMBER_ID"] = $userObj->user_id;
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>
            alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง');
            window.history.back()
        </script>";
    }
}
