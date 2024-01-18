<?php
session_start();

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบว่ามีพารามิเตอร์ user_id ที่ถูกส่งมาหรือไม่
if (isset($_GET["user_id"])) {
    $followUserId = $_GET["user_id"];

    // เชื่อมต่อกับฐานข้อมูล
    include("db_connection.php");

    // เพิ่มข้อมูลการติดตามลงในตาราง followers
    $currentUserId = $_SESSION["user_id"];
    $query = "INSERT INTO followers (user_id, follower_user_id) VALUES ($followUserId, $currentUserId)";
    mysqli_query($conn, $query);

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);

    // Redirect กลับไปที่หน้า Dashboard
    header("Location: dashboard.php");
    exit();
} else {
    // ถ้าไม่มี user_id ที่ถูกส่งมา
    echo "Invalid user_id";
}
?>