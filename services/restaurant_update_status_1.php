<?php

if (isset($_GET['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก get
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = 1;

    //อัพเดตสถานะร้านอาหาร
    $sql = "UPDATE restaurants SET res_status='$status' WHERE res_id='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('สำเร็จ');
            window.location = '../admin/restaurant.php'
        </script>";
    } else {
        echo "<script>
            alert('ไม่สำเร็จ');
            window.history.back()
        </script>";
    }
}
