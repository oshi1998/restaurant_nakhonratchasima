<?php
require_once("../services/check_admin.php");
?>

<?php
//select จำนวนข้อมูลต่างๆ ในระบบ
$sql = "SELECT (SELECT COUNT(*) FROM restaurants WHERE res_status=1) as res_num,
(SELECT COUNT(*) FROM users WHERE user_role=1) as user1_num,
(SELECT COUNT(*) FROM comments) as cm_num";
$query = mysqli_query($conn, $sql);
$countObj = mysqli_fetch_object($query);
?>

<?php
//select ข้อมูลร้านอาหาร
$sql = "SELECT * FROM restaurants,food_types,users WHERE restaurants.ft_id=food_types.ft_id AND restaurants.user_id=users.user_id AND res_status=0 AND user_role=1 ORDER BY res_id DESC";
$query = mysqli_query($conn, $sql);
$no = 1;
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ระบบจัดการข้อมูลเว็บไซต์ร้านอาหารในอำเภอเมืองนครสวรรค์ จังหวัดนครสวรรค์</title>
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
				<li class="active">หน้าหลัก</li>
			</ol>
		</div>
		<!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">ระบบจัดการข้อมูลเว็บไซต์ร้านอาหารในอำเภอเมืองนครสวรรค์</h1>
			</div>
		</div>
		<!--/.row-->

		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-home color-blue"></em>
							<div class="large"><?= $countObj->res_num ?></div>
							<div class="text-muted">ร้านอาหาร</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
							<div class="large"><?= $countObj->cm_num ?></div>
							<div class="text-muted">ความคิดเห็น</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large"><?= $countObj->user1_num ?></div>
							<div class="text-muted">สมาชิกทั่วไป</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr style="border: 2px solid black;">

		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<h3>รายการร้านอาหารรอตรวจสอบ (จากสมาชิกทั่วไป)</h3>


						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>ลำดับ</th>
											<th>รูปภาพ</th>
											<th>ชื่อร้านอาหาร</th>
											<th>ประเภทอาหาร</th>
											<th>สถานะ</th>
											<th>ตรวจสอบ</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($query as $row) { ?>
											<tr class="text-left">
												<td><?= $no++ ?></td>
												<td>
													<img class="img-responsive" src="../images/restaurants/<?= $row['res_image'] ?>" width="100">
												</td>
												<td><?= $row['res_name'] ?></td>
												<td><?= $row['ft_name'] ?></td>
												<td>
													<?php if ($row['res_status'] == 0) : ?>
														<span class="badge bg-danger">ไม่เผยแพร่</span>
													<?php else : ?>
														<span class="badge bg-success">เผยแพร่</span>
													<?php endif ?>
												</td>
												<td>
													<a href="restaurant_info.php?id=<?= $row['res_id'] ?>">ตรวจสอบ</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
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