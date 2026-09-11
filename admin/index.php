<?php require "inc-auth.php"; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/theme.css" rel="stylesheet">
</head>
<body class="cyber-body">
<nav class="navbar cyber-navbar">
    <div class="container">
        <span class="cyber-text fw-bold">ADMIN | <?= htmlspecialchars($_SESSION['admin_name']) ?></span>
        <a href="logout.php" class="btn cyber-btn-outline btn-sm">ออกจากระบบ</a>
    </div>
</nav>
<div class="container py-5">
    <h2 class="cyber-text mb-4">Dashboard</h2>
    <a href="products.php" class="btn cyber-btn">จัดการสินค้า</a>
</div>
</body>
</html>