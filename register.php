<?php
// ตรวจสอบการส่งข้อมูลฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ทำการเชื่อมต่อกับฐานข้อมูล
    include("db_connection.php");

    // รับข้อมูลจากฟอร์ม
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // เพิ่มข้อมูลผู้ใช้ลงในตาราง users
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);

    // ส่งผู้ใช้ไปยังหน้าล็อกอินหลังจากการสมัคสมาชิก
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <h2 class='text-blue-500 text-center text-3xl p-10'>Register</h2>
    <div class='flex justify-center'>
        <form method="post" action="">
            <div>
                <div class='flex justify-center pb-2'>
                    <label for="username" class='text-blue-500'>Username</label>
                </div>
                <div class='flex justify-center'>
                    <input type="text" name="username" required class='border border-orange-500 rounded-full pl-2'>
                </div>
            </div>
            <br>
            <div>
                <div class='flex justify-center pb-2'>
                    <label for="password" class='text-orange-500'>Password</label>
                </div>
                <div class='flex justify-center'>
                    <input type="password" name="password" required class='border border-blue-500 rounded-full pl-2'>
                </div>
            </div>

            <div class='flex justify-center pt-5'>
                <button type="submit" class='shadow-md text-blue-500 bg-blue-200 px-5 py-1 rounded-full'>Register</button>
            </div>
        </form>
    </div>

    <div class='flex justify-center text-zinc-400 text-xs gap-2 pt-5'>
        <p>
            Already have an account
        </p>
        <a href="login.php" class='text-orange-500'>
            Login
        </a>
    </div>

    <footer class='pt-10'>
        <h1 class='text-blue-500 text-xs text-center'>
            Nomads <span class='text-orange-500'>Developer</span>
        </h1>
    </footer>
</body>
</html>