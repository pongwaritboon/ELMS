<?php
require("config/db.php");

require('function.php');

$message = "";

if (isset($_POST['title']) && isset($_POST['room_id'])) {

    $start_time = $_POST['start_hour'] . ':' . $_POST['start_minute'] . ':00';

    $end_time = $_POST['end_hour'] . ':' . $_POST['end_minute'] . ':00';

    $user_id = $_SESSION['u_id'];
    $room_id = $_POST['room_id'];
    $title = $_POST['title'];
    $detail = $_POST['detail'];
    $start_date = $_POST['start_date'] . ' ' . $start_time;
    $end_date = $_POST['end_date'] . ' ' . $end_time;
    $person_use = $_POST['person_use'];
    $status = 'wait';
    $now = date('Y-m-d H:i:s');

    $bookNow = checkDupBooking($conn, $start_date, $end_date, $room_id);

    $message = $bookNow['message'];

    if ($bookNow['status']) {

        $sql = "INSERT INTO events (id,user_id,room_id,title,detail,start_date,end_date,person_use,equipment,status,created_at,updated_at)
			VALUES (NULL,$user_id, $room_id, '$title', '$detail','$start_date','$end_date','$person_use','$equipment','$status','$now','$now')";

        if (mysqli_query($conn, $sql)) {

            header('location:calendar.php');
        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Not Approve</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php include("script/css_script.php") ?>

        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    </head>

    <body class="hold-transition skin-green sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php include("layout/header.php") ?>

            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
				<section class="sidebar">

				  <ul class="sidebar-menu" data-widget="tree">

					<li class="header" style="background-color: #00a65a;color:white;"><?php echo $_SESSION['u_fullname'];echo"&nbsp&nbsp&nbsp";echo $_SESSION['u_fullname'];?> <br><?= $_SESSION['u_role']?> </li>
                    

					<li class="'.$event_add.'">
						<a href="device_management.php">
						<i class="fa fa-plus"></i> <span>รายการอุปกรณ์</span>
						</a>
					</li>

                    <li class="'.$event_add.' active">
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
						<i class="fa fa-shopping-cart"></i> <span>รายการอุปกรณ์ที่กำลังถููกยืม</span>
						</a>
					</li>
						<li class="">
						<a href="history.php">
						<i class="fa fa-history"></i>  <span>ประวัติการยืมอุปกรณ์</span>
						</a>
					</li>
<!--
                   <li class="'.$event_add.'">
						<a href="device_management.php">
						<i class="fa fa-bell"></i> <span>รายการยืม-คืนอุปกรณ์</span>
						</a>
					</li>
-->
                    <li class="treeview '.$user.$room.$department.'">
					  <a href="#">
						<i class="fa fa-cogs"></i>
						<span>ตั้งค่า</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					  </a>
					  <ul class="treeview-menu">
						<li class="'.$room.'"><a href="room.php"><i class="fa fa-circle-o"></i> หมวดหมู่</a></li>
<!--						<li class="'.$department.'"><a href="department.php"><i class="fa fa-circle-o"></i> หน่วยงาน/แผนก</a></li>-->
						<li class="'.$user.'"><a href="user.php"><i class="fa fa-circle-o"></i> ผู้ใช้งานระบบ</a></li>
					  </ul>
					</li>
					<li class="'.$profile.'">
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

                    <div class="col-md-offset-2 col-md-8">

                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">ไม่อนุมัติการยืมอุปกรณ์</h3>
                            </div>
                            <div class="box-body">

                                <div class="card border-primary">
                                    <div class="card-body">

                                        <?php echo $message ?>

                                        <form method="post">

                                            <div class="form-group">
                                                <label>เหตุผล</label>
                                                <textarea rows="3" class="form-control" name="detail"></textarea>
                                            </div>

                                            <hr>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn bg-navy btn-flat">บันทึก</button>
<!--                                                <a href="calendar.php" class="btn btn-default btn-flat">ปิด</a>-->
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>		

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include("layout/footer.php") ?>

            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->

        <?php include("script/js_script.php") ?>

        <!-- bootstrap datepicker -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

        <script>
            $(function () {

                //Date picker
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
            });
        </script>

    </body>
</html>
