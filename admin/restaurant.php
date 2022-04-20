<?php
require_once("../services/check_admin.php");
?>

<?php
//select ข้อมูลร้านอาหาร
$sql = "SELECT * FROM restaurants,food_types WHERE restaurants.ft_id=food_types.ft_id ORDER BY res_id DESC";
$query = mysqli_query($conn, $sql);
$no = 1;
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
                <li class="active">จัดการข้อมูลร้านอาหาร</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    ตารางข้อมูลร้านอาหาร
                </h1>
            </div>
        </div>
        <!--/.row-->

        <div class="panel panel-container">
            <p style="padding: 10px;">
                <a href="restaurant_add.php">
                    <i class="fa fa-plus"></i>
                    <span>เพิ่มข้อมูล</span>
                </a>
            </p>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รูปภาพ</th>
                                        <th>ชื่อร้านอาหาร</th>
                                        <th>ประเภทอาหาร</th>
                                        <th>สถานะ</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <img class="img-responsive" src="../images/restaurants/<?= $row['res_image'] ?>" width="100">
                                            </td>
                                            <td><?= $row['res_name'] ?></td>
                                            <td><?= $row['ft_name'] ?></td>
                                            <td>
                                                <?php if ($row['res_status'] == 0) : ?>
                                                    <span class="badge bg-danger">ไม่เผยแพร่</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success">เผยแพร่</span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <a href="restaurant_edit.php?id=<?= $row['res_id'] ?>">แก้ไข</a>
                                            </td>
                                            <td>
                                                <a href="../services/restaurant_delete.php?id=<?= $row['res_id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
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