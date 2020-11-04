<?php
//ini_set('display_errors', 1);

error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "elms";

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password,$db_name);

//กำหนด charset ให้เป็น utf8 เพื่อรองรับภาษาไทย
mysqli_set_charset($conn,"utf8");

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
	//กรณีเชื่อมต่อไม่ได้
    die("Connection failed: " . mysqli_connect_error());
}
?>