<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'PC Configurator' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/pc-configurator/assets/theme.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="cyber-body">
    <nav class="navbar cyber-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold cyber-text" href="/pc-configurator/">PC CONFIGURATOR</a>
            <div class="d-flex gap-2 align-items-center">
                <a href="/pc-configurator/products/" class="btn cyber-btn-outline btn-sm">สินค้า</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="text-secondary small">สวัสดี, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="/pc-configurator/account/logout.php" class="btn cyber-btn-outline btn-sm">ออกจากระบบ</a>
                <?php else: ?>
                    <a href="/pc-configurator/account/login.php" class="btn cyber-btn-outline btn-sm">เข้าสู่ระบบ</a>
                    <a href="/pc-configurator/account/register.php" class="btn cyber-btn btn-sm">สมัครสมาชิก</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container py-5">