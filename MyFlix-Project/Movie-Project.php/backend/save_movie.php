<?php
session_start();
include 'db_connect.php';

echo "<pre>--- DEBUGGING ADD MOVIE ---</pre>";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "⛔ Blocked: Not admin or not logged in.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "❌ Request is not POST. It is: " . $_SERVER['REQUEST_METHOD'];
    exit();
}

echo "✅ POST method received.<br>";

$title = $_POST['title'] ?? null;
$genre = $_POST['genre'] ?? null;
$year = $_POST['year'] ?? null;
$description = $_POST['description'] ?? null;
$image_url = $_POST['image_url'] ?? null;

echo "Received data:<br>";
echo "Title: $title<br>";
echo "Genre: $genre<br>";
echo "Year: $year<br>";
echo "Description: $description<br>";
echo "Image URL: $image_url<br>";

if (!$title || !$genre || !$year || !$description || !$image_url) {
    echo "⚠️ One or more fields are empty!";
    exit();
}

$stmt = $conn->prepare("INSERT INTO movies (title, genre, year, description, image_url) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $title, $genre, $year, $description, $image_url);

if ($stmt->execute()) {
    echo "✅ Movie added successfully.<br><br>";
    echo '<a href="/Movie-Project.php/admin_dashboard.php" class="btn">⬅️ Back to Dashboard</a>';
} else {
    echo "❌ Failed to add movie: " . $stmt->error;
}


?>
