<?php
require_once("../services/check_admin.php");
?>

<?php
//select ข้อมูลประเภทอาหาร
$sql = "SELECT * FROM food_types";
$food_types_query = mysqli_query($conn, $sql);
?>


<?php
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM restaurants,food_types WHERE restaurants.ft_id=food_types.ft_id AND res_id='$id'";
    $query = mysqli_query($conn, $sql);
    $dataObj = mysqli_fetch_object($query);

    $sql = "SELECT * FROM menus WHERE res_id='$id'";
    $menus_query = mysqli_query($conn, $sql);
} else {
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
                <li class="active">ตรวจสอบข้อมูลร้านอาหาร</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    ตรวจสอบข้อมูลร้านอาหาร
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
                        <div class="panel-body tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">ข้อมูลร้านอาหาร</a></li>
                                <li><a href="#tab2" data-toggle="tab">เมนูอาหาร</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1">
                                    <input name="id" value="<?= $id ?>" readonly hidden>
                                    <div class="form-group">
                                        <label>ชื่อร้านอาหาร</label>
                                        <p><?= $dataObj->res_name ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>ประเภทอาหาร</label>
                                        <p><?= $dataObj->ft_name ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>คำอธิบายย่อ</label>
                                        <p><?= $dataObj->res_short_desc ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Url</label>
                                        <p>
                                            <a target="_blank" href="<?= $dataObj->res_url ?>"><?= $dataObj->res_url ?></a>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>เวลาทำการ</label>
                                        <p><?= $dataObj->res_office_time ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>รูปภาพ</label><br>
                                        <img src="../images/restaurants/<?= $dataObj->res_image ?>" width="200">
                                    </div>
                                    <div class="form-group">
                                        <label>แผนที่</label>
                                        <p><?= $dataObj->res_map ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>สถานะ</label>
                                        <p>
                                            <?php if ($dataObj->res_status == 0) : ?>
                                                <span class="badge bg-danger">ไม่เผยแพร่</span>
                                            <?php else : ?>
                                                <span class="badge bg-success">เผยแพร่</span>
                                            <?php endif ?>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>บทความเกี่ยวกับร้านอาหาร</label>
                                        <p><?= $dataObj->res_full_desc ?></p>
                                    </div>


                                    <br>

                                    <a href="../services/restaurant_update_status_1.php?id=<?= $id ?>" class="btn btn-primary" onclick="return confirm('ยืนยันการอนุมัติ?')">อนุมัติร้านอาหาร</a>
                                </div>


                                <div class="tab-pane fade" id="tab2">
                                    <h3>เมนูอาหาร</h3>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ชื่อเมนู</th>
                                                <th>รูปเมนู</th>
                                                <th>คำอธิบาย</th>
                                                <th>ราคา</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menus_query as $key => $menu) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $menu['mn_name'] ?>
                                                    </td>
                                                    <td>
                                                        <img src="../images/menus/<?= $menu['mn_image'] ?>" width="75" height="75">
                                                    </td>
                                                    <td>
                                                        <?= $menu['mn_description'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $menu['mn_price'] ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <br>

                                    <a href="../services/restaurant_update_status_1.php?id=<?= $id ?>" class="btn btn-primary" onclick="return confirm('ยืนยันการอนุมัติ?')">อนุมัติร้านอาหาร</a>
                                </div>
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