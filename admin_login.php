<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="assets/css/style.css"><title>Admin Login</title></head>
<body>
    <div class="auth-box" style="border-top: 5px solid var(--danger);">
        <h2 style="color: var(--danger);">Admin Portal</h2>
        <form action="backend/admin_login.php" method="POST">
            <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
            <button type="submit" class="btn" style="background: var(--danger); width: 100%;">Login</button>
        </form>
    </div>
</body>
</html>