
   <?php
//header("content-type:application/json; charset=utf-8");
require("function.php");
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "elms");  
$connect->set_charset("utf8");
// if(isset($_POST["transactionID"]))  
// {  
//       $query = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.borrowed_date,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction
//                                            INNER JOIN device ON transaction.itemID = device.itemID
//                                            JOIN userinfo ON transaction.username = userinfo.username
//                                            WHERE transaction.status = 1 AND transaction.transactionID = '".$_POST["transactionID"]."'"; 

       $query = "SELECT transaction.transactionID,transaction.itemID,transaction.username,transaction.status,transaction.user_comment,transaction.request_date,device.itemID,device.device_name,userinfo.username,userinfo.firstname,userinfo.surname FROM transaction
                                            INNER JOIN device ON transaction.itemID = device.itemID
                                            JOIN userinfo ON transaction.username = userinfo.username
                                            "; 
//        $query = "SELECT * FROM transaction";
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result); 
     
     $myArray = array();
//     $row['request_date'] = dateTimeThai($row['request_date']);
if ($result->num_rows > 0) {
     //output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($myArray, $row); //Add object to array
    }
//array_push($myArray,$row['transactionID']);
//array_push($myArray,$row['username']);
//    array_push($myArray,$row['request_date']);
} 
$json_array = json_encode($myArray, JSON_UNESCAPED_UNICODE);
//json_encode( $arr, JSON_UNESCAPED_UNICODE );
echo $json_array;
     // echo json_encode($row);  
//}  
 ?>
 