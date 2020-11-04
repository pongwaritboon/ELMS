<?php
require("config/db.php");

require("function.php");

checkAuthAdmin();


//$borrowDate = $_GET['borrow_date'];
 $userID = $_GET['user'];


$itemID = $_GET["itemID"];
$msg = $_GET["msg"];
$sql = "INSERT INTO `notification` (`notiID`, `username`, `itemID`, `text`, `readStatus`) VALUES
            (NULL, ' $userID','$itemID','$msg', '0')";

	if (mysqli_query($conn, $sql)) {
		
		
			header("location:borrowing.php");
	
		
	} else {
		
		//กรณีเกิดข้อผิดพลาด
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
$conn->close();	
?>