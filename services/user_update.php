<?php

if (isset($_POST['id'])) {

    //include ไฟล์เชื่อมฐานข้อมูล
    require_once("connect.php");

    //รับค่าจาก post
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    //insert
    $sql = "UPDATE users SET user_firstname='$firstname',user_lastname='$lastname',
    user_email='$email',user_role='$role',user_password='$password' WHERE user_id='$id'";
    $query = mysqli_query($conn,$sql);

    if($query){
        echo "<script>
            alert('สำเร็จ');
            window.location = '../admin/user.php'
        </script>";
    }else{
        echo "<script>
            alert('ไม่สำเร็จ');
            window.history.back()
        </script>";
    }
}
