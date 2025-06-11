<?php
session_start();
include 'backend/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("UPDATE movies SET title=?, genre=?, year=?, description=?, image_url=? WHERE id=?");
    $stmt->bind_param("ssissi", $title, $genre, $year, $description, $image_url, $id);

    if ($stmt->execute()) {
        echo "✅ Movie updated successfully.<br><br>";
        echo '<a href="/Movie-Project.php/admin_dashboard.php" class="btn">⬅️ Back to Dashboard</a>';
    } else {
        echo "❌ Failed to update movie: " . $stmt->error;
    }

    exit();
}

// جلب معلومات الفيلم لتعديلها
$stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
?>

<!-- HTML لعرض النموذج -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="home-page">
  <div class="form-container">
    <h2>✏️ Edit Movie</h2>
    <form method="POST">
      <input type="text" name="title" value="<?= $movie['title'] ?>" required>
      <input type="text" name="genre" value="<?= $movie['genre'] ?>" required>
      <input type="number" name="year" value="<?= $movie['year'] ?>" required>
      <textarea name="description" required><?= $movie['description'] ?></textarea>
      <input type="text" name="image_url" value="<?= $movie['image_url'] ?>" required>
      <button type="submit">Update Movie</button>
    </form>
    <br>
    <a href="/Movie-Project.php/admin_dashboard.php" class="btn">⬅️ Back to Dashboard</a>
  </div>
</body>
</html>
