<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

include 'backend/db_connect.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT m.* FROM movies m 
          JOIN favourite_movies f ON m.id = f.movie_id 
          WHERE f.user_id = $user_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Your Favorite Movies</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="home-page">
  <header>
    <h1 class="logo">MyFlix</h1>
    <nav>
      <a href="home.php" class="btn">🏠 Home</a>
      <a href="backend/logout.php" class="btn danger">Log Out</a>
    </nav>
  </header>

  <section class="movie-section">
    <h2>❤️ Your Favorite Movies</h2>
    <div class="movie-grid">
      <?php while ($movie = mysqli_fetch_assoc($result)) { ?>
        <div class="movie-card">
          <img src="<?= $movie['image_url'] ?>" alt="<?= $movie['title'] ?>">
          <p><?= $movie['title'] ?></p>
        </div>
      <?php } ?>
    </div>
  </section>
</body>
</html>
