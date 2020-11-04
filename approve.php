<?php
//date_default_timezone_set("Asia/Bangkok");
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
    <title>Approve List</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php include("script/css_script.php")?>
    
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
     <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!--Sweet Alert-->
    <meta property="og:url" content="http://lipis.github.io/bootstrap-sweetalert/" />

    <meta property="og:image" content="http://lipis.github.io/bootstrap-social/assets/bootstrap-sweetalert.png" />

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
						<i class="fa fa-book"></i> <span>อุปกรณ์ที่กำลังถููกยืม</span>
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

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h2 style="font-size: 30px;" class="box-title">อนุมัติการยืมอุปกรณ์</h2>
                    </div>
                    <div class="box-body">

                        <p>
<!--                            <a href="device_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> เพิ่มอุปกรณ์</a>-->
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tb-approve">
                                <thead>
                                    <tr class="active">
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="10%">รหัสคำร้องการยืม</th>
                                        <th scope="col" width="10%">รหัสอุปกรณ์</th>
                                        <th scope="col" width="10%">ชื่ออุปกรณ์</th>
                                        <th scope="col" width="10%">ชื่อผู้ยืม</th>            
                                        <th scope="col" width="10%">วันที่และเวลายื่นคำร้อง</th>
                                        <th scope="col" width="10%">เหตุผลที่ยืม</th>
                                        <th scope="col" width="10%">สถานะ</th>
                                        <th scope="col" width="5%"></th>
                                        <th scope="col" width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                
                                 <?php
                                //     $event_id = $_GET['find_event_id'];
                                //
                                //        //Find One Event
                                //        $sql = "SELECT events.id,user_id,title,DATE(start_date) as start_date,DATE(end_date) as end_date,
                                //		TIME(start_date) as start_time , TIME(end_date) as end_time,detail,person_use,events.status,
                                //				room.room_name,user.fullname,user.department,equipment,room.room_image,department.department_name
                                //				FROM events 
                                //				INNER JOIN room ON room.id = events.room_id 
                                //				INNER JOIN user ON user.id = events.user_id 
                                //                LEFT JOIN department On user.department = department.id
                                //                WHERE events.id = $event_id";

