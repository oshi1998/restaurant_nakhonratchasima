<?php

if (isset($_GET['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่า get
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //delete
    $sql = "DELETE FROM menus WHERE mn_id='$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('สำเร็จ');
            window.history.back()
        </script>";
    } else {
        echo "<script>
            alert('ไม่สำเร็จ');
            window.history.back()
        </script>";
    }
}
