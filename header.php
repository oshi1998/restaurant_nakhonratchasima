<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="home.php">
                <span>
                </span>
            </a>
            <div class="" id="">
                <div class="User_option">
                    <?php if (isset($_SESSION['AUTH_MEMBER_ID'])) : ?>
                        <a href="javascript:void(0)">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span><?= "ยินดีต้อนรับ, " . $userObj->user_firstname ?></span>
                        </a>
                        <a href="services/logout.php">
                            <i class="fa fa-sign-out"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                    <?php else : ?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>เข้าสู่ระบบ</span>
                        </a>
                    <?php endif ?>
                </div>
                <div class="custom_menu-btn">
                    <button onclick="openNav()">
                        <img src="images/menu.png" alt="">
                    </button>
                </div>
                <div id="myNav" class="overlay">
                    <div class="overlay-content">
                        <a href="home.php">หน้าหลัก</a>
                        <a href="restaurants.php">ร้านอาหาร</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Login Modal -->
<div class="modal fade" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เข้าสู่ระบบ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="services/member_login.php" method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>ชื่อผู้ใช้งาน</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#registerModal">ยังไม่มีบัญชี? สมัครสมาชิกคลิก!</a>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">เข้าสู่ระบบ</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Login Modal -->

<!-- Login Modal -->
<div class="modal fade" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">สมัครสมาชิก</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="services/member_register.php" method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>ชื่อผู้ใช้งาน</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>ชื่อจริง</label>
                        <input type="text" class="form-control" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label>นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label>อีเมล</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success">สมัครสมาชิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Login Modal -->