//                                    $sql = "SELECT * FROM transaction
//                                            ";
                                    $sql = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.borrowed_date,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            WHERE transaction.status = 1";
                        
          //                                            JOIN log ON transaction.transactionID = log.transactionID              
                                    $result = $conn->query($sql);
                                
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        $i=1;
                                        while($row = $result->fetch_assoc()) {
                                            if($row['status'] == 1){
                                                $row['status'] = 'รอการอนุมัติ';
                                            }
                                            //$i += 1;
                                            echo "<tr>";
                                            echo "<td scope='row'>".$i."</td>";
                                            echo "<td scope='row'>".$row['transactionID']."</td>";
                                            echo "<td scope='row'>".$row['itemID']."</td>";
                                            echo "<td scope='row'>".$row['device_name']."</td>";
                                            echo "<td scope='row'>".$row['firstname']." ".$row['surname']."</td>";
//                                            echo "<td scope='row'>"."พงษ์วริษฐ์ บุญญาภัทรศิริ"."</td>";
//                                            ".dateThai($row['start_date'])."
                                            echo "<td scope='row'>".dateTimeThai($row['request_date'])."</td>";
                                            //echo "<td scope='row'>"."25 กุมภาพันธ์ 2563 12:00"."</td>";
                                           echo "<td scope='row'>".$row['user_comment']."</td>";
                                            echo "<td scope='row'>".$row['status'] ."</td>";
                                             //echo "<td scope='row'>".$row['itemID']."</td>";
//                                            echo "<td scope='row'>".$transaction_status."</td>";
                                           // echo "<td><a href='approveUpdate.php?id=".$row['transactionID']."' class='btn btn-success btn-sm'>อนุมัติ</a></td>";
                                           
                                            echo "<td scope='row'><button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#approveModal'>
                                      อนุมัติ
                                    </button></td>";
								echo "<td scope='row'><button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#notApproveModal'>
                                      ไม่อนุมัติ
                                    </button></td>";
                                           // <!--Approve Modal -->
                                        echo "<div class='modal fade' id='approveModal' tabindex='-1'' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
                                            echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
                                             echo " <div class='modal-content'>";
                                                echo " <div class='modal-header'>";
                                                     echo "<h5 class='modal-title' id='exampleModalCenterTitle' style='font-size:24px;'>นัดรับอุปกรณ์</h5>";
                                                     echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                                                        echo "<span aria-hidden='true'>&times;</span>";
                                                    echo "</button>";
                                            echo " </div>";
                                            echo "<div class='modal-body'>";
                                                echo "<form method='post'>";
                                                    echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>รหัสคำร้อง : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['transactionID'];
                                                    echo " </div>";
                                            echo " </div>";
                                              echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>รหัสอุปกรณ์ : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['itemID'];
                                                    echo " </div>";
                                            echo " </div>";
                                              echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>ชื่ออุปรณ์ : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['device_name'];
                                                    echo " </div>";
                                            echo " </div>";
                                              echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>ชื่อผู้ยืม : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['firstname']." ".$row['surname'];
                                                    echo " </div>";
                                            echo " </div>";
                                             echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-left '> ";
                                                            echo " <label>วันที่เวลายื่นคำร้อง: </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left pl-0'> ";
                                                            echo dateTimeThai($row['request_date']);
                                                    echo " </div>";
                                            echo " </div>";
                                            
                                               echo  "    <div class='row'>";
                                            echo  "    <div class='col-md-6'>";
                                              echo  "      <div class='form-group'>";
                                              echo  "          <label>วันที่นัดรับ</label>";
//                                                    $date = date("d-m-Y");
                                            $date = date("Y-m-d H:i:s");
                                            $date = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$date)));
                                            echo "<input type='text' class='form-control datepicker' name='borrow_date' value='".$date."'>";
                                             echo" </div>";
                                             echo" </div>";
                                            echo  "    <div class='col-md-3'>";
                                             echo  "      <div class='form-group'>";
                                            echo  "          <label>เวลาที่นัดรับ</label>";
                                            echo  "          <select name='start_hour' class='form-control'>";
                                                for ($i = 0; $i <= 23; $i++) {
                                                        $zero = $i < 10 ? '0' : '';
                                                echo "<option value='" . $zero . $i . "'>$zero$i</option>";
                                                }
                                            echo "</select>";
                                            echo " </div>";
                                            echo " </div>";
                                             echo  "    <div class='col-md-3'>";
                                             echo  "      <div class='form-group'>";
                                            echo  "          <label>นาที</label>";
                                            echo  "          <select name='start_minute' class='form-control'>";
                                                for ($i = 0; $i <= 59; $i++) {
                                                        $zero = $i < 10 ? '0' : '';
                                                echo "<option value='" . $zero . $i . "'>$zero$i</option>";
                                                }
                                            echo "</select>";
                                            echo " </div>";
                                            echo " </div>";
                                             
                                                   		
                                           echo" </div>";
                                                echo "  </form>";
                                             echo " </div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<a href='approveUpdate.php?borrow_date=".$date."&id=".$row['transactionID']."&itemID=".$row['itemID']."' onclick='return confirm(\"คุณต้องการอนุมัติใช่หรือไม่\");'><button type='button' class='btn btn-success'>อนุมัติ</button></a>";
                                           
                                             echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            
                                           // <!--Not Approve Modal -->
                                        echo "<div class='modal fade' id='notApproveModal' tabindex='-1'' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
                                            echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
                                             echo " <div class='modal-content'>";
                                                echo " <div class='modal-header'>";
                                                     echo "<h5 class='modal-title' id='exampleModalCenterTitle' style='font-size:24px;'>นัดรับอุปกรณ์</h5>";
                                                     echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                                                        echo "<span aria-hidden='true'>&times;</span>";
                                                    echo "</button>";
                                            echo " </div>";
                                            echo "<div class='modal-body'>";
                                                echo "<form method='post'>";
                                                    echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>รหัสคำร้อง : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['transactionID'];
                                                    echo " </div>";
                                            echo " </div>";
                                              echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>รหัสอุปกรณ์ : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['itemID'];
                                                    echo " </div>";
                                            echo " </div>";
                                              echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>ชื่ออุปรณ์ : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['device_name'];
                                                    echo " </div>";
                                            echo " </div>";
                                              echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-right'> ";
                                                            echo " <label>ชื่อผู้ยืม : </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left'> ";
                                                            echo $row['firstname']." ".$row['surname'];
                                                    echo " </div>";
                                            echo " </div>";
                                             echo "<div class='row'> ";
                                                     echo "<div class='col-md-3 text-left '> ";
                                                            echo " <label>วันที่เวลายื่นคำร้อง: </label>";
                                                    echo " </div>";
                                                    echo "<div class='col-md-9 text-left pl-0'> ";
                                                            echo dateTimeThai($row['request_date']);
                                                    echo " </div>";
                                            echo " </div>";
                                            
                                               echo  "    <div class='row'>";
                                            echo  "    <div class='col-md-12'>";
                                            echo "<form method='post'>";
                                              echo  "      <div class='form-group'>";
                                              echo  "          <label>เหตุผลที่ไม่อนุมัติคำร้อง</label>";
                                             echo "<textarea rows='3' class='form-control' name='detail'></textarea>";
                                                   		echo" </div>";
                                           echo" </div>";
    
                                                echo "  </form>";
                                             echo " </div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<a href='notapproveUpdate.php?id=".$row['transactionID']."&itemID=".$row['itemID']."' onclick='return confirm(\"คุณต้องการไม่อนุมัติใช่หรือไม่\");'><button type='button' class='btn btn-danger'>ไม่อนุมัติ</button></a>";
                                           
                                             echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            
                                            $i++;
                                        }}
//                                    else {
//                                        echo "0 results";
//                                    }
                                    $conn->close();              ?>
                              
                                    <!--Approve Modal -->
