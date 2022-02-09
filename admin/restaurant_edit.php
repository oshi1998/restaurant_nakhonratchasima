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

    $sql = "SELECT * FROM restaurants WHERE res_id='$id'";
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
                <li><a href="restaurant.php">จัดการข้อมูลร้านอาหาร</a></li>
                <li class="active">แก้ไขข้อมูล</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    แก้ไขข้อมูลร้านอาหาร
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
                                    <form action="../services/restaurant_update.php" method="post" enctype="multipart/form-data">
                                        <input name="id" value="<?= $id ?>" readonly hidden>
                                        <div class="form-group">
                                            <label>ชื่อร้านอาหาร</label>
                                            <input type="text" class="form-control" name="name" value="<?= $dataObj->res_name ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทอาหาร</label>
                                            <select class="form-control" name="ft_id" required>
                                                <?php foreach ($food_types_query as $ft) { ?>
                                                    <option value="<?= $ft['ft_id'] ?>" <?= ($dataObj->ft_id == $ft['ft_id']) ? "selected" : "" ?>><?= $ft['ft_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>คำอธิบายย่อ</label>
                                            <textarea class="form-control" name="short_desc"><?= $dataObj->res_short_desc ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input type="text" class="form-control" name="url" value="<?= $dataObj->res_url ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เวลาทำการ</label>
                                            <input type="text" class="form-control" name="office_time" value="<?= $dataObj->res_office_time ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>รูปภาพ</label><br>
                                            <img src="../images/restaurants/<?= $dataObj->res_image ?>" width="200">
                                            <input name="old_image" value="<?= $dataObj->res_image ?>" readonly hidden>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label>บทความเกี่ยวกับร้านอาหาร</label>
                                            <textarea class="form-control" name="full_desc" id="editor"><?= $dataObj->res_full_desc ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <h3>แบบฟอร์มแก้ไขเมนูอาหารเดิม</h3>
                                    <form action="../services/menu_update.php" method="post" enctype="multipart/form-data">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อเมนู</th>
                                                    <th>รูปเมนู</th>
                                                    <th>คำอธิบาย</th>
                                                    <th>ราคา</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($menus_query as $key => $menu) { ?>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" name="menu[<?= $menu['mn_id'] ?>][name]" value="<?= $menu['mn_name'] ?>" required>
                                                        </td>
                                                        <td>
                                                            <img src="../images/menus/<?= $menu['mn_image'] ?>" width="75" height="75">
                                                            <input name="menu[<?= $menu['mn_id'] ?>][old_image]" value="<?= $menu['mn_image'] ?>" readonly hidden>
                                                            <input type="file" class="form-control" name="menu[<?= $menu['mn_id'] ?>][image]" accept="image/*">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="menu[<?= $menu['mn_id'] ?>][description]" value="<?= $menu['mn_description'] ?>" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="menu[<?= $menu['mn_id'] ?>][price]" value="<?= $menu['mn_price'] ?>" required>
                                                        </td>
                                                        <td>
                                                            <a href="../services/menu_delete.php?id=<?= $menu['mn_id'] ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?')">
                                                                <i class="fa fa-close"></i>
                                                                <span>ลบ</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                    </form>

                                    <br>

                                    <h3>แบบฟอร์มเพิ่มเมนูอาหาร</h3>
                                    <form action="../services/menu_insert.php" method="post" enctype="multipart/form-data">
                                        <input name="res_id" value="<?= $id ?>" readonly hidden>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ชื่อเมนู</th>
                                                    <th>อัพโหลดรูปเมนู</th>
                                                    <th>คำอธิบาย</th>
                                                    <th>ราคา</th>
                                                    <th>
                                                        <button type="button" class="btn btn-success" onclick="addField()">
                                                            <i class="fa fa-plus"></i>
                                                            <span>เพิ่มเมนู</span>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="menuBodyTable">
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="menu[0][name]" required>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="menu[0][image]" accept="image/*" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="menu[0][description]" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="menu[0][price]" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                </form>
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
    <script src="ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor', {
            extraPlugins: 'filebrowser',
            filebrowserUploadMethod: 'form',
            filebrowserUploadUrl: '../services/ckeditor_upload_image.php',
        });

        var index = 0;

        function addField() {
            index++;
            $('#menuBodyTable').append(
                `
                <tr id="menuRow${index}">
                    <td>
                        <input type="text" class="form-control" name="menu[${index}][name]" required>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="menu[${index}][image]" accept="image/*" required>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="menu[${index}][description]" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="menu[${index}][price]" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="removeField(${index})">
                            <i class="fa fa-close"></i>
                            <span>ลบ</span>
                        </button>
                    </td>
                </tr>
                `
            );
        }

        function removeField(index) {
            $('#menuRow' + index).remove();
        }
    </script>
</body>

</html>