<?php

if (isset($_POST['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $office_time = mysqli_real_escape_string($conn, $_POST['office_time']);
    $full_desc = mysqli_real_escape_string($conn, $_POST['full_desc']);
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);

    //รับค่าตัวแปรจาก FILES
    $fileName = $_FILES["image"]["name"];
    $tempName = $_FILES["image"]["tmp_name"];

    //เช็คว่ามีการอัพไฟล์ภาพเข้ามาหรือไม่
    if (!empty($fileName)) {

        $delete_path = "../images/restaurants/$old_image";

        if (file_exists($delete_path)) {
            //เช็คว่ามีไฟล์ที่จะลบอยู่หรือไม่
            unlink($delete_path);
        }

        $ext = strrchr($fileName, '.'); //ตัดสตริงเอา.สกุลไฟล์
        $image = uniqid() . $ext; //ตั้งชื่อไฟล์ใหม่
        $upload_path = "../images/restaurants/$image";
        move_uploaded_file($tempName, $upload_path); //อัพโหลดไฟล์
    } else {
        $image = $old_image;
    }

    //update
    $sql = "UPDATE restaurants SET res_name='$name',res_short_desc='$short_desc',res_full_desc='$full_desc',
    res_url='$url',res_office_time='$office_time',res_image='$image' WHERE res_id='$id'";
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
