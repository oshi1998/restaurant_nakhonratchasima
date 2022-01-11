<?php

session_start();

if(isset($_SESSION["AUTH_ID"])){

    require_once("connect.php");
    
    $user_id = $_SESSION["AUTH_ID"];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $query = mysqli_query($conn,$sql);
    $userObj = mysqli_fetch_object($query);

    if($userObj->user_role!=0){
        echo "<script>
            alert('คุณไม่มีสิทธิ์การเข้าถึงหน้าเว็บนี้');
            window.history.back()
        </script>";        
    }
}else{
    header("location:../admin/login.php");
}