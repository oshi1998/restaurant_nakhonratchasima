<?php

if(isset($_POST['res_id'])){

    //header content
    header("Content-type:application/json");

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $res_id = mysqli_real_escape_string($conn,$_POST['res_id']);

    //รับค่าจาก session
    session_start();
    $user_id = mysqli_real_escape_string($conn,$_SESSION['AUTH_MEMBER_ID']);

    //insert
    $sql = "INSERT INTO favourites (res_id,user_id) VALUES ('$res_id','$user_id')";
    $query = mysqli_query($conn,$sql);

    if($query){
        $fav_id = $conn->insert_id;
        
        http_response_code(200);
        echo json_encode(["msg"=>"เพิ่มรายการโปรดสำเร็จ","fav_id"=>$fav_id]);
        exit;
    }else{
        http_response_code(500);
        echo json_encode(["msg"=>"เพิ่มรายการโปรดไม่สำเร็จ ลองใหม่อีกครั้ง"]);
        exit;
    }
}