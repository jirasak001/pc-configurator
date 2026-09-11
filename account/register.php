<?php
session_start();
require_once "../config/db.php";

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $error = "กรอกข้อมูลให้ครบ";
    } elseif ($password !== $confirm) {
        $error = "รหัสผ่านไม่ตรงกัน";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->fetch_assoc()) {
            $error = "อีเมลนี้ถูกใช้แล้ว";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'customer')");
            $stmt->bind_param("sss", $name, $email, $hash);
            $stmt->execute();

            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $name;
            header("Location: ../index.php");
            exit;
        }
    }
}

$pageTitle = "สมัครสมาชิก | PC Configurator";
require "../includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="cyber-card p-4">
            <h3 class="cyber-text mb-4">สมัครสมาชิก</h3>
            <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="text-secondary">ชื่อ</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="text-secondary">อีเมล</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="text-secondary">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="text-secondary">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="confirm" class="form-control" required>
                </div>
                <button type="submit" class="btn cyber-btn w-100">สมัครสมาชิก</button>
            </form>
            <p class="text-secondary mt-3 mb-0">มีบัญชีแล้ว? <a href="login.php" class="cyber-text">เข้าสู่ระบบ</a></p>
        </div>
    </div>
</div>

<?php require "../includes/footer.php"; ?>