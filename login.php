<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Student Login</title></head>
<body>
    <div class="auth-box">
        <h2>Student Login</h2>
        <?php if(isset($_GET['msg']) && $_GET['msg']=='registered') echo "<div class='alert'>Registration successful! Please login.</div>"; ?>
        <form action="backend/login.php" method="POST">
            <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
            <button type="submit" class="btn" style="width: 100%;">Login</button>
            <p style="margin-top: 15px; text-align: center;">New? <a href="register.php">Register</a> | <a href="admin_login.php">Admin</a></p>
        </form>
    </div>
</body>
</html>