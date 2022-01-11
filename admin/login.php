<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>เข้าสู่ระบบจัดการข้อมูลเว็บไซต์ร้านอาหารในอำเภอเมืองนครสวรรค์ จังหวัดนครสวรรค์</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">ตรวจสอบสิทธิ์การใช้งาน</div>
				<div class="panel-body">
					<form action="../services/user_login.php" method="post" role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="ชื่อผู้ใช้งาน" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="รหัสผ่าน" name="password" type="password" value="" required>
							</div>
							<button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->


	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>