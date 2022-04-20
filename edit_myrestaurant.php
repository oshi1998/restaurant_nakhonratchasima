<?php
session_start();
if (isset($_SESSION["AUTH_MEMBER_ID"])) {

    include("services/connect.php");

    $user_id = $_SESSION["AUTH_MEMBER_ID"];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $userObj = mysqli_fetch_object($query);

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM restaurants WHERE res_id='$id'";
        $query = mysqli_query($conn, $sql);
        $dataObj = mysqli_fetch_object($query);

        $sql = "SELECT * FROM menus WHERE res_id='$id'";
        $menus_query = mysqli_query($conn, $sql);

        //select ข้อมูลประเภทอาหาร
        $sql = "SELECT * FROM food_types";
        $food_types_query = mysqli_query($conn, $sql);
    } else {
        echo "<script>window.history.back()</script>";
    }
} else {
    header("location:home.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>เว็บไซต์แนะนำร้านอาหารยอดนิยม จังหวัดนครสวรรค์</title>


    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- slidck slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css.map" integrity="undefined" crossorigin="anonymous" />


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <?php include("header.php") ?>
        <!-- end header section -->
    </div>

    <!-- news section -->
    <section class="news_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    แบบฟอร์มแก้ไขร้านอาหาร
                </h2>
                <div class="box mt-0">
                    <div class="detail-box">
                        <a href="#" onclick="window.history.back()">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel panel-container">


                <div class="row">
                    <div class="col-sm-6 col-lg-12">
                        <div class="panel-body">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-tab1-tab" data-toggle="pill" href="#pills-tab1" role="tab" aria-controls="pills-tab1" aria-selected="true">ข้อมูลร้านอาหาร</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-tab2-tab" data-toggle="pill" href="#pills-tab2" role="tab" aria-controls="pills-tab2" aria-selected="false">เมนูอาหาร</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">
                                    <form action="services/member-side/restaurant_update.php" method="post" enctype="multipart/form-data">
                                        <input name="id" value="<?= $id ?>" readonly hidden>
                                        <div class="form-group">
                                            <label>ชื่อร้านอาหาร</label>
                                            <input type="text" class="form-control" name="name" value="<?= $dataObj->res_name ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทอาหาร</label> <br>
                                            <select class="form-control" name="ft_id" required>
                                                <?php foreach ($food_types_query as $ft) { ?>
                                                    <option value="<?= $ft['ft_id'] ?>" <?= ($dataObj->ft_id == $ft['ft_id']) ? "selected" : "" ?>><?= $ft['ft_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <br><br>
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
                                            <img src="images/restaurants/<?= $dataObj->res_image ?>" width="200">
                                            <input name="old_image" value="<?= $dataObj->res_image ?>" readonly hidden>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label>ลิ้ง Google Map</label>
                                            <textarea class="form-control" name="map"><?= $dataObj->res_map ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>บทความเกี่ยวกับร้านอาหาร</label>
                                            <textarea class="form-control" name="full_desc" id="editor"><?= $dataObj->res_full_desc ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-tab2" role="tabpanel" aria-labelledby="pills-tab2-tab">
                                    <h3>แบบฟอร์มแก้ไขเมนูอาหารเดิม</h3>
                                    <form action="services/member-side/menu_update.php" method="post" enctype="multipart/form-data">
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
                                                            <img src="images/menus/<?= $menu['mn_image'] ?>" width="75" height="75">
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
                                                            <a href="services/menu_delete.php?id=<?= $menu['mn_id'] ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?')">
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
                                    <form action="services/member-side/menu_insert.php" method="post" enctype="multipart/form-data">
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
                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- end news section -->


    <!-- Report Comment Modal -->
    <div class="modal fade" id="howToShareGoogleMapModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">วิธีแชร์แผนที่ Google Map</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <ul>
                        <li>เข้า <a target="_blank" href="https://www.google.co.th/maps/">https://www.google.co.th/maps/</a></li>
                        <li>ค้นหาร้านอาหารของคุณ</li>
                        <li>กดที่ปุ่มแชร์</li>
                        <li>กดที่เมนูฝังแผนที่ บนหน้าต่างที่เด้งขึ้นมา</li>
                        <li>เลือกขนาดเป็นปานกลาง</li>
                        <li>กดคัดลอก HTML</li>
                        <li>วางโค้ดลงในช่อง</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal -->


    <div class="footer_container">
        <!-- info section -->
        <section class="info_section ">
        </section>
        <!-- end info_section -->


        <!-- footer section -->
        <footer class="footer_section">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> สงวนลิขสิทธิ์โดย
                    <a href="home.php">เว็บไซต์แนะนำร้านอาหาร จังหวัดนครสวรรค์</a><br>
                    จัดทำโดย: <a target="_blank" href="https://www.facebook.com/kiwtynaha">คิว</a>
                </p>
            </div>
        </footer>
        <!-- footer section -->

    </div>
    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- slick  slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <!-- ckeditor -->
    <script src="admin/ckeditor/ckeditor.js"></script>

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