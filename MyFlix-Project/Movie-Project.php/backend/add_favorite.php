<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'] ?? null;

if ($movie_id) {
    // تحقق إذا الفيلم مش مضاف من قبل
    $check = mysqli_query($conn, "SELECT * FROM favourite_movies WHERE user_id = $user_id AND movie_id = $movie_id");
    if (mysqli_num_rows($check) === 0) {
        mysqli_query($conn, "INSERT INTO favourite_movies (user_id, movie_id) VALUES ($user_id, $movie_id)");
    }
}

header("Location: ../home.php");
exit();
?>
