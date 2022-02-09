<?php

if (isset($_GET['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก get
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //delete
    $sql = "DELETE FROM food_types WHERE ft_id='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('สำเร็จ');
            window.location = '../admin/food_type.php'
        </script>";
    } else {
        echo "<script>
            alert('ไม่สำเร็จ เนื่องจากข้อมูลประเภทอาหารถูกใช้งาน');
            window.history.back()
        </script>";
    }
}
