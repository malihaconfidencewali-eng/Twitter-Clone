<?php
require_once 'db.php';

try {
    $username = 'testuser';
    $email = 'test@example.com';
    $password = password_hash('password123', PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    echo "Test account created successfully!<br>";
    echo "Username: testuser<br>";
    echo "Password: password123";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
