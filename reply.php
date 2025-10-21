<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['tweet_id']) || !isset($_POST['reply_content'])) {
    header("Location: index.php");
    exit();
}

$tweet_id = $_POST['tweet_id'];
$user_id = $_SESSION['user_id'];
$reply_content = $_POST['reply_content'];

try {
    $stmt = $pdo->prepare("INSERT INTO replies (tweet_id, user_id, reply_content) VALUES (?, ?, ?)");
    $stmt->execute([$tweet_id, $user_id, $reply_content]);
    header("Location: index.php");
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
