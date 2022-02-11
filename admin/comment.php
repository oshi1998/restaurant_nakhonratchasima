<?php
require_once("../services/check_admin.php");
?>

<?php
//select ข้อมูลความคิดเห็นที่มีความเสี่ยง
$sql = "SELECT * FROM comments,users
WHERE cm_text LIKE '%สัส%' 
OR cm_text LIKE '%สาส%' 
OR cm_text LIKE '%ควย%' 
OR cm_text LIKE '%ควาย%'
OR cm_text LIKE '%เหี้ย%'
OR cm_text LIKE '%ห่า%'
HAVING comments.user_id=users.user_id";
$risk_comments_query = mysqli_query($conn, $sql);
?>

<?php
//select ข้อมูลความคิดเห็นที่ถูกรายงาน
$sql = "SELECT * FROM comments,users WHERE comments.user_id=users.user_id AND cm_report=1";
$report_comments_query = mysqli_query($conn, $sql);
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
                <li class="active">จัดการข้อมูลความคิดเห็น</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    ตารางข้อมูลความคิดเห็น
                </h1>
            </div>
        </div>
        <!--/.row-->

        <div class="panel panel-container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-body">
                        <div class="panel-body tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">ความคิดเห็นที่มีความเสี่ยง</a></li>
                                <li><a href="#tab2" data-toggle="tab">ความคิดเห็นที่ถูกรายงาน</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">
                                    <h4 class="text-danger">*ระบบแสดงเฉพาะความคิดเห็นที่มีข้อความ เสี่ยงผิดกฎของเว็บไซต์เท่านั้น</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ผู้แสดงความคิดเห็น</th>
                                                    <th>ข้อความ</th>
                                                    <th>แสดงความคิดเห็นเมื่อ</th>
                                                    <th>ลบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($risk_comments_query as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['user_firstname'] . " " . $row['user_lastname'] ?></td>
                                                        <td><?= $row['cm_text'] ?></td>
                                                        <td><?= $row['cm_datetime'] ?></td>
                                                        <td><a href="../services/comment_delete.php?id=<?= $row['cm_id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <h4 class="text-danger">*ระบบแสดงเฉพาะความคิดเห็นที่ถูกรายงานเท่านั้น</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ผู้แสดงความคิดเห็น</th>
                                                    <th>ข้อความ</th>
                                                    <th>แสดงความคิดเห็นเมื่อ</th>
                                                    <th>สาเหตุ</th>
                                                    <th>ลบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($report_comments_query as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['user_firstname'] . " " . $row['user_lastname'] ?></td>
                                                        <td><?= $row['cm_text'] ?></td>
                                                        <td><?= $row['cm_datetime'] ?></td>
                                                        <td><?= $row['cm_report_reason'] ?></td>
                                                        <td><a href="../services/comment_delete.php?id=<?= $row['cm_id'] ?>" onclick="return confirm('ยืนยันการลบ?')">ลบ</a></td>
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