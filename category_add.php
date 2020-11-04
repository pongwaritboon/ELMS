<?php
require("config/db.php");

require("function.php");

checkAuthAdmin();
// $deviceName = $_POST['category_name'];
 if(isset($_POST['category_name']) && isset($_POST['category_detail'])){
	 
	$uploadOk = 1;
	 
	if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0){

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			
//			$new_file_name = date("ymdhis").'.'.$imageFileType;
			$new_file_name =  $deviceName.'.'.$imageFileType;
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_dir.$new_file_name)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
				exit();
			}
		}
	}
		

	$device_name = $_POST['category_name'];
	
	$device_detail = $_POST['category_detail'];
	
	if(!empty($new_file_name)){
		 
		$image = $new_file_name;
	
	}else{
		
		$image = "";
	}

	$now = date('Y-m-d H:i:s');
	
	//คำสั่ง SQL เพิ่มข้อมูลในฐานช้อมูล
//	$sql = "INSERT INTO device (id,device_name,device_detail,device_image,created_at,updated_at)
// VALUES (NULL,'$device_name','$device_detail','$image','$now','$now')";
     
    $sql = "INSERT INTO `category` (`categoryID`, `categoryName`, `description`) VALUES
            (NULL, '$device_name', '$device_detail')";

	if (mysqli_query($conn, $sql)) {
		
		if($uploadOk > 0){
			header("location:category.php");
		}
		
	} else {
		
		//กรณีเกิดข้อผิดพลาด
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
		
 }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Category </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php include("script/css_script.php")?>

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
                    

					<li class="">
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
					<li class="'.$event_add.' ">
						<a href="borrowing.php">
						<i class="fa fa-book"></i> <span>อุปกรณ์ที่กำลังถูกยืม</span>
						</a>
					</li>
					<li class="">
						<a href="history.php">
						<i class="fa fa-history"></i> <span>ประวัติการยืมอุปกรณ์</span>
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
						<li class="'.$room.'"><a href="category.php"><i class="fa fa-circle-o"></i> หมวดหมู่</a></li>
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
                        <h3 class="box-title">เพิ่มอุปกรณ์</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-md-offset-3 col-md-6">

                            <div class="card border-primary">
                                <div class="card-body">

                                    <form method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label>ชื่อหมวดหมู่</label>
                                            <input type="text" class="form-control" name="category_name" required>
                                        </div>

                                        <div class="form-group">
                                            <label>คำอธิบาย</label>
                                            <input type="text" class="form-control" name="category_detail" >
                                        </div>
<!--
                                        <div class="form-group">
                                            <label>รูปภาพ</label>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div>
-->

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                            <a href="category.php" class="btn btn-default">ปิด</a>
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

        <?php include("layout/footer.php")?>

        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->

    <?php include("script/js_script.php")?>

</body>

</html>
