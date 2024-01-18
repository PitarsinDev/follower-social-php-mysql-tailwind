<?php
session_start();

// ตรวจสอบการเข้าสู่ระบบ
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// เชื่อมต่อกับฐานข้อมูล
include("db_connection.php");

// ดึงข้อมูลผู้ใช้ทั้งหมด (ยกเว้นตัวเอง)
$currentUserId = $_SESSION["user_id"];
$query = "SELECT * FROM users WHERE user_id <> $currentUserId";
$result = mysqli_query($conn, $query);

    echo "<div class='flex justify-center'>";
    echo "<div class='p-5'>";
    echo "<h2 class='text-3xl text-orange-500'>Dash<span class='text-blue-500'> board</span></h2>";
    echo "<div class='bg-blue-500 w-7 h-1 rounded-full'></div>";
    echo "</div>";
    echo "</div>";

    echo "<h2 class='text-center'>";
    echo "<span class='text-blue-500'>Welcome User ID :</span> " . $_SESSION["user_id"];
    echo "<h2>";


while ($user = mysqli_fetch_assoc($result)) {
    $userId = $user['user_id'];

    // ดึงข้อมูลจำนวนผู้ติดตาม
    $followerQuery = "SELECT COUNT(*) AS follower_count FROM followers WHERE user_id = $userId";
    $followerResult = mysqli_query($conn, $followerQuery);
    $followerData = mysqli_fetch_assoc($followerResult);
    $followerCount = $followerData['follower_count'];

    echo "<div class='flex justify-center py-5'>";
    echo "<div class='border p-2 rounded-md shadow-md'>";
    echo "<div class='flex justify-center'>";
    echo "<img src='./img/3135715.png' class='w-16'></img>";
    echo "</div>";
    echo "<div class='py-2'>";
    echo "<p class='text-center text-lg'>{$user['username']}</p>";
    echo "</div>";
    echo "<div class='flex justify-center'>";
    echo "<p class='text-zinc-500'><span class='text-blue-500'>$followerCount</span> Follower</p>";
    echo "</div>";
    echo "<div class='flex justify-center pt-2'>";
    echo "<a href='follow.php?user_id={$user['user_id']}' class='bg-blue-200 text-blue-500 shadow-sm px-10 rounded-full'>Follow</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
    echo "<div class='flex justify-center p-10'>";
    echo "<a href='logout.php' class='bg-rose-200 shadow-md text-rose-500 px-5 py-1 rounded-full'>Logout</a>";
    echo "</div>";

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

    <footer class='pt-10'>
        <h1 class='text-blue-500 text-xs text-center'>
            Nomads <span class='text-orange-500'>Developer</span>
        </h1>
    </footer>

</body>
</html>