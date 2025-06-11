<?php
// إعدادات الاتصال بقاعدة البيانات
$host = 'localhost';
$user = 'root';
$password = ''; // إذا عندك باسورد لحساب root اكتبيها هون
$database = 'movie_web'; // ✅ غيّريها إذا اسم قاعدة البيانات مختلف

// الاتصال بقاعدة البيانات
$conn = mysqli_connect($host, $user, $password, $database);

// التحقق من نجاح الاتصال
if (!$conn) {
    die("❌ فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// تعيين الترميز إلى UTF-8 لدعم اللغة العربية
mysqli_set_charset($conn, "utf8");
?>
