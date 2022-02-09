<?php

if (isset($_POST['menu'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $res_id = mysqli_real_escape_string($conn, $_POST['res_id']);

    //insert menu
    foreach ($_POST['menu'] as $key => $value) {
        //upload menu image
        $fileName = $_FILES['menu']['name'][$key]['image'];
        $tempName = $_FILES['menu']['tmp_name'][$key]['image'];

        $ext = strrchr($fileName, '.'); //ตัดสตริงเอา.สกุลไฟล์
        $image = uniqid() . $ext; //ตั้งชื่อไฟล์ใหม่
        $upload_path = "../images/menus/$image";
        move_uploaded_file($tempName, $upload_path); //อัพโหลดไฟล์

        //sql insert
        $sql = "INSERT INTO menus (mn_name,mn_description,mn_image,mn_price,res_id)
        VALUES ('$value[name]','$value[description]','$image','$value[price]','$res_id')";
        mysqli_query($conn, $sql);
    }

    echo "<script>
        alert('สำเร็จ');
        window.location = '../admin/restaurant.php'
    </script>";
}
