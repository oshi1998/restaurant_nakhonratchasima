<?php

if (isset($_GET['id'])) {
    include("services/connect.php");

    $res_id = mysqli_real_escape_string($conn, $_GET['id']);

    //select ข้อมูลร้านอาหาร
    $sql = "SELECT * FROM restaurants,food_types WHERE restaurants.ft_id=food_types.ft_id AND res_id='$res_id'";
    $restaurants_query = mysqli_query($conn, $sql);
    $dataObj = mysqli_fetch_object($restaurants_query);

    //select ข้อมูลเมนูอาหาร
    $sql = "SELECT * FROM menus WHERE res_id='$res_id'";
    $menus_query = mysqli_query($conn, $sql);

    //select ข้อมูลความคิดเห็น
    $sql = "SELECT * FROM comments,users WHERE comments.user_id=users.user_id AND res_id='$res_id' ORDER BY cm_id DESC";
    $comments_query = mysqli_query($conn, $sql);
} else {
    echo "<script>window.history.back()</script>";
}

?>

<?php
session_start();
if (isset($_SESSION["AUTH_MEMBER_ID"])) {

    $user_id = $_SESSION["AUTH_MEMBER_ID"];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $userObj = mysqli_fetch_object($query);
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
                    <?= $dataObj->res_name ?>
                    <?php if (isset($_SESSION["AUTH_MEMBER_ID"])) : ?>
                        <?php
                        //เช็ครายการโปรด
                        $sql = "SELECT * FROM favourites WHERE res_id='$dataObj->res_id' AND user_id='$userObj->user_id'";
                        $fav_query = mysqli_query($conn, $sql);
                        $favObj = mysqli_fetch_object($fav_query);

                        if (!empty($favObj)) {
                            $function = "removeFavourite($favObj->fav_id,$favObj->res_id)";
                            $class = "fa fa-heart";
                        } else {
                            $function = "addFavourite($dataObj->res_id)";
                            $class = "fa fa-heart-o";
                        }
                        ?>
                        <i class="<?= $class ?>" onclick="<?= $function ?>" id="fav<?= $dataObj->res_id ?>"></i>
                    <?php endif ?>
                </h2>
                <div class="box mt-0">
                    <div class="detail-box">
                        <a href="#" onclick="window.history.back()">
                            <i class="fa fa-arrow-left"></i>
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
        </div>
    </section>

    <!-- end news section -->


    <!-- Report Comment Modal -->
    <div class="modal fade" id="reportCommentModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ระบุเหตุผลที่รายงานความคิดเห็นนี้</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="reportCommentForm" action="services/comment_report_update.php" method="post">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input name="cm_id" id="report_cm_id" readonly hidden>
                        <div class="form-group">
                            <input type="radio" name="reason" value="ข้อความคุกคามทางเพศ" required>
                            <label>คุกคามทางเพศ</label>
                            <input type="radio" name="reason" value="คำหยาบคาย" required>
                            <label>คำหยาบคาย</label>
                            <input type="radio" name="reason" value="ข้อมูลเท็จ" required>
                            <label>ข้อมูลเท็จ</label>
                            <br>
                            <input type="radio" name="reason" value="คำพูดแสดงความเกลียดชัง" required>
                            <label>คำพูดแสดงความเกลียดชัง</label>
                            <input type="radio" name="reason" value="สแปม" required>
                            <label>สแปม</label>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('ยืนยันการรายงาน?')">รายงาน</button>
                    </div>
                </form>
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

    <script>
        $(document).ready(function() {
            $('#commentForm')[0].reset();
        });

        function addFavourite(res_id) {
            $.ajax({
                method: "post",
                url: "services/favourite_insert.php",
                data: {
                    "res_id": res_id
                }
            }).done(function(res) {

                var fav_id = res.fav_id;

                $('#fav' + res_id).removeClass('fa fa-heart-o');
                $('#fav' + res_id).addClass('fa fa-heart');
                $('#fav' + res_id).attr('onclick', `removeFavourite(${fav_id},${res_id})`);
            }).fail(function(res) {
                alert(res.responseJSON['msg']);
            });
        }

        function removeFavourite(fav_id, res_id) {
            $.ajax({
                method: "post",
                url: "services/favourite_delete.php",
                data: {
                    "fav_id": fav_id
                }
            }).done(function(res) {
                $('#fav' + res_id).removeClass('fa fa-heart');
                $('#fav' + res_id).addClass('fa fa-heart-o');
                $('#fav' + res_id).attr('onclick', `addFavourite(${res_id})`);
            }).fail(function(res) {
                alert(res.responseJSON['msg']);
            });
        }

        function reportComment(cm_id) {
            $('#reportCommentForm')[0].reset();
            $('#report_cm_id').val(cm_id);
            $('#reportCommentModal').modal('show');
        }
    </script>

</body>

</html>