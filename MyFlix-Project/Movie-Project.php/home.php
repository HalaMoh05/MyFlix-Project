<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: index.html");
    exit();
}

include 'backend/db_connect.php';

// معالجة البحث
$search = $_GET['search'] ?? '';
if ($search !== '') {
    $stmt = $conn->prepare("SELECT * FROM movies WHERE title LIKE ?");
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = mysqli_query($conn, "SELECT * FROM movies");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Home - MyFlix</title>
  <link rel="stylesheet" href="/Movie-Project.php/css/style.css" />

 
</head>
<body>
 <div class="home-page">
    <header>
      <h1 class="logo">MyFlix</h1>
      <nav>
        <a href="backend/logout.php" class="btn">Log Out</a>
        <a href="favorite_movies.php" class="btn">❤️ Favorites</a>
        <form method="GET" action="home.php">
          <input type="text" name="search" placeholder="Search movies..." value="<?= htmlspecialchars($search) ?>">
          <button type="submit">Search</button>
        </form>
        <ul class="genre-menu">
          <li><a href="#Action">Action</a></li>
          <li><a href="#Sci-Fi">Sci-Fi</a></li>
          <li><a href="#Drama">Drama</a></li>
          <li><a href="#Comedy">Comedy</a></li>
          <li><a href="#Horror">Horror</a></li>
        </ul>
      </nav>
    </header>

    <?php
    // تصنيفات مكررة من النتائج
    $moviesByGenre = [];
    while ($movie = mysqli_fetch_assoc($result)) {
        $genre = $movie['genre'];
        $moviesByGenre[$genre][] = $movie;
    }

    foreach ($moviesByGenre as $genre => $movies) {
        echo "<section class='movie-section' id='$genre'>";
        echo "<h2>" . htmlspecialchars($genre) . " Movies</h2>";
        echo "<div class='movie-grid'>";
        foreach ($movies as $movie) {
            echo "<div class='movie-card'>";
            echo "<img src='" . htmlspecialchars($movie['image_url']) . "' alt='Movie'>";
            echo "<p>" . htmlspecialchars($movie['title']) . "</p>";
            echo "<form method='POST' action='backend/add_favorite.php'>
                    <input type='hidden' name='movie_id' value='" . $movie['id'] . "'>
                    <button type='submit'>❤️ Add to Favorites</button>
                  </form>";
            echo "</div>";
        }
        echo "</div></section>";
    }
    ?>
  </div>
</body>
</html>
