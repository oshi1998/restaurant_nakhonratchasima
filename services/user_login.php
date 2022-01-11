<?php

if (isset($_POST["username"])) {
    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    //login
    $sql = "SELECT * FROM users WHERE user_username='$username' AND user_password='$password'";
    $query = mysqli_query($conn,$sql);
    $userObj = mysqli_fetch_object($query);
    
    if(!empty($userObj)){
        
        session_start();
        $_SESSION["AUTH_ID"] = $userObj->user_id;
        
        if($userObj->user_role==0){
            header("location:../admin/home.php");
        }else{
            header("location:../home.php");
        }

    }else{
        echo "<script>
            alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง');
            window.history.back()
        </script>";
    }
}
