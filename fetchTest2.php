<?php 
//header("content-type: application/x-javascript; charset=TIS-620");
    require("function.php");

 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "elms");
$connect->set_charset("utf8");
// if(isset($_POST["transactionID"]))  
// {  
      $query = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.borrowed_date,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            WHERE transaction.status = 1 ";  
      $result = mysqli_query($connect, $query);  
      //$row = mysqli_fetch_array($result);  
      //$row['request_date'] = dateTimeThai($row['request_date]');
     //$json_array = json_encode($row, JSON_UNESCAPED_UNICODE);
     
//     $myArray = array();
//     if ($result->num_rows > 0) {
    // output data of each row
     $intNumField = mysqli_num_fields($result);
    while($row = mysqli_fetch_array($result)) {
        //array_push($myArray, $row); //Add object to array
        $arrCol = array();
        
		for($i=0;$i<$intNumField;$i++)
		{
                //mysqli_fetch_field_direct($result, $i)
			//$arrCol[mysql_field_name($result,$i)] = $row[$i];
            $arrCol[mysqli_fetch_field_direct($result, $i)] = $row[$i];
		}
		array_push($resultArray,$arrCol);
    }
      echo json_encode($resultArray, JSON_UNESCAPED_UNICODE);
//} 
     //$json_array = json_encode($myArray, JSON_UNESCAPED_UNICODE);
    // echo $json_array;
     //echo json_encode($myArray, JSON_UNESCAPED_UNICODE);
 // echo json_encode($row, JSON_UNESCAPED_UNICODE);
     //echo $json_array;
 //}  
 ?>
 
<!--
$result = $conn->query($sql);
$myArray = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($myArray, $row); //Add object to array
    }
}
$json_array = json_encode($myArray);
echo $json_array;
$conn->close(); -->




<!--
$strSQL = "SELECT * FROM device  ";

	$objQuery = mysql_query($strSQL);
	$intNumField = mysql_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysql_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	
	mysql_close($objConnect);
	
	echo json_encode($resultArray);-->
