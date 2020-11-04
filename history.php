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
    <title>Loan History</title>
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
						<i class="fa fa-book"></i> <span>อุปกรณ์ที่กำลังถููกยืม</span>
						</a>
					</li>
					<li class=" active">
						<a href="checkoutitem.php">
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
                        <h2 style="font-size: 30px;" class="box-title">ประวัติการยืม-คืนอุปกรณ์</h2>
                    </div>
                    <div class="box-body">

                        <p>
<!--                            <a href="device_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> เพิ่มอุปกรณ์</a>-->
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tb-device">
                                <thead>
                                    <tr class="active">
<!--                                     <th scope="col" width="5%">#</th>-->
                                        <th scope="col" width="5%">รหัสคำร้องการยืม</th>
                                         <th scope="col" width="10%">ชื่อผู้ยืม</th>
                                         <th scope="col" width="5%">รหัสอุปกรณ์</th>
                                        <th scope="col" width="5%">ชื่ออุปกรณ์</th> 
                                        <th scope="col" width="5%">วันที่ยืม</th>
                                        <th scope="col" width="5%">วันที่กำหนดคืนอุปกรณ์</th>
                                        <th scope="col" width="5%">วันที่คืน</th>
                                          <th scope="col" width="5%">สถานะ</th> 
<!--                                        <th scope="col" width="5%"></th>-->
<!--                                        <th scope="col" width="5%"></th>-->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $sql = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.pickup_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname
                                 ,userinfo.surname,DATE(transaction.pickup_date) as b_date,DATE(transaction.returned_date) as r_date FROM transaction
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            WHERE transaction.status = 4 OR transaction.status = 0";
                                                                  //  JOIN log ON transaction.transactionID = log.transactionID
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        $i=1;
                                        while($row = $result->fetch_assoc()) {
                                            if($row['status'] == 4){
                                                $transaction_status = 'คืนอุปกรณ์แล้ว';
                                            }else if($row['status'] == 0){
                                                $transaction_status = 'ไม่อนุมัติ';
                                            }
//                                                else if($row['status'] == 2){
//                                                $transaction_status = 'รอการนำออกอุปกรณ์';
//                                            }else if($row['status'] == 3){
//                                                $transaction_status = 'อยู่ในระหว่างยืม';
//                                            }else if($row['status'] == 0){
//                                                $transaction_status = 'ไม่อนุมัติ';
//                                            }else if($row['status'] == 5){
//                                                $transaction_status = 'ยืมเกินเวลาที่หนด';
//                                            }
                                            echo "<tr>";
                                            //echo "<td scope='row'>".$i."</td>";
                                            echo "<td scope='row'>".$row['transactionID']."</td>";
                                            echo "<td scope='row'>".$row['firstname']."   ".$row['surname']."</td>";
                                            echo "<td scope='row'>".$row['itemID']."</td>";
                                            echo "<td scope='row'>".$row['device_name']."</td>";
                                            	if(!empty($row['b_date'])){
									           echo "<td scope='row'>".dateThai($row['b_date'])."</td>";
								            }else{
									           echo "<td>-</td>";
                                                }
                                            if(!empty($row['r_date'])){
									           echo "<td scope='row'>".dateThaiReturn($row['b_date'])."</td>";
								            }else{
									           echo "<td>-</td>";
                                                }
                                            if(!empty($row['r_date'])){
									           echo "<td scope='row'>".dateThai($row['r_date'])."</td>";
								            }else{
									           echo "<td>-</td>";
                                                }
                                           // echo "<td scope='row'>".dateThai($row['b_date'])."</td>";
                                            //echo "<td scope='row'>".dateThai($row['r_date'])."</td>";
                                           // echo "<td scope='row'>".dateThai($row['r_date'])."</td>";
//                                            echo "<td scope='row'>".$row['comment']."</td>";
                                            //เทียบวันที่คืน กับ วันที่กำหนดคืน
                                            //if(compare)
                                            echo "<td scope='row'>".$transaction_status."</td>";
                                           // echo "<td><a href='approveUpdate.php?id=".$row['transactionID']."' class='btn btn-success btn-sm'>อนุมัติ</a></td>";
                                         
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
                                                echo "  </form>";
                                             echo " </div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<a href='approveUpdate.php?id=".$row['transactionID']."' onclick='return confirm(\"คุณต้องการอนุมัติใช่หรือไม่\");'><button type='button' class='btn btn-primary'>อนุมัติ</button></a>";
                                           
                                             echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            
                                               // <!-- Not Approve Modal -->
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
                                                echo "  </form>";
                                             echo " </div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<a href='notapproveUpdate.php?id=".$row['transactionID']."' onclick='return confirm(\"คุณต้องการไม่อนุมัติใช่หรือไม่\");'><button type='button' class='btn btn-primary'>ไม่อนุมัติ</button></a>";
                                           
                                             echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            echo " </div>";
                                            echo "</tr>";
                                            $i++;
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();              ?>
                                    
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
            $('#t-device').DataTable({
                 "paging":   false,
            " ordering": false,
            "info":     false
            })
        });

    </script>

</body>

</html>
