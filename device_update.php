<?php
require("config/db.php");

require("function.php");

checkAuthAdmin();
 
 	if(isset($_GET['id'])){
	
		$id = $_GET['id'];
		
		//คำสั่ง SQL ค้นหาข้อมูล user จาก id ที่ได้รับมา
		$sql = "SELECT * FROM device WHERE itemID = $id";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			
				$r = mysqli_fetch_assoc($result);
				
				$id = $r['itemID'];
				$device_name = $r['device_name'];
				$device_detail = $r['device_detail'];
				$device_image = $r['device_image'];
                $device_status = $r['status'];
            
		}else{
			
			exit();
		}
	
	}else{
		exit();
	}
 
	if(isset($_POST['device_update_id'])){
	 
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
				
				$new_file_name = date("ymdhis").'.'.$imageFileType;
				
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_dir.$new_file_name)) {
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
					exit();
				}
			}
		}
		
		$device_update_id = $_POST['device_update_id'];
        $device_id = $_POST['device_id'];
		$device_name = $_POST['device_name'];
		$device_detail = $_POST['device_detail'];
		$old_image = $_POST['old_image'];
        $device_status = $_POST['status'];
		
		if(!empty($new_file_name)){
			
			$image = $new_file_name;
		
		}else{
			
			$image = $old_image;
		}
		
		$sql = "UPDATE device SET device_name='$device_name',device_detail='$device_detail',device_image='$image',status='$device_status' WHERE itemID= $device_update_id";
        
		if (mysqli_query($conn, $sql)) {
			
			if($uploadOk > 0){
				header("location:device_management.php");
			}

		} else {
			echo "Error updating record: " . mysqli_error($conn);
			exit();
		}
		
    }
	
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>item Update</title>
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
                    

					<li class="'.$event_add.' active">
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
                    <li class="treeview '.$user.$room.$department.'">
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
                        <h3 class="box-title">แก้ไขข้อมูลอุปกรณ์</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-md-offset-3 col-md-6">

                            <form method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label>รหัสอุปกรณ์</label>
                                    <input type="text" name="device_idfff" class="form-control" value="<?php echo $id ?>" disabled>
                                </div>
                                
                                <div class="form-group">
                                    <label>ชื่ออุปกรณ์</label>
                                    <input type="text" name="device_name" class="form-control" value="<?php echo $device_name ?>">
                                </div>
<!--
                                
-->
                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">	
                                                        <label>หมวดหมู่อุปกรณ์</label>
                                                        <select name="device_detail" class="form-control" required>
<!--                                                            <option value="">-- เลือกหมวดหมู่--</option>-->
                                                            
                                                            <?php
                                                            $sql = "SELECT * FROM category";

                                                            $result = mysqli_query($conn, $sql);

                                                            if (mysqli_num_rows($result) > 0) {

                                                                while ($row = mysqli_fetch_assoc($result)) {

                                                                    echo "<option  value='" . $row['categoryName'] . "'>" .$row['categoryName'] . "</option>";
                                                                }
                                                            } else {
                                                                echo "0 results";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>	
                                                </div>
                                     </div>
                            
                                <div class="form-group">
									<label style="font-size: 16px;">สถานะ : </label> &nbsp;&nbsp;
                                    <input type="radio" name="status" value="1" checked="checked" ><label style="font-size: 16px;">&nbsp; ว่าง </label> &nbsp;&nbsp;
									<input type="radio" name="status" value="2" ><label style="font-size: 16px;">&nbsp; กำลังยืมอยู่ </label> &nbsp;&nbsp;
									<input type="radio" name="status" value="0" ><label style="font-size: 16px;">&nbsp; เสีย </label>
								</div>
                                   <div class="form-group">
                                    <label>รูปภาพอุปกรณ์</label>
                                    <input type="file" name="fileToUpload" id="fileToUpload">

                                </div>
                                <?php 
						          if(!empty($device_image)){
							             echo "<img src='uploads/".$device_image."' class='img-thumbnail' width='250' height='250'>";
						          }
					            ?>
                                <input type="hidden" name="device_update_id" value="<?php echo $id ?>">

                                <input type="hidden" name="old_image" value="<?php echo $device_image ?>">

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                    <a href="device_management.php" class="btn btn-default">ย้อนกลับ</a>
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
