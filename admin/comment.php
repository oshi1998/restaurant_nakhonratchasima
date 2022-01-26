<?php
require_once("../services/check_admin.php");
?>

<?php
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
                                                    <th>ผู้รายงาน</th>
                                                    <th>รายงานเมื่อ</th>
                                                    <th>ลบ</th>
                                                </tr>
                                            </thead>
                                            <tbody>

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