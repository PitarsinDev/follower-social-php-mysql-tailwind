<?php
session_start();
// ล้างข้อมูลเซสชันและ redirect ไปยังหน้า login
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>