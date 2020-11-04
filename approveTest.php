<?php
//date_default_timezone_set("Asia/Bangkok");
//header("content-type: application/x-javascript; charset=TIS-620");
require("config/db.php");

require("phpqrcode/qrlib.php");

require("function.php");
//header("content-type: application/x-javascript; charset=TIS-620");
checkAuthAdmin();
 
//index.php
//$connect = mysqli_connect("localhost", "root", "", "elms");
 $sql = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction 
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            WHERE transaction.status = 1 ";
//$result = mysqli_query($connect, $query);
$result = $conn->query($sql);	
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
<!--   <meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
<!--   <meta http-equiv="content-type" content="text/html; charset=TIS-620" />-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Approve List Test</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php include("script/css_script.php")?>
    
    <!-- DataTables -->
<!--    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">-->
     <!-- bootstrap datepicker -->
<!--        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">-->
       
        
    <!--Sweet Alert-->
<!--    <meta property="og:url" content="http://lipis.github.io/bootstrap-sweetalert/" />-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  -->


<!--    <meta property="og:image" content="http://lipis.github.io/bootstrap-social/assets/bootstrap-sweetalert.png" />-->
    

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
<!--                        <div class="table-responsive">-->
                            <table class="table table-bordered table-responsive" id="tb-approve">
                                <thead>
                                    <tr class="active">
<!--                                        <th scope="col" width="5%">#</th>-->
                                        <th scope="col" width="10%">รหัสคำร้องการยืม</th>
                                        <th scope="col" width="10%">รหัสอุปกรณ์</th>
                                        <th scope="col" width="10%">ชื่ออุปกรณ์</th>
                                        <th scope="col" width="10%">ชื่อผู้ยืม</th>            
                                        <th scope="col" width="15%">วันที่และเวลายื่นคำร้อง</th>
                                        <th scope="col" width="10%">เหตุผลที่ยืม</th>
                                        <th scope="col" width="10%">สถานะ</th>
                                        <th scope="col" width="5%"></th>
                                        <th scope="col" width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
<!--
                                  <tr>
                                        
                                
                                  </tr>
-->
                            <?php
                                  while($row = $result->fetch_assoc()) {
                                    $i = 0;
                                  ?>
                                  <tr>
<!--                                  <td><?php //echo $; ?></td>-->
                                   <td><?php echo $row['transactionID'] ; ?></td>

                                   <td><?php echo $row['itemID'] ; ?></td>
                                   <td><?php echo $row['device_name'] ?></td>
                                   <td><?php echo $row['firstname']." ".$row['surname']; ?></td>
                                   <td><?php echo dateTimeThai($row['request_date']); ?></td>
                                   <td><?php echo $row['user_comment']; ?></td>
                                   <td><?php 
                                      if($row['status']  == 1){
                                          $status = "รอการอนุมัติ";
                                        }
                                      echo $status; ?></td>
                                       
                                        <td><input type="button" name="edit" value="อนุมัติ" id="<?php echo $row["transactionID"]; ?>" class="btn btn-success approveBtn" /></td>
<!--                                      <td><button type=button class="btn btn-success approveBtn">อนุมัติ</button></td>-->
                                      <td><input type="button" name="notApprove" value="ไม่อนุมัติ" id="<?php echo $row["transactionID"]; ?>" class="btn btn-danger notapproveBtn" /></td>
                                   <!--<td><input type="button" name="view" value="อนุมัติ" id="<?php //echo $row['transactionID']; ?>" class="btn btn-info btn-xs approve_data" /></td>-->
<!--                                   <td><input type="button" name="view" value="ไม่อนุมัติ" id="<?php// echo $row['transactionID']; ?>" class="btn btn-info btn-xs notApprove_data" /></td>-->
                                  </tr>
                                  <?php
                                    }
                            ?>
<!--
 
