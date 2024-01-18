<?php
// ตรวจสอบการส่งข้อมูลฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ทำการเชื่อมต่อกับฐานข้อมูล
    include("db_connection.php");

    // รับข้อมูลจากฟอร์ม
    $username = $_POST["username"];
    $password = $_POST["password"];

    // ค้นหาข้อมูลผู้ใช้ในฐานข้อมูล
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // ตรวจสอบรหัสผ่าน
    if ($user && password_verify($password, $user["password"])) {
        session_start();
        $_SESSION["user_id"] = $user["user_id"];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <h2 class='text-center text-orange-500 p-10 text-3xl'>Login</h2>
    <div class='flex justify-center py-5'>
        <?php if (isset($error)) echo "<p class='text-rose-500 text-center px-5 bg-rose-200 rounded-full'>$error</p>"; ?>
    </div>
    <div>
        <form method="post" action="">
            <div>
                <div class='flex justify-center pb-2'>
                    <label for="username" class='text-orange-500'>Username</label>
                </div>
                <div class='flex justify-center'>
                    <input type="text" name="username" required class='border rounded-full border-blue-500 pl-2'>
                </div>
            </div>
            <br>
            <div>
                <div class='flex justify-center pb-2'>
                    <label for="password" class='text-blue-500'>Password</label>
                </div>
                <div class='flex justify-center'>
                    <input type="password" name="password" required class='border rounded-full border-orange-500 pl-2'>
                </div>
            </div>

            <div class='flex justify-center pt-5'>
                <button type="submit" class='shadow-md text-green-500 bg-green-200 px-5 py-1 rounded-full'>Login</button>
            </div>
        </form>
    </div>

    <div class='flex justify-center text-zinc-400 text-xs gap-2 pt-5'>
        <p>
            Don't have an account yet?
        </p>
        <a href="register.php" class='text-orange-500'>
            SignUp
        </a>
    </div>

    <footer class='pt-10'>
        <h1 class='text-blue-500 text-xs text-center'>
            Nomads <span class='text-orange-500'>Developer</span>
        </h1>
    </footer>
</body>
</html>