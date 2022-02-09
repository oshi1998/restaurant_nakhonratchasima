<?php
$location = basename($_SERVER["REQUEST_URI"]);
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="../images/admin.png" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?= $userObj->user_firstname . " " . $userObj->user_lastname ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>กำลังใช้งาน</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li class="<?= ($location == 'home.php') ? "active" : "" ?>"><a href="home.php"><em class="fa fa-home">&nbsp;</em> หน้าหลัก</a></li>
        <li class="<?= ($location == 'user.php') ? "active" : "" ?>"><a href="user.php"><em class="fa fa-edit">&nbsp;</em> ข้อมูลผู้ใช้งาน</a></li>
        <li class="<?= ($location == 'food_type.php') ? "active" : "" ?>"><a href="food_type.php"><em class="fa fa-edit">&nbsp;</em> ข้อมูลประเภทอาหาร</a></li>
        <li class="<?= ($location == 'restaurant.php') ? "active" : "" ?>"><a href="restaurant.php"><em class="fa fa-edit">&nbsp;</em> ข้อมูลร้านอาหาร</a></li>
        <li class="<?= ($location == 'comment.php') ? "active" : "" ?>"><a href="comment.php"><em class="fa fa-edit">&nbsp;</em>ข้อมูลความคิดเห็น</a></li>
        <div class="divider"></div>
        <li><a href="../services/logout.php"><em class="fa fa-power-off">&nbsp;</em> ออกจากระบบ</a></li>
    </ul>
</div>
<!--/.sidebar-->