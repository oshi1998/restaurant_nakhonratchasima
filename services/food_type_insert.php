<?php

if (isset($_POST['name'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    //insert
    $sql = "INSERT INTO food_types (ft_name) VALUES ('$name')";
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
