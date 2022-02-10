<?php

if (isset($_POST['text'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $res_id = mysqli_real_escape_string($conn, $_POST["res_id"]);
    $text = mysqli_real_escape_string($conn, $_POST["text"]);

    //รับค่าจาก session
    session_start();
    $user_id = mysqli_real_escape_string($conn, $_SESSION["AUTH_MEMBER_ID"]);

    //insert
    $sql = "INSERT INTO comments (cm_text,res_id,user_id) VALUES ('$text','$res_id','$user_id')";
    $query = mysqli_query($conn, $sql);

    echo "<script>window.history.back()</script>";
}
