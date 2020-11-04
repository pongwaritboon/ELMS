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

$username = $_GET["username"];
$password = $_GET["password"];

$sql = "SELECT role FROM userinfo WHERE username='".$username."' and password='".$password."'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "{\"result\" : \"success\", \"role\" : \"".$row["role"]."\"}";
    }
} else {
    echo "{\"result\" : \"failed\"}";
}
$conn->close();
?>