<?php
session_start();
require_once "../config/db.php";

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'customer'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../index.php");
        exit;
    } else {
        $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
    }
}

$pageTitle = "เข้าสู่ระบบ | PC Configurator";
require "../includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="cyber-card p-4">
            <h3 class="cyber-text mb-4">เข้าสู่ระบบ</h3>
            <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="text-secondary">อีเมล</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="text-secondary">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn cyber-btn w-100">เข้าสู่ระบบ</button>
            </form>
            <p class="text-secondary mt-3 mb-0">ยังไม่มีบัญชี? <a href="register.php" class="cyber-text">สมัครสมาชิก</a></p>
        </div>
    </div>
</div>

<?php require "../includes/footer.php"; ?>