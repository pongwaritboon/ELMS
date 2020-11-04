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

$category = $_GET["category"];

$sql = "SELECT itemID, itemName, imagePath, status, note FROM item WHERE category='".$category."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
} else {
    echo "{\"result\" : \"no data found\"}";
}

echo json_encode($array);

$conn->close();
?>