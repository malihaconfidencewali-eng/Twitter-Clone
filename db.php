<?php
$host = 'localhost';
$dbname = 'dbh2onx3aobcgq';
$username = 'uu7xhfztgqodq';
$password = 'afqe4gzkfe1f';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
