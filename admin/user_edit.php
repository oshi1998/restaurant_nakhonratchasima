<?php
require_once("../services/check_admin.php");
?>

<?php
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    
    $sql = "SELECT * FROM users WHERE user_id='$id'";
    $query = mysqli_query($conn,$sql);
    $dataObj = mysqli_fetch_object($query);
}else{
    echo "<script>window.history.back()</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจัดการสวนน้ำมารีน่า</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <!-- start include navbar -->
    <?php include("layouts/navbar.php"); ?>
    <!-- end include navbar -->

    <!-- start include sidebar -->
    <?php include("layouts/sidebar.php"); ?>
    <!-- end include sidebar -->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="home.php">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li><a href="user.php">จัดการข้อมูลผู้ใช้งาน</a></li>
                <li class="active">แก้ไขข้อมูล</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    แก้ไขข้อมูลผู้ใช้งาน
                </h1>
            </div>
        </div>
        <!--/.row-->

        <div class="panel panel-container">
            <p style="padding: 10px;">
                <a href="#" onclick="window.history.back()">
                    <i class="fa fa-arrow-left"></i>
                    <span>ย้อนกลับ</span>
                </a>
            </p>

            <div class="row">
                <div class="col-sm-6 col-lg-12">
                    <div class="panel-body">
                        <form action="../services/user_update.php" method="post">
                            <input name="id" value="<?= $id ?>" readonly hidden>
                            <div class="form-group">
                                <label>ชื่อจริง</label>
                                <input type="text" class="form-control" name="firstname" value="<?= $dataObj->user_firstname ?>" required>
                            </div>
                            <div class="form-group">
                                <label>ชื่อจริง</label>
                                <input type="text" class="form-control" name="lastname" value="<?= $dataObj->user_lastname ?>" required>
                            </div>
                            <div class="form-group">
                                <label>อีเมล</label>
                                <input type="email" class="form-control" name="email" value="<?= $dataObj->user_email ?>">
                            </div>
                            <div class="form-group">
                                <label>ตำแหน่ง</label>
                                <select class="form-control" name="role">
                                    <option value="0" <?= ($dataObj->user_role==0) ? "selected" : "" ?>>แอดมิน</option>
                                    <option value="1" <?= ($dataObj->user_role==1) ? "selected" : "" ?>>สมาชิกทั่วไป</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password" value="<?= $dataObj->user_password ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.main-->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>