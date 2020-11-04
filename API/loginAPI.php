<?php
$servername = "localhost"; //ใช้ localhost กรณี server อยู่บน online 
$username = "root"; //username ของ DirectAdmin/phpMyAdmin 
$password = ""; //password ของ DirectAdmin/phpMyAdmin 
$dbname = "room"; //ชื่อ database
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id, device_name, device_detail FROM device"; //"SELECT ชื่อคอลัมป์ 1, ชื่อคอลัมป์ 2, ชื่อคอลัมป์ 3 FROM ชื่อตาราง"
$result = $conn->query($sql);
$myArray = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($myArray, $row); //Add object to array
    }
} 
$json_array = json_encode($myArray); //Convert array to JSON
echo $json_array;
$conn->close(); //ปิดการเชื่อมต่อ
?>