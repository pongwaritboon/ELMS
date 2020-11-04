<?php
require("config/db.php");

require("function.php");

checkAuthAdmin();


//$borrowDate = $_GET['borrow_date'];
 $id = $_GET['id'];


$itemID = $_GET["itemID"];
//$borrower = $_GET["borrower"];
//$lender = $_GET["lender"];
$returnDate = dateThaiReturn($borrowDate);
$sql = "UPDATE transaction SET status='0' WHERE itemID='".$itemID."' AND transactionID ='".$id."'";

//if ($conn->multi_query($sql) === TRUE) {
//	if(mysqli_affected_rows($conn) > 0){
		//INSERT to activity
//		$sql = "INSERT INTO activity (activityID, itemID, borrower, lender, status, datetime) 
//		VALUES (null, '".$itemID."', '".$borrower."', '".$lender."', '2', '".date('Y-m-d H:i:s')."')";
       // $sql = "UPDATE transaction SET status='2',borrowed_date = '".$borrowDate."',returned_date = '".$returnDate."' WHERE transactionID='".$id."' AND status='1'";
			if ($conn->query($sql) === TRUE) {
				//echo "{\"result\" : \"Success\"}";
                header("location:history.php");
			} else {
				//restore to previous version
				//$sql = "UPDATE item SET status='1' WHERE itemID='".$itemID."'";
				if ($conn->query($sql) === TRUE){
					echo "{\"result\" : \"restore to previous version\"}";
				}
			}
//	}
//	else{
//		echo "{\"result\" : \"no change\"}";
//	}
//} else {
//    echo "{\"result\" : \"failed\"}";
//}  
//        $sql = "INSERT INTO log (transactionID, status, updateTime)
//        VALUES ( $id,  '2', '$now')";
//        $sql .= "INSERT INTO transaction (returned_date)
//        VALUES ('$returnDate')";
//	
//        if ($conn->query($sql) === TRUE) {
//            header("location:history.php");
//        }else {
//			echo "Error updating record: " . mysqli_error($conn);
////			exit();
//		
//		
//        }
//		$sql = "UPDATE transaction SET status=2 AND returned_date = $returnDate WHERE transactionID =  $id ";
//        
//        if ($conn->query($sql) === TRUE) {
//	if(mysqli_affected_rows($conn) > 0){
////		if (mysqli_query($conn, $sql)) {
////			$sql2 = "INSERT INTO log (transactionID,status,updateTime)
////        VALUES ('".$id."' '2','2563-03-10 12:10:00');";
////			if (mysqli_query($conn, $sql2)) {
//      //  if ($conn->query($sql2) === TRUE) {
//				header("location:checkoutitem.php");
//   //         }
//
//		}} else {
//			echo "Error updating record: " . mysqli_error($conn);
//			exit();
//		
//		
//        }
$conn->close();	
?>