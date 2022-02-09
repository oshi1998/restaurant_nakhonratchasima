<?php

if (isset($_GET['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก get
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //select ภาพร้านอาหารเพื่อลบ
    $sql = "SELECT res_image FROM restaurants WHERE res_id='$id'";
    $query = mysqli_query($conn,$sql);
    $resObj = mysqli_fetch_object($query);
    $image = $resObj->res_image;

    $delete_path = "../images/restaurants/$image";

    if (file_exists($delete_path)) {
        //เช็คว่ามีไฟล์ที่จะลบอยู่หรือไม่
        unlink($delete_path);
    }

    //delete menu
    $sql = "DELETE FROM menus WHERE res_id='$id'";
    mysqli_query($conn,$sql);

    //delete res
    $sql = "DELETE FROM restaurants WHERE res_id='$id'";
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
