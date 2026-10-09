<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['student_id'])) die("Unauthorized");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("UPDATE students SET roll_no=?, department=?, cgpa=?, backlogs=? WHERE id=?");
    $stmt->execute([
        $_POST['roll_no'], $_POST['department'], $_POST['cgpa'], 
        $_POST['backlogs'], $_SESSION['student_id']
    ]);
    header("Location: ../profile.php?msg=updated");
}
?>