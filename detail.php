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
                <div class="col-12">
                    <div class="box">
                        <div class="detail-box ">
                            <form class="text-left">
                                <label>แสดงความคิดเห็นของคุณ</label>
                                <textarea class="form-control" name="message" required></textarea>
                                <br>
                                <button type="submit" class="btn btn-dark float-right">ส่งความคิดเห็น</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- end news section -->

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
    </script>

</body>

</html>