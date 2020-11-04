<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO transaction (transactionID,username, itemID, user_comment, status,request_date)
VALUES (10002,'ballstripz', '1','402', '1','2563-04-10 12:00:00');";
//$sql .= "INSERT INTO log (status, updateTime)
//VALUES ('1', '2563-03-10 12:10:00');";
//$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
//VALUES ('Julie', 'Dooley', 'julie@example.com')";
//$sql2 = "INSERT INTO log (transactionID,status, updateTime)
//VALUES (10000,'1', '2563-04-03 12:00:00');";
if ($conn->query($sql) === TRUE) {
   // if ($conn->multi_query($sql2) === TRUE) {
    echo "New transaction records created successfully";
   // }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 