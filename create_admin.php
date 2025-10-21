<?php
require_once 'db.php';

try {
    // Clear existing test account if any
    $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute(['admin']);

    // Create new admin account
    $username = 'admin';
    $email = 'admin@example.com';
    $password = password_hash('admin123', PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    
    echo "Admin account created successfully!<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
    echo "<a href='login.php'>Go to Login</a>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
