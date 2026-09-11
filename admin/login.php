<?php
session_start();
require_once "../config/db.php";

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['name'];
        header("Location: index.php");
        exit;
    } else {
        $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/theme.css" rel="stylesheet">
</head>
<body class="cyber-body d-flex align-items-center" style="min-height:100vh;">
<div class="container" style="max-width:400px;">
    <div class="cyber-card p-4">
        <h3 class="cyber-text mb-4">Admin Login</h3>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="text-secondary">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="text-secondary">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn cyber-btn w-100">เข้าสู่ระบบ</button>
        </form>
    </div>
</div>
</body>
</html>
