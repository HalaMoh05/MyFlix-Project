
<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // استقبال البيانات
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $role = 'user'; // أي تسجيل جديد يكون user تلقائياً

    // تحقق من وجود بيانات
    if (empty($username) || empty($email) || empty($_POST['password'])) {
        echo "Please fill in all required fields.";
        exit();
    }

    // تحقق إذا الإيميل مستخدم من قبل
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email is already registered.";
        exit();
    }

    // إدخال المستخدم الجديد
    $query = "INSERT INTO users (username, email, password, role) 
              VALUES ('$username', '$email', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../login.html"); // بعد التسجيل يرجعه على تسجيل الدخول
        exit();
    } else {
        echo "Signup failed: " . mysqli_error($conn);
    }

} else {
    echo "Access Denied";
}
?>

