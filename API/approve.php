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
$transactionID = $_GET["transactionID"];

$sql = "UPDATE transaction SET status='1' WHERE $transactionID='".$transactionID."' AND status='0'";


    if ($conn->query($sql) === TRUE) {
        echo "{\"result\" : \"Success\"}";
    }else {
        echo "{\"result\" : \"failed\"}";
    }

$sql = "SELECT transactionID, deviceID,userID,comment,status FROM transaction"; //"SELECT ชื่อคอลัมป์ 1, ชื่อคอลัมป์ 2, ชื่อคอลัมป์ 3 FROM ชื่อตาราง"
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
$conn->close();
?>


