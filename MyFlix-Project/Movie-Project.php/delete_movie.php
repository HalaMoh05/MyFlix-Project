<?php
session_start();
include 'backend/db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "🗑️ Movie deleted successfully.<br><br>";
        echo '<a href="/Movie-Project.php/admin_dashboard.php" class="btn">⬅️ Back to Dashboard</a>';
    } else {
        echo "❌ Failed to delete movie: " . $stmt->error;
    }
} else {
    echo "No movie ID provided.";
}
?>
