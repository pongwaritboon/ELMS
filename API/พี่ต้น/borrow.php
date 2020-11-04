<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemID = $_GET["itemID"];
$userID = $_GET["userID"];

$sql = "UPDATE item SET status='1' WHERE itemID='".$itemID."' AND status='0'";

if ($conn->query($sql) === TRUE) {
	if(mysqli_affected_rows($conn) > 0){
		$sql = "INSERT INTO activity (activityID, itemID, borrower, lender, status, datetime) 
		VALUES (null, '".$itemID."', '".$userID."', '0', '1', '".date('Y-m-d H:i:s')."')";
			if ($conn->query($sql) === TRUE) {
				echo "{\"result\" : \"Success\"}";
			} else {
				//restore to previous version
				$sql = "UPDATE item SET status='0' WHERE itemID='".$itemID."'";
				if ($conn->query($sql) === TRUE){
					echo "{\"result\" : \"restore to previous version\"}";
				}
			}
	}
	else{
		echo "{\"result\" : \"no change\"}";
	}
} else {
    echo "{\"result\" : \"failed\"}";
}

$conn->close();
?>