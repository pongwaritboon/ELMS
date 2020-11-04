<?php
require("config/db.php");

require('function.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Device Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<?php include("script/css_script.php")?>
	
</head>
  
<body>
	<h2>รายการอุปกรณ์</h2>
	<table class="table">
		<?php
			
//			if($room_id == 'all'){
//				
//				$sql = "SELECT events.id,fullname,room_name,title,DATE(start_date) as start_date,DATE(end_date) as end_date,TIME_FORMAT(start_date, '%h:%i') as start_time,TIME_FORMAT(end_date, '%h:%i')  as end_time,detail,person_use,events.status FROM events
//				INNER JOIN room ON room.id = events.room_id 
//				INNER JOIN user ON user.id = events.user_id WHERE DATE(start_date) BETWEEN '$start_date' AND '$end_date' ORDER BY start_date,start_time ASC";
//
//			}else{
//				$sql = "SELECT events.id,fullname,room_name,title,DATE(start_date) as start_date,DATE(end_date) as end_date,TIME_FORMAT(start_date, '%h:%i') as start_time,TIME_FORMAT(end_date, '%h:%i')  as end_time,detail,person_use,events.status FROM events
//				INNER JOIN room ON room.id = events.room_id 
//				INNER JOIN user ON user.id = events.user_id  WHERE DATE(start_date) BETWEEN '$start_date' AND '$end_date' AND events.room_id = $room_id ORDER BY start_date,start_time ASC";
//			}
				$sql = "SELECT * FROM device";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				echo "<thead>";
					echo "<tr class='active'>";

						echo "<th width='15%'>รหัสอุปกรณ์</th>";
						echo "<th width='15%'>QRCODE</th>";
						echo "<th width='20%'>รูปภาพอุปกรณ์</th>";
						echo "<th width='20%'>ชื่ออุปกรณ์</th>";
						echo "<th width='20%'>หมวดหมู่</th>";
//						echo "<th width='10%'>สถานะ</th>";
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
								
				$i = 1;
				while($row = mysqli_fetch_assoc($result)) {
					
					echo "<tr>";
						
						echo "<td>".$row['itemID']."</td>";
                        $alltext = "รหัสอุปกรณ์: ".$row['itemID']." ชื่ออุปกรณ์: ".$row['device_name']."";
						echo "<td><img src='phpqrcode/gencode.php?name=".$alltext.">' class='img-thumbnail' width='180' height='150'></td>";
						echo "<td><img src='uploads/".$row['device_image']."' class='img-thumbnail' width='180' height='150'></td>";
						echo "<td>".$row['device_name']."</td>";
						echo "<td>".$row['device_detail']."</td>";
						//echo "<td>".eventStatusName($row['status'])."</td>";
					echo "</tr>";
					
					$i++;
				}
				
			} else {
				echo "ไม่พบข้อมูล";
			}

			mysqli_close($conn);
		?>
		</tbody>
	</table>	
</body>
</html>
