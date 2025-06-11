<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}

include 'backend/db_connect.php';

// جلب الأفلام من قاعدة البيانات
$query = "SELECT * FROM movies";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - MyFlix</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="home-page">
  <div class="admin-dashboard">
    <header>
      <h1 class="logo">Admin Panel - MyFlix</h1>
      <nav>
        <a href="add_movie.php" class="btn">➕ Add New Movie</a>
        <a href="backend/logout.php" class="btn danger">Log Out</a>
      </nav>
    </header>

    <section class="movie-section">
      <h2>Movie List</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($movie = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $movie['id'] ?></td>
              <td><?= $movie['title'] ?></td>
              <td><?= $movie['genre'] ?></td>
              <td>
                <a href="edit_movie.php?id=<?= $movie['id'] ?>">✏️ Edit</a> |
                <a href="delete_movie.php?id=<?= $movie['id'] ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
  </div>
</body>
</html>
