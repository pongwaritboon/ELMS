<?php
session_start();

require('config/db.php');

	$message = "";

	//ตรวจสอบว่ามีการส่งค่า username และ password มาจากฟอร์ม Login หรือไม่
	if(isset($_POST['username']) && isset($_POST['password'])){

			//ตรวจสอบว่า username และ password เป็นค่าว่าหรือไม่
			if(!empty($_POST['username']) && !empty($_POST['password'])){

				$username = stripslashes($_POST['username']); // ตรวจสอบกรณีมี backslashes ป้องกัน SQL Injection

				$username = mysqli_real_escape_string($conn,$username); //ตรวจสอบกรณีมี อักระพิเศษ ป้องกัน  SQL Injection

				$password = stripslashes($_POST['password']);
				$password = mysqli_real_escape_string($conn,$password);

				$check_password = md5($password);

				//ค้นหา username และ password ตรงกับในระบบ หรือไม่
				$query = "SELECT * FROM `user` WHERE username='$username' and password='".$check_password."'";
				$result = mysqli_query($conn,$query) or die(mysqli_error());
				$row = mysqli_num_rows($result);
				if($row==1){

					$r = mysqli_fetch_assoc($result);

					if($r['status'] == 'y'){

						//กรณีพบช้อมูล สร้างตัวแปร $_SESSION['u_id] มีค่าเท่ากับ id ของผู้ใช้งานระบบ
						$_SESSION['u_id'] = $r['id'];
                        $_SESSION['u_fullname'] = $r['fullname'];
						//กรณีพบช้อมูล สร้างตัวแปร $_SESSION['role] มีค่าเท่ากับ role ของผู้ใช้งานระบบ
						$_SESSION['u_role'] = $r['role'];

						header("Location: device_management.php"); // Redirect user to index.php

					}else if($r['status'] == 'n'){

						$message = "<p class='alert alert-danger'>ขออภัยคุณไม่สามารถเข้าสู่ระบบได้ กรุณาติดต่อผู้ดูแล</p>";

					}else if($r['status'] == 'w'){

						$message = "<p class='alert alert-warning'>บัญชีผู้ใช้ของคุณ อยู่ระหว่างการรออนุมัติจากผู้ดูแล</p>";
					}

				}else{
					//กรณีไม่พบข้อมูล กำหนด ข้อความแจ้งเตือน  ให้กับตัวแปร message
					$message = "<p class='alert alert-danger'>Username/password is incorrect.</p>";
				}
			}else{

				$message = "<p class='alert alert-danger'>Username/password is incorrect.</p>";
			}
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include("script/css_script.php")?>

</head>

<body class="hold-transition">
    <div class="container-fluid" style="background-color: #00a65a; color: white;">
          <div class="row">
<!--           <image class="text-right" width="10%" height src="uploads/tulogo.png">-->
            <h3 class="text-center">ระบบบริหารจัดการอุปกรณ์สำหรับห้องปฏิบัติการต้นคิด สาขาวิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยธรรมศาสตร์</h3>
        </div>
    </div>
    <div class="login-box">
        <div class="login-logo">
            <!--            <b>TONKIT&nbsp;Room</b>-->
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
           <h1 class="text-center" style="color: #00a65a;">ลงชื่อเข้าสู่ระบบ</h1>
            <br>
            <?php
			//แสดงข้อความแจ้งเตือนจากตัวแปร message
			echo $message;
         
		  ?>
    
            <form action="login.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้งาน">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-success btn-flat btn-block">เข้าสู่ระบบ</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
<!--            <br><a>ลืมรหัสผ่าน</a>-->
            <!--            <a href="register.php">หากยังไม่มีบัญชีผู้ใช้งาน ลงทะเบียนเข้าสู่ระบบ</a>-->
        </div>
        <!-- /.login-box-body -->
    </div>

</body>

</html>
