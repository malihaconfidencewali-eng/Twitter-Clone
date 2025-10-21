<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['user_id'])) {
    header("Location: index.php");
    exit();
}

$follower_id = $_SESSION['user_id'];
$following_id = $_POST['user_id'];

// Check if already following
$stmt = $pdo->prepare("SELECT COUNT(*) FROM followers WHERE follower_id = ? AND following_id = ?");
$stmt->execute([$follower_id, $following_id]);
$is_following = $stmt->fetchColumn() > 0;

if ($is_following) {
    // Unfollow
    $stmt = $pdo->prepare("DELETE FROM followers WHERE follower_id = ? AND following_id = ?");
    $stmt->execute([$follower_id, $following_id]);
} else {
    // Follow
    $stmt = $pdo->prepare("INSERT INTO followers (follower_id, following_id) VALUES (?, ?)");
    $stmt->execute([$follower_id, $following_id]);
}

// Redirect back to profile page
header("Location: profile.php?id=" . $following_id);
exit();
?>
