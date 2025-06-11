<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Movie - Admin</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="landing">
  <div class="form-container">
    <h2>Add New Movie</h2>
    <form action="backend/save_movie.php" method="POST">
      <input type="text" name="title" placeholder="Movie Title" required />
      <input type="text" name="genre" placeholder="Genre (e.g., Action, Comedy)" required />
      <input type="number" name="year" placeholder="Year (e.g., 2023)" required />
      <textarea name="description" placeholder="Movie Description" required></textarea>
      <input type="text" name="image_url" placeholder="Image URL" required />
      <button type="submit">Add Movie</button>
    </form>
    <br/>
    
    <a href="/Movie-Project.php/admin_dashboard.php" class="btn">⬅️ Back to Dashboard</a>

  </div>
</body>
</html>
