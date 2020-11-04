<?php
//เรียกไฟล์ db.php สำหรับเชื่อมต่อฐานข้อมูล
require('config/db.php');

require("function.php");

checkAuthAdmin();

if($_GET['id']){
	
	$id = $_GET['id'];
	
//DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';

        
    $sql = "DELETE FROM device WHERE itemID=$id";

	if (mysqli_query($conn, $sql)) {
		
		header("location:device_management.php?msg=danger");

	} else {
		
		echo "Error deleting record: " . mysqli_error($conn);
	}
	
}
?>
