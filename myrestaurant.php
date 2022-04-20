<?php
session_start();
if (isset($_SESSION["AUTH_MEMBER_ID"])) {

    include("services/connect.php");

    $user_id = $_SESSION["AUTH_MEMBER_ID"];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $userObj = mysqli_fetch_object($query);

    //select ข้อมูลร้านอาหาร
    $sql = "SELECT * FROM restaurants,food_types WHERE restaurants.ft_id=food_types.ft_id AND user_id='$user_id'";
    $restaurants_query = mysqli_query($conn, $sql);
    $dataObj = mysqli_fetch_object($restaurants_query);

    if (!empty($dataObj->res_id)) {

        $res_id = $dataObj->res_id;

        //select ข้อมูลเมนูอาหาร
        $sql = "SELECT * FROM menus WHERE res_id='$res_id'";
        $menus_query = mysqli_query($conn, $sql);

        //select ข้อมูลความคิดเห็น
        $sql = "SELECT * FROM comments,users WHERE comments.user_id=users.user_id AND res_id='$res_id' ORDER BY cm_id DESC";
        $comments_query = mysqli_query($conn, $sql);
    } else {
        //select ข้อมูลประเภทอาหาร
        $sql = "SELECT * FROM food_types";
        $food_types_query = mysqli_query($conn, $sql);
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
            <?php if (empty($dataObj)) : ?>
                <div class="heading_container heading_center">
                    <h2>
                        แบบฟอร์มเพิ่มร้านอาหาร
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
                                <form action="services/member-side/restaurant_insert.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>ชื่อร้านอาหาร</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ประเภทอาหาร</label> <br>
                                        <select class="form-control" name="ft_id" required>
                                            <option value="" selected disabled>--- เลือกประเภทอาหาร ---</option>
                                            <?php foreach ($food_types_query as $ft) { ?>
                                                <option value="<?= $ft['ft_id'] ?>"><?= $ft['ft_name'] ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                    <br><br>
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
                                        <label>ลิ้ง Iframe Google Map</label>
                                        <a href="#" data-toggle="modal" data-target="#howToShareGoogleMapModal">
                                            <i class="fa fa-map"></i>
                                            <span>วิธีแชร์แผนที่ Google Map</span>
                                        </a>
                                        <textarea class="form-control" name="map"></textarea>
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
            <?php else : ?>
                <div class="heading_container heading_center">
                    <h2>
                        <?= $dataObj->res_name ?>
                    </h2>
                    <p>สถานะ : <?= ($dataObj->res_status==0) ? "ไม่เผยแพร่ (รอผู้ดูแลตรวจสอบ)" : "เผยแพร่" ?></p>
                    <div class="box mt-0">
                        <div class="detail-box">
                            <a href="edit_myrestaurant.php?id=<?= $dataObj->res_id ?>" title="แก้ไขข้อมูลร้านอาหาร">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="box">
                            <div class="img-box">
                                <img src="images/restaurants/<?= $dataObj->res_image ?>" class="box-img" alt="<?= $dataObj->res_name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="box">
                            <div class="detail-box">
                                <h4>
                                    รายละเอียด
                                </h4>
                                <p>
                                    <?= $dataObj->res_short_desc ?>
                                </p>
                                <p>
                                    เวลาทำการ: <?= $dataObj->res_office_time ?>
                                </p>
                                <p>
                                    ติดตามข่าวสาร:
                                    <a href="<?= $dataObj->res_url ?>" target="_blank">
                                        <i class="fa fa-bullhorn"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="box">
                            <div class="detail-box">
                                <h3>แผนที่</h3>
                                <p>
                                    <?= $dataObj->res_map ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="box">
                            <div class="detail-box">
                                <h3>บทความ</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="box">
                            <div class="detail-box">
                                <h3>เมนูแนะนำ</h3>
                            </div>
                        </div>
                        <div class="box">
                            <div class="detail-box">
                                <div class="row">
                                    <?php foreach ($menus_query as $menu) { ?>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="box">
                                                <div class="img-box">
                                                    <img src="images/menus/<?= $menu['mn_image'] ?>" class="box-img" alt="<?= $menu['mn_name'] ?>" height="300px">
                                                </div>
                                                <div class="detail-box">
                                                    <h4>
                                                        <?= $menu['mn_name'] ?>
                                                    </h4>
                                                    <p><?= $menu['mn_description'] ?></p>
                                                    <p>ราคา: <?= $menu['mn_price'] ?> บาท</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="box">
                            <div class="detail-box">
                                <h3>รีวิว</h3>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION["AUTH_MEMBER_ID"])) : ?>
                        <div class="col-12">
                            <div class="box">
                                <div class="detail-box ">
                                    <form id="commentForm" class="text-left" action="services/comment_insert.php" method="post">
                                        <input name="res_id" value="<?= $dataObj->res_id ?>" readonly hidden>
                                        <label>แสดงความคิดเห็นของคุณ</label>
                                        <textarea class="form-control" name="text" id="inputText" required></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-dark float-right">ส่งความคิดเห็น</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <?php foreach ($comments_query as $comment) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="detail-box">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1 col-sm-1 col-lg-1 text-left">
                                                    <img src="images/avatar.jpg" width="70">
                                                </div>
                                                <div class="col-md-11 col-sm-11 col-lg-11 text-left">
                                                    <strong>
                                                        <?= $comment['user_firstname'] . " " . $comment['user_lastname'] ?>
                                                        <a class="float-right text-center" href="javascript:void(0)" onclick="reportComment(<?= $comment['cm_id'] ?>)">
                                                            <i class="fa fa-flag"></i>
                                                        </a>
                                                    </strong>
                                                    <p><?= $comment['cm_datetime'] ?></p>
                                                    <p><?= $comment['cm_text'] ?></p>
                                                </div>
                                                <?php /* if ($user_id != $comment['user_id']) : */ ?>
                                                <div class="col-md-1 col-sm-1 col-lg-1">

                                                </div>
                                                <?php /* endif  */ ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endif ?>
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