<!--
                                        <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle" style="font-size:24px;">นัดรับอุปกรณ์</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                               <form method="post" enctype="multipart/form-data">
                                                <div class="row">                 
                                                     <div class="col-md-3 text-right">
                                                         <label>รหัสคำร้อง : </label>
                                                   </div>
                                                   <div class="col-md-9 text-left">
                                                       10000
                                                   </div>
                                                  </div>
                                                <div class="row">
                                                     <div class="col-md-12">    </div>
                                                    <div class="col-md-3 text-right">
                                                        <label> รหัสอุปกรณ์ : </label> 
                                                   </div>
                                                     <div class="col-md-3 text-left">
                                                       01 
                                                   </div>
                                                     <div class="col-md-3 text-left">
                                                         <label>ชื่ออุปกรณ์ : </label>
                                                   </div>
                                                     <div class="col-md-3 text-left">
                                                       Arduino UNO 
                                                   </div>
                                                     <div class="col-md-4 text-center">
                                                         <label>ชื่อผู้ยืม : </label>
                                                   </div>
                                                     <div class="col-md-8 text-left p-0">
                                                      พงษ์วริษฐ์ บุญญาภัทรศิริ
                                                   </div></div>
                                                      <div class="row">
                                                       <div class="col-md-4">
                                                         <label>วันที่เวลายื่นคำร้อง : </label>
                                                   </div>
                                                     <div class="col-md-8 text-left">
                                                      1 ธันวาคม 2562 00.00
                                                   </div></div>
                                                   <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>วันที่นัดรับ</label>
                                                        <input type="text" class="form-control datepicker" name="start_date" value="<?php //echo date("Y-m-d") ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>เวลาที่นัดรับ</label>
                                                        <select name="start_hour" class="form-control">
                                                            <?php
//                                                            for ($i = 0; $i <= 23; $i++) {
//                                                                $zero = $i < 10 ? '0' : '';
//                                                                echo "<option value='" . $zero . $i . "'>$zero$i</option>";
//                                                            }
                                                            ?>
                                                        </select>
                                                    </div>								
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>นาที</label>
                                                        <select name="start_minute" class="form-control">
                                                            <?php
//                                                            for ($i = 0; $i <= 59; $i++) {
//                                                                $zero = $i < 10 ? '0' : '';
//                                                                echo "<option value='" . $zero . $i . "'>$zero$i</option>";
//                                                            }
                                                            ?>
                                                        </select>
                                                    </div>								
                                                </div>							
                                            </div>
                                                  </form>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                <button type="button" class="btn btn-primary">บันทึก</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
-->
<!--
                                     Not Approve Modal 
                                        <div class="modal fade" id="notApproveModaltem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle" style="font-size:24px;">ไม่อนุมัติการยืมอุปกรณ์</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="row">
                                                     <div class="col-md-3 text-right">
                                                         <label>รหัสคำร้อง : </label>
                                                   </div>
                                                   <div class="col-md-9 text-left">
                                                       10000
                                                   </div>
                                                  </div>
                                                <div class="row">
                                                     <div class="col-md-12">    </div>
                                                    <div class="col-md-3 text-right">
                                                        <label> รหัสอุปกรณ์ : </label> 
                                                   </div>
                                                     <div class="col-md-3 text-left">
                                                       01 
                                                   </div>
                                                     <div class="col-md-3 text-left">
                                                         <label>ชื่ออุปกรณ์ : </label>
                                                   </div>
                                                     <div class="col-md-3 text-left">
                                                       Arduino UNO 
                                                   </div>
                                                     <div class="col-md-4 text-center">
                                                         <label>ชื่อผู้ยืม : </label>
                                                   </div>
                                                     <div class="col-md-8 text-left p-0">
                                                      พงษ์วริษฐ์ ุบุญญาภัทรศิริ
                                                   </div></div>
                                                      <div class="row">
                                                       <div class="col-md-4">
                                                         <label>วันที่เวลายื่นคำร้อง : </label>
                                                   </div>
                                                     <div class="col-md-8 text-left">
                                                      1 ธันวาคม 2562 00.00
                                                   </div></div>
                                                    <div class="form-group">
                                                <label>เหตุผล</label>
                                                <textarea rows="3" class="form-control" name="detail"></textarea>
                                            </div>
-->

<!--                                            <hr>-->

<!--                                             </div>-->
<!--
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                <button type="button" class="btn btn-primary">บันทึก</button>
                                               
                                              </div>
                                            </div>
                                          </div>
                                        </div>
-->
                                    </tr>
                           
                                    
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
   <!-- bootstrap datepicker -->
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
                                <!-- bootstrap datepicker thai-->
        <script src="bootstrap-datepicker-custom/jquery-2.1.3.min.js"></script>
        <link href="bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js"></script>
        <script src="bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

       <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                //todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true ,             //Set เป็นปี พ.ศ.
                autoclose: true
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script>
<!--
                <script>
            $(function () {

                //Date picker
                $('.datepicker').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true
                });

            });
                      
        </script>
-->
    <script>
        $(function() {
            $('#tb-approve').DataTable({
                "responsive":true,
                 "paging":   false,
            " ordering": false,
            "info":     false
            })
        });

    </script>

</body>

</html>
