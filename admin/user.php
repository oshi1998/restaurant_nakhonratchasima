<?php
require_once("../services/check_admin.php");
?>

<?php
//select ข้อมูลผู้ใช้งาน แอดมิน
$sql = "SELECT * FROM users WHERE user_role='0' ORDER BY user_id DESC";
$user0_query = mysqli_query($conn, $sql);
$no = 1;

//select ข้อมูลผู้ใช้งาน สมาชิก
$sql = "SELECT * FROM users WHERE user_role='1' ORDER BY user_id DESC";
$user1_query = mysqli_query($conn, $sql);
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
                <li class="active">จัดการข้อมูลผู้ใช้งาน</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    ตารางข้อมูลผู้ใช้งาน
                </h1>
            </div>
        </div>
        <!--/.row-->

        <div class="panel panel-container">
            <p style="padding: 10px;">
                <a href="user_add.php">
                    <i class="fa fa-plus"></i>
                    <span>เพิ่มข้อมูล</span>
                </a>
            </p>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-body">
                        <div class="panel-body tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">แอดมิน</a></li>
                                <li><a href="#tab2" data-toggle="tab">สมาชิกทั่วไป</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">
                                    <h4>แอดมิน</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อผู้ใช้งาน</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>อีเมล</th>
                                                    <th>แก้ไข</th>
                                                    <th>ลบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($user0_query as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['user_username'] ?></td>
                                                        <td><?= $row['user_firstname'] . " " . $row['user_lastname'] ?></td>
                                                        <td><?= $row['user_email'] ?></td>
                                                        <td>
                                                            <a href="user_edit.php?id=<?= $row['user_id'] ?>">แก้ไข</a>
                                                        </td>
                                                        <td>
                                                            <?php if ($userObj->user_id == $row['user_id']) : ?>
                                                                <strong class="text-danger">ไม่สามารถลบข้อมูลตัวเองได้</strong>
                                                            <?php else : ?>
                                                                <a href="../services/user_delete.php?id=<?= $row['user_id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <h4>สมาชิกทั่วไป</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อผู้ใช้งาน</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>อีเมล</th>
                                                    <th>แก้ไข</th>
                                                    <th>ลบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($user1_query as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['user_username'] ?></td>
                                                        <td><?= $row['user_firstname'] . " " . $row['user_lastname'] ?></td>
                                                        <td><?= $row['user_email'] ?></td>
                                                        <td>
                                                            <a href="user_edit.php?id=<?= $row['user_id'] ?>">แก้ไข</a>
                                                        </td>
                                                        <td>
                                                            <?php if ($userObj->user_id == $row['user_id']) : ?>
                                                                <strong class="text-danger">ไม่สามารถลบข้อมูลตัวเองได้</strong>
                                                            <?php else : ?>
                                                                <a href="../services/user_delete.php?id=<?= $row['user_id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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