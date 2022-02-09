<?php

if (isset($_POST['fav_id'])) {

    //header content
    header("Content-type:application/json");

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $fav_id = mysqli_real_escape_string($conn, $_POST['fav_id']);

    //delete
    $sql = "DELETE FROM favourites WHERE fav_id='$fav_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        http_response_code(200);
        echo json_encode(["msg" => "ลบรายการโปรดสำเร็จ"]);
        exit;
    } else {
        http_response_code(500);
        echo json_encode(["msg" => "ลบรายการโปรดไม่สำเร็จ ลองใหม่อีกครั้ง"]);
        exit;
    }
}
