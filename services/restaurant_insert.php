<?php

if (isset($_POST['name'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $office_time = mysqli_real_escape_string($conn, $_POST['office_time']);
    $full_desc = mysqli_real_escape_string($conn, $_POST['full_desc']);

    //รับค่าตัวแปรจาก FILES
    $fileName = $_FILES["image"]["name"];
    $tempName = $_FILES["image"]["tmp_name"];

    //เช็คว่ามีการอัพไฟล์ภาพเข้ามาหรือไม่
    if (!empty($fileName)) {
        $ext = strrchr($fileName, '.'); //ตัดสตริงเอา.สกุลไฟล์
        $image = uniqid() . $ext; //ตั้งชื่อไฟล์ใหม่
        $upload_path = "../images/restaurants/$image";
        move_uploaded_file($tempName, $upload_path); //อัพโหลดไฟล์
    } else {
        echo "<script>
            alert('กรุณาอัพโหลดรูปภาพ');
            window.history.back()
        </script>";
    }

    //insert
    $sql = "INSERT INTO restaurants (res_name,res_short_desc,res_full_desc,res_url,res_office_time,res_image)
    VALUES ('$name','$short_desc','$full_desc','$url','$office_time','$image')";
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
