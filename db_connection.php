<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "follower_db";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>