<?php
require("config/db.php");

require("function.php");

auth();

	$message = "";

	$sql = "SELECT * FROM userinfo WHERE username = ".$_POST['username']."";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_assoc($result);
		$firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
//		$position = $row['position'];
//		$department = $row['department'];
		$username = $row['username'];
		$id = $row['id'];

	} else {
		exit();
	}

	if(isset($_POST['username'])){

		$post_username = $_POST['username'];
		$post_firstname = $_POST['firstname'];
        $post_surname = $_POST['surname'];
		//$post_position = $_POST['position'];
		$post_password =  $_POST['password'];

			$sql = "SELECT * FROM user WHERE username = '$post_username' ";

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) == 0) {
//
//					if(empty($post_password)){
//
//						$sql = "UPDATE user SET username = '$post_username',fullname='$post_fullname',position='$post_position' WHERE id=$id";
//
//					}else{
//
//						$p_possword = md5($post_password);
//
//						$sql = "UPDATE user SET username = '$post_username',password = '$p_possword',fullname='$post_fullname',position='$post_position' WHERE id=$id";
//					}
//
//
//					if (mysqli_query($conn, $sql)) {
//
//						$message = "<p class='alert alert-success'>บันทึกข้อมูลเรียบร้อย</p>";
//
//					} else {
//						//กรณีเกิดข้อผิดพลาด
//						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//					}

			}else{

				//$message = "<p class='alert alert-warning'>ขออภัยมีผู้อื่นใช้งาน username นี้แล้ว</p>";
			}
	}

 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ข้อมูลส่วนตัว</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php include("script/css_script.php")?>

</head>

<body class="hold-transition skin-green sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php include("layout/header.php")?>

        <!-- Left side column. contains the sidebar -->
        <?php //echo asideMenu('profile');?>
          <aside class="main-sidebar">
				<section class="sidebar">

				  <ul class="sidebar-menu" data-widget="tree">

					<li class="header" style="background-color: #00a65a;color:white;"><?php echo $_SESSION['u_fullname'];echo"&nbsp&nbsp&nbsp";echo $_SESSION['u_fullname'];?> <br><?= $_SESSION['u_role']?> </li>
                    

					<li class="'.$event_add.'">
						<a href="device_management.php">
						<i class="fa fa-plus"></i> <span>รายการอุปกรณ์</span>
						</a>
					</li>

                      <li class="'.$event_add.' ">
						<a href="approve.php">
						<i class="fa fa-bell"></i> <span>อนุมัติการยืม</span>
						</a>
					</li>
                    <li class="">
						<a href="checkoutitem.php">
						<i class="fa fa-shopping-cart"></i> <span>นำออกอุปกรณ์</span>
						</a>
					</li>
					<li class="">
						<a href="borrowing.php">
						<i class="fa fa-book"></i> <span>อุปกรณ์ที่กำลังถููกยืม</span>
						</a>
					</li>
					<li class="">
						<a href="history.php">
						<i class="fa fa-history"></i> <span>ประวัติการยืมอุปกรณ์</span>
						</a>
					</li>
<!--
<!--
                   <li class="'.$event_add.'">
						<a href="device_management.php">
						<i class="fa fa-bell"></i> <span>รายการยืม-คืนอุปกรณ์</span>
						</a>
					</li>
-->
                    <li class="treeview '.$user.$room.$department.' ">
					  <a href="#">
						<i class="fa fa-cogs"></i>
						<span>ตั้งค่า</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					  </a>
					  <ul class="treeview-menu">
						<li class="'.$room.' "><a href="category.php"><i class="fa fa-circle-o"></i> หมวดหมู่อุปกรณ์</a></li>
<!--						<li class="'.$department.'"><a href="department.php"><i class="fa fa-circle-o"></i> หน่วยงาน/แผนก</a></li>-->
						<li class="'.$user.'"><a href="user.php"><i class="fa fa-circle-o"></i> ผู้ใช้งานระบบ</a></li>
					  </ul>
					</li>
					<li class="'.$profile.'  active">
					  <a href="profile.php">
						<i class="fa fa-user"></i> <span>ข้อมูลส่วนตัว</span>
					  </a>
					</li>
					<li>
					  <a href="logout.php">
						<i class="fa fa-sign-out"></i> <span>ออกจากระบบ</span>
					  </a>
					</li>

				  </ul>
				</section>
			  </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ข้อมูลส่วนตัว</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-md-offset-3 col-md-6">
                            <?php //echo $message?>
                            <form method="post">
                                <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo $firstname?>" required>
                                </div>
                                <div class="form-group">
                                    <label>นามสกุล</label>
                                    <input type="text" name="surname" class="form-control" value="<?php echo $surname?>" required>
                                </div>
                                <div class="form-group">
                                    <label>email</label>
                                    <input type="text" name="position" class="form-control" value="<?php echo $email?>">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="form-group text-right">
                                    <input type="submit" value="บันทึก" class="btn btn-primary">
                                </div>
                            </form>

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include("layout/footer.php")?>

        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->

    <?php include("script/js_script.php")?>

</body>

</html>
