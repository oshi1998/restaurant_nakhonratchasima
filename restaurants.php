<?php include("services/connect.php"); ?>

<?php
session_start();
if (isset($_SESSION["AUTH_MEMBER_ID"])) {

    $user_id = $_SESSION["AUTH_MEMBER_ID"];

    $sql = "SELECT * FROM users WHERE user_id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $userObj = mysqli_fetch_object($query);
}
?>

<?php
//select ข้อมูลประเภทอาหาร
$sql = "SELECT * FROM food_types";
$foot_types_query = mysqli_query($conn, $sql);
?>

<?php
//select ข้อมูลร้านอาหาร
if (isset($_GET['res_name']) && isset($_GET['food_type'])) {

    $sql = "SELECT * FROM restaurants,food_types WHERE res_status=1 AND res_name LIKE '%$_GET[res_name]%' AND restaurants.ft_id='$_GET[food_type]' HAVING restaurants.ft_id=food_types.ft_id";
} else if (isset($_GET['res_name']) && !isset($_GET['food_type'])) {

    $sql = "SELECT * FROM restaurants,food_types WHERE res_status=1 AND res_name LIKE '%$_GET[res_name]%' HAVING restaurants.ft_id=food_types.ft_id";
} else if (!isset($_GET['res_name']) && empty($_GET['res_name']) && isset($_GET['food_type'])) {

    $sql = "SELECT * FROM restaurants,food_types WHERE res_status=1 AND restaurants.ft_id='$_GET[food_type]' HAVING restaurants.ft_id=food_types.ft_id";
} else {

    $sql = "SELECT * FROM restaurants,food_types WHERE res_status=1 HAVING restaurants.ft_id=food_types.ft_id";
}

$restaurants_query = mysqli_query($conn, $sql);

if (mysqli_num_rows($restaurants_query) <= 0) {
    $sql = "SELECT * FROM restaurants,food_types WHERE res_status=1 HAVING restaurants.ft_id=food_types.ft_id";
    $restaurants_query = mysqli_query($conn, $sql);
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
                    ร้านอาหารภายในจังหวัดนครสวรรค์
                </h2>
                <div class="find_container mt-2">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form action="restaurants.php" method="get">
                                    <div class="form-row">
                                        <div class="form-group col-lg-5">
                                            <input type="text" class="form-control" placeholder="ชื่อร้านอาหาร" name="res_name">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <select class="form-control" name="food_type">
                                                <option value="" selected disabled>ประเภทอาหาร</option>
                                                <?php foreach ($foot_types_query as $ft) { ?>
                                                    <option value="<?= $ft['ft_id'] ?>"><?= $ft['ft_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <div class="btn-box">
                                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($restaurants_query as $res) { ?>
                    <div class="col-sm-6 col-md-3 mx-auto">
                        <div class="box">
                            <div class="img-box">
                                <img src="images/restaurants/<?= $res['res_image'] ?>" class="box-img" width="150" height="300" alt="<?= $res['res_name'] ?>">
                            </div>
                            <div class="detail-box">
                                <h4>
                                    <?= $res['res_name'] ?>
                                    <?php if (isset($_SESSION["AUTH_MEMBER_ID"])) : ?>
                                        <?php
                                        //เช็ครายการโปรด
                                        $sql = "SELECT * FROM favourites WHERE res_id='$res[res_id]' AND user_id='$userObj->user_id'";
                                        $fav_query = mysqli_query($conn, $sql);
                                        $favObj = mysqli_fetch_object($fav_query);

                                        if (!empty($favObj)) {
                                            $function = "removeFavourite($favObj->fav_id,$favObj->res_id)";
                                            $class = "fa fa-heart";
                                        } else {
                                            $function = "addFavourite($res[res_id])";
                                            $class = "fa fa-heart-o";
                                        }
                                        ?>
                                        <i class="<?= $class ?>" onclick="<?= $function ?>" id="fav<?= $res['res_id'] ?>"></i>
                                    <?php endif ?>
                                </h4>
                                <p>ประเภทอาหาร: <?= $res['ft_name'] ?></p>
                                <a href="detail.php?id=<?= $res['res_id'] ?>">
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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