<?php 
//header("content-type: application/x-javascript; charset=TIS-620");
    // require("function.php");

 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "elms");  
$connect->set_charset("utf8");
 if(isset($_POST["transactionID"]))  
 {  
      $query = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.pickup_date,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            WHERE transaction.status = 3 AND transaction.transactionID = '".$_POST["transactionID"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      
     //$json_array = json_encode($row, JSON_UNESCAPED_UNICODE);
  echo json_encode($row, JSON_UNESCAPED_UNICODE);
     //echo $json_array;
 }  
 ?>
