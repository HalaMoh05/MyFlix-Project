<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.html");
    exit();
}

include 'db_connect.php';

$user_id = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'];

$query = "DELETE FROM favourite_movies WHERE user_id = $user_id AND movie_id = $movie_id";

if (mysqli_query($conn, $query)) {
    header("Location: ../favorite_movies.php");
    exit();
} else {
    echo "Error removing favorite: " . mysqli_error($conn);
}
?>




