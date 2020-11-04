<?php
//Thank: https://www.w3schools.com/php/php_mysql_insert.asp
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
//Get data from user
$userID = $_GET['name'];
$deviceID = $_GET['password'];

if(empty($name) || empty($pass)){
    die("Please enter name and password!");
}
//Add data to table
$sql = "INSERT INTO user_login_test (id, name, password) VALUES (NULL, '$name', '$pass')";
//Check result
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>