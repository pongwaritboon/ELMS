<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "room";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$deviceID = $_GET["deviceID"];
$userID = $_GET["userID"];
$text = "";

$sql = "INSERT INTO transaction (transactionID, deviceID, userID,comment, status) 
	VALUES (null, '".$deviceID."', '".$userID."','".$text."' ,'0')";

    if ($conn->query($sql) === TRUE) {
        echo "{\"result\" : \"Success\"}";
    }else {
    echo "{\"result\" : \"failed\"}";
}
$conn->close();
?>