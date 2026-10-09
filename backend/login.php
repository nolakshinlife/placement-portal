<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password, name FROM students WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['student_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = 'student';
        header("Location: ../dashboard.php");
    } else {
        die("Invalid email or password. <a href='../login.php'>Try again</a>");
    }
}
?>