<?php
require_once("../services/check_admin.php");
?>

<?php
//select ข้อมูลประเภทอาหาร
$sql = "SELECT * FROM food_types";
$food_types_query = mysqli_query($conn, $sql);
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
                <li class="active">เพิ่มข้อมูล</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    เพิ่มข้อมูลร้านอาหาร
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
                        <form action="../services/restaurant_insert.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>ชื่อร้านอาหาร</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>ประเภทอาหาร</label>
                                <select class="form-control" name="ft_id" required>
                                    <option value="" selected disabled>--- เลือกประเภทอาหาร ---</option>
                                    <?php foreach ($food_types_query as $ft) { ?>
                                        <option value="<?= $ft['ft_id'] ?>"><?= $ft['ft_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>คำอธิบายย่อ</label>
                                <textarea class="form-control" name="short_desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Url</label>
                                <input type="text" class="form-control" name="url" required>
                            </div>
                            <div class="form-group">
                                <label>เวลาทำการ</label>
                                <input type="text" class="form-control" name="office_time" required>
                            </div>
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label>บทความเกี่ยวกับร้านอาหาร</label>
                                <textarea class="form-control" name="full_desc" id="editor"></textarea>
                            </div>


                            <div class="form-group">
                                <h3>เมนูอาหาร</h3>
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