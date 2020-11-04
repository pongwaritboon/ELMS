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
$borrower = $_GET["borrower"];
$lender = $_GET["lender"];

$sql = "UPDATE item SET status='2' WHERE itemID='".$itemID."' AND status='1'";

if ($conn->query($sql) === TRUE) {
	if(mysqli_affected_rows($conn) > 0){
		//INSERT to activity
		$sql = "INSERT INTO activity (activityID, itemID, borrower, lender, status, datetime) 
		VALUES (null, '".$itemID."', '".$borrower."', '".$lender."', '2', '".date('Y-m-d H:i:s')."')";
			if ($conn->query($sql) === TRUE) {
				echo "{\"result\" : \"Success\"}";
			} else {
				//restore to previous version
				$sql = "UPDATE item SET status='1' WHERE itemID='".$itemID."'";
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