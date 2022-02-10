<?php

if (isset($_POST['reason'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $cm_id = mysqli_real_escape_string($conn, $_POST["cm_id"]);
    $reason = mysqli_real_escape_string($conn, $_POST["reason"]);

    //ตัวแปร
    $report = 1;

    //update
    $sql = "UPDATE comments SET cm_report='$report',cm_report_reason='$reason' WHERE cm_id='$cm_id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>
            alert('เราได้รับการรายงานของคุณแล้ว จะทำการตรวจสอบโดยเร็วที่สุด');
            window.history.back()
        </script>";
    } else {
        echo "<script>
            alert('รายงานความคิดเห็นไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
            window.history.back()
        </script>";
    }
}