-->
                                      <!-- ########################  Approve Pop UP #########################-->
                                    <div id="approveModal" class="modal fade">  
                                          <div class="modal-dialog">  
                                           <div class="modal-content">  
                                                <div class="modal-header">  
                                                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                                     <h4 class="modal-title">อนุมัติคำร้องการยืมอุปกรณ์</h4>  
                                                </div>  
                                                <div class="modal-body">  
                                                      <form  method="POST" id="insert_form">
                                                <div class="form-group">
                                                    <label >รหัสคำร้องการยืม</label>
                                                    <input type="text" name="tID" id="tID"  class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >รหัสอุปกรณ์</label>
                                                    <input type="text" name="deviceID" id="deviceID" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >ชื่ออุปกรณ์</label>
                                                    <input type="text" name="deviceName" id="deviceName" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >ชื่อผู้ยืม</label>
                                                    <input type="text" name="firstName" id="firstName" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >วันที่และเวลาการยื่นคำร้อง</label>
                                                    <input type="text" name="tRequest" id="tRequest" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >เหตุผลที่ยืม</label>
                                                    <input type="text" name="userReason" id="userReason" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >สถานะ</label>
                                                    <input type="text" name="status"  id="status" class="form-control" disabled>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                         <div class="form-group">
                                                    <?php $date = date("Y-m-d");
                                                    //$date = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$date))); ?>
                                                    <label >วันที่นัดรับอุปกรณ์</label>
                                                <input type="text"  class="form-control datepicker" name="pickup_date" id="pickup_date" value="<?php echo $date;?>">

                                                        </div>
                                                    </div>
                                                </div>



                                                              <div class="row">
                                                              <div class="col-md-12 text-right">
                                                  <input type="hidden" name="transactionID" id="transactionID" />
                                                  <input type="hidden" name="itemID" id="itemID" />   
                                                  <input type="submit" name="insert" id="insert" value="อนุมัติ" class="btn btn-success " />  
                                                  </div>
                                                   </div>
                                             </form>  
                                        </div>  
                        <!--
                                        <div class="modal-footer">  
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                        </div>  
                        -->
                                   </div>  
                              </div>  
                         </div>  

                                <!--   Not Approve Pop UP-->
                                     <div id="notapproveModal" class="modal fade">  
                                              <div class="modal-dialog">  
                                                   <div class="modal-content">  
                                                        <div class="modal-header">  
                                                             <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                                             <h4 class="modal-title">ไม่อนุมัติคำร้องการยืมอุปกรณ์</h4>  
                                                        </div>  
                                                        <div class="modal-body">  
                                                              <form  method="POST" id="insert_form1">
                                           
        <!--
                                                    <label>เหตุผลที่ไม่อนุมัติ</label>
                                                     <input type="text" name="age" id="age" class="form-control" />
        -->
                                                <div class="form-group">
                                                    <label >รหัสคำร้องการยืม</label>
                                                    <input type="text" name="tID2" id="tID2"  class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >รหัสอุปกรณ์</label>
                                                    <input type="text" name="deviceID2" id="deviceID2" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >ชื่ออุปกรณ์</label>
                                                    <input type="text" name="deviceName2" id="deviceName2" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >ชื่อผู้ยืม</label>
                                                    <input type="text" name="firstName2" id="firstName2" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >วันที่และเวลาการยื่นคำร้อง</label>
                                                    <input type="text" name="tRequest2" id="tRequest2" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >เหตุผลที่ยืม</label>
                                                    <input type="text" name="userReason2" id="userReason2" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label >สถานะ</label>
                                                    <input type="text" name="status2"  id="status2" class="form-control" disabled>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                         <div class="form-group">
                                                    <label>เหตุผลที่ไม่อนมุัติ</label>
                                                <textarea rows="3"class="form-control" name="reason" id="reason" value=""></textarea>

                                                        </div>
                                                    </div>
                                                </div>
                                              


                                <div class="row">
                                                              <div class="col-md-12 text-right">
                                                  <input type="hidden" name="transactionID1" id="transactionID1" />  
                                                  <input type="submit" name="insert1" id="insert1" value="ไม่อนุมัติ" class="btn btn-danger " />  
                                                  </div>
                                                   </div>

                                         </form>  
                                    </div>  
                    <!--
                                    <div class="modal-footer">  
                                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                    </div>  
                    -->
                               </div>  
                          </div>  
                     </div>  
                
                                    
                                    
                                </tbody>
                            </table>
