<?php

require("config/db.php");

require("phpqrcode/qrlib.php");

require("function.php");

checkAuthAdmin();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Category Management</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php include("script/css_script.php")?>

    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

</head>

<body class="hold-transition skin-green sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php include("layout/header.php")?>

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

                    <li class="'.$event_add.'">
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
						<i class="fa fa-shopping-cart"></i> <span>รายการอุปกรณ์ที่กำลังถูกยืม</span>
						</a>
					</li>
						<li class="">
						<a href="history.php">
						<i class="fa fa-shopping-cart"></i> <span>ประวัติการยืมอุปกรณ์</span>
						</a>
					</li>
<!--
                   <li class="'.$event_add.'">
						<a href="device_management.php">
						<i class="fa fa-bell"></i> <span>รายการยืม-คืนอุปกรณ์</span>
						</a>
					</li>
-->
                    <li class="treeview '.$user.$room.$department.' active">
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

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h2 style="font-size: 30px;" class="box-title">หมวดหมู่อุปกรณ์</h2>
                    </div>
                    <div class="box-body">

                        <p>
                            <a href="category_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> เพิ่มหมวดหมู่อุปกรณ์</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tb-device">
                                <thead>
                                    <tr class="active">
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="10%">ชื่อหมวดหมู่</th>
                                        <th scope="col" width="10%">คำอธิบาย</th>
<!--
                                        <th scope="col" width="15%">ชื่ออุปกรณ์</th>
                                        <th scope="col" width="10%">หมวดหมู่</th>
                                        <th scope="col" width="10%">สถานะ</th>
-->
                                        <th scope="col" width="5%">แก้ไข</th>
                                        <th scope="col" width="5%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

					//คำสั่ง SQL สำหรับแสดงข้อมูล category ทั้งหมด
					$sql = "SELECT * FROM category ";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						$i = 1;
						while($row = mysqli_fetch_assoc($result)) {
							
                            $id=$row['categoryID'];
                            $categoryName=$row['categoryName'];
                             $descript=$row['description'];
                            //echo $id;
							echo "<tr>";
								echo "<td scope='row'>".$i."</td>";
                            echo "<td scope='row'>".$categoryName."</td>";
                            echo "<td scope='row'>".$descript."</td>";
         
								echo "<td><a href='category_update.php?id=".$row['categoryID']."' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i> แก้ไข</a></td>";
								echo "<td><a href='category_delete.php?id=".$row['categoryID']."' onclick='return confirm(\"คุณต้องการลบข้อมูลหรือไม่\");'  class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> ลบ</a></td>";
							echo "</tr>";
							$i++;
						}
						
					} else {
						echo "0 results";
					}

					mysqli_close($conn);
				?>
                                </tbody>
                            </table>
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

    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            $('#tb-device').DataTable({
                "responsive":true,
                 "paging":   false,
            " ordering": false,
            "info":     false
            })
        });

    </script>

</body>

</html>
