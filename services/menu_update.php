<?php

if (isset($_POST['menu'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //update menu
    foreach ($_POST['menu'] as $key => $value) {

        //upload menu image
        $fileName = $_FILES['menu']['name'][$key]['image'];
        $tempName = $_FILES['menu']['tmp_name'][$key]['image'];

        if (!empty($fileName)) {

            $delete_path = "../images/menus/$value[old_image]";

            if (file_exists($delete_path)) {
                unlink($delete_path);
            }

            $ext = strrchr($fileName, '.'); //ตัดสตริงเอา.สกุลไฟล์
            $image = uniqid() . $ext; //ตั้งชื่อไฟล์ใหม่
            $upload_path = "../images/menus/$image";
            move_uploaded_file($tempName, $upload_path); //อัพโหลดไฟล์
        } else {
            $image = $value['old_image'];
        }

        //sql update
        $sql = "UPDATE menus SET mn_name='$value[name]',mn_description='$value[description]',mn_image='$image',mn_price='$value[price]' WHERE mn_id='$key'";
        mysqli_query($conn, $sql);
    }

    echo "<script>
        alert('สำเร็จ');
        window.history.back()
    </script>";
}