<!--                        </div>-->
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
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
-->
   <!-- bootstrap datepicker -->
<!--        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>-->
                                <!-- bootstrap datepicker thai-->
<!--        <script src="bootstrap-datepicker-custom/jquery-2.1.3.min.js"></script>-->
       
<!--
        <link href="bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js"></script>
        <script src="bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
-->
        
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<!--
               bootstrap datepicker 
        <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
-->
                                <!-- bootstrap datepicker thai-->
<!--        <script src="bootstrap-datepicker-custom/jquery-2.1.3.min.js"></script>-->
        <link href="bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <script src="bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js"></script>
        <script src="bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

       <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                //format: 'dd-mm-yyyy',
                format: 'yyyy-mm-dd',
                //todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                //thaiyear: true ,             //Set เป็นปี พ.ศ.
                autoclose: true
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script> 
       <script>

        $(document).ready(function(){  
           $(document).on('click', '.approveBtn', function(){  
           var transactionID = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{transactionID:transactionID},
                
                dataType:"json",  
               //contentType: "application/json; charset=utf-8",
               //contentType: "application/json;charset=utf-8",
                success:function(data){
                     //console.log("DATA : "+JSON.stringify(data));
                    
                        for (var prop in data) {
                            console.log(prop + " = " + data[prop]);
                        }
                     var date = new Date();
                    console.log("Date : "+ date);
                     $('#tID').val(data.transactionID);  
                     $('#deviceID').val(data.itemID);  
                     $('#deviceName').val(data.device_name);
                     //data.firstname= encodeURI(data.firstname);
                    //data.firstname = decodeURIComponent(escape(data.firstname));
                    //console.log("Firstname : "+data.firstname);
                    //console.log("Lastname : "+data.surname);
                     $('#firstName').val(data.firstname+" "+data.surname);
                    
                    $('#tRequest').val(data.request_date);
                    $('#userReason').val(data.user_comment);
                    if(data.status == 1){
                        data.status = "รอการอนุมัติ";
                    }
//                    console.log(data.username);
//                    console.log(data.firstname);
                    $('#status').val(data.status);
                    // $('#age').val(data.age);  
                    $('#transactionID').val(data.transactionID);  
                     $('#insert').val("อนุมัติ");  
                     $('#approveModal').modal('show');
                    //alert(data.firstname+data.itemID);
                    alert("Approve Modal");
                    }  
                });  
           });
            $(document).on('click', '.notapproveBtn', function(){  
           var transactionID = $(this).attr("id");  
           $.ajax({  
                url:"fetch1.php",  
                method:"POST",  
                data:{transactionID:transactionID},
                
                dataType:"json",  
               //contentType: "application/json; charset=utf-8",
               //contentType: "application/json;charset=utf-8",
                success:function(data){ 
//                    var num = 1452254400;
//                    var ymd = new Date(data.request_date).toJSON();
//                    console.log("Datetime : "+ data.request_date);
//                    console.log("ymd : "+ymd);
                    var date = new Date(data.request_date);
                    console.log(date);
                    console.log(date.getDate());
                     $('#tID2').val(data.transactionID);  
                     $('#deviceID2').val(data.itemID);  
                     $('#deviceName2').val(data.device_name);
                    $('#itemID').val(data.itemID);  
                     //data.firstname= encodeURI(data.firstname);
                    //data.firstname = decodeURIComponent(escape(data.firstname));
                    console.log("Firstname : "+data.firstname);
                    console.log("Lastname : "+data.surname);
                     $('#firstName2').val(data.firstname+" "+data.surname);
                    var month;
                    var min = date.getMinutes();
                    var day;
                   if(date.getMonth()+1 == 1){
                       month = "มกราคม"; }else if(date.getMonth()+1 == 2){
                       month = "กุมภาพันธ์"; }else if(date.getMonth()+1 == 3){
                       month = "มีนาคม"; }else if(date.getMonth()+1 == 4){
                       month = "เมษายน"; }else if(date.getMonth()+1 == 5){
                       month = "พฤษภาคม";}else if(date.getMonth()+1 == 6){
                       month = "มิถุนายน";}else if(date.getMonth()+1 == 7){
                       month = "กรกฏาคม"; }else if(date.getMonth()+1 == 8){
                       month = "สิงหาคม"; }else if(date.getMonth()+1 == 9){
                       month = "กันยายน"; }else if(date.getMonth()+1 == 10){
                       month = "ตุลาคม"; }else if(date.getMonth()+1 == 11){
                       month = "พฤศจิกายน"; }else if(date.getMonth()+1 == 12){
                       month = "ธันวามคม"; }
                     // 00 format days
//                    if(date.getDate() < 10){
//                       day = "0"+date.getDate();
//                   }
//                    console.log("day format : " + date.getDate());
                    // 00 format minutes
                    if(min< 10){
                       min = "0"+min;
                   }
                   // $('#tRequest2').val(data.request_date);
                    $('#tRequest2').val(date.getDate()+" "+month+" "+date.getFullYear()+" เวลา "+date.getHours()+":"+min+" น.");
                    $('#userReason2').val(data.user_comment);
                    if(data.status == 1){
                        data.status = "รอการอนุมัติ";
                    }
//                    console.log(data.username);
//                    console.log(data.firstname);
                    $('#status2').val(data.status);
                    // $('#age').val(data.age);  
                     $('#transactionID1').val(data.transactionID);  
                     $('#insert1').val("ไม่อนุมัติ");  
                     $('#notapproveModal').modal('show');
                    //alert(data.firstname+data.itemID);
                    console.log("Not Approve Modal");
                    //  alert("เสร็จสิ้นการไม่อนุมัติ");
                    
                    }  
                });  
           });
                $('#insert_form').on("submit", function(event){  
                           event.preventDefault();  
                            if($('#pickup_date').val() == "")  
                             {  
                                alert("กรุณาใส่วันที่นัดรับอุปกรณ์");  
                             }else{
                                $.ajax({  
                                     url:"insert.php",  
                                     method:"POST",  
                                     data:$('#insert_form').serialize(),  
                                     beforeSend:function(){  
                                          $('#insert').val("Inserting"); 
                                          //alert(data.pickup_date);
                                     },  
                                     success:function(data){ 
                                         console.log("UPDATE SUCCESS");
                                          $('#insert_form')[0].reset();  
                                          $('#approveModal').modal('hide');  
                                          //$('#employee_table').html(data);  
                                         window.location.href = "checkoutitem.php";
                                         alert("คุณได้อนุมัติรายการยืมเสร็จสิ้น");
                                     }  
                                });  
                             }
                      });
               $('#insert_form1').on("submit", function(event){  
                           event.preventDefault();  
                             if($('#reason').val() == "")  
                             {  
                                alert("กรุณาใส่เหตุผลที่ไม่อนุมัติคำร้อง");  
                             }else{
                                $.ajax({  
                                     url:"insert1.php",  
                                     method:"POST",  
                                     data:$('#insert_form1').serialize(),  
                                     beforeSend:function(){  
                                          $('#insert1').val("Inserting"); 
                                          //alert(data.pickup_date);
                                     },  
                                     success:function(data){ 
                                         console.log("UPDATE SUCCESS");
                                          $('#insert_form1')[0].reset();  
                                          $('#notapproveModal').modal('hide');  
                                          //$('#employee_table').html(data); 
                                         alert("เสร็จสิ้นการไม่อนุมัติ");
                                         window.location.href = "history.php";
                                     }  
                                });  
                            }
                      }); 

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
<!--
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
-->

</body>

</html>


