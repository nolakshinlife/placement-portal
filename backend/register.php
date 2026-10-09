<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    $stmt = $pdo->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$name, $email, $password]);
        header("Location: ../login.php?msg=registered");
    } catch (PDOException $e) {
        die("Error: Email already registered.");
    }
}
?>