<?php
require_once 'db.php';

try {
    // Check if users table exists and show its structure
    echo "<h3>Checking Database Structure:</h3>";
    $stmt = $pdo->query("DESCRIBE users");
    echo "<pre>";
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
    echo "</pre>";

    // Show all users in the database
    echo "<h3>Current Users in Database:</h3>";
    $stmt = $pdo->query("SELECT id, username, email FROM users");
    echo "<pre>";
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
    echo "</pre>";

    // Try to create a new test user
    $username = "testadmin";
    $email = "admin@test.com";
    $password = password_hash("test123", PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    echo "<h3>New Test User Created:</h3>";
    echo "Username: testadmin<br>";
    echo "Password: test123<br>";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
