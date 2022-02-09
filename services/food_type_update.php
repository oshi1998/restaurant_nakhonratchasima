<?php

if (isset($_POST['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    //update
    $sql = "UPDATE food_types SET ft_name='$name' WHERE ft_id='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('สำเร็จ');
            window.location = '../admin/food_type.php'
        </script>";
    } else {
        echo "<script>
            alert('ไม่สำเร็จ');
            window.history.back()
        </script>";
    }
}
