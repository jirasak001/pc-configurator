<?php
require_once "config/db.php";
$sql = "SELECT p.*, c.name AS category_name FROM products p
        JOIN categories c ON p.category_id = c.id
        WHERE p.is_active = 1 ORDER BY p.id ASC LIMIT 4";
$featured = $conn->query($sql);

$pageTitle = "หน้าแรก | PC Configurator";
require "includes/header.php";
?>

<div class="hero-spotlight rounded-4 mb-5 p-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="badge cyber-badge mb-3 px-3 py-2">ระบบประกอบพีซี</span>
            <h1 class="display-4 fw-bold mb-3">สร้าง PC ในฝัน<br>ของคุณเอง</h1>
            <p class="lead text-secondary mb-4">เลือกอุปกรณ์ ตรวจสอบความเข้ากันได้ และสั่งซื้อครบในที่เดียว</p>
            <a href="products/" class="btn cyber-btn btn-lg px-4">ดูสินค้าทั้งหมด</a>
        </div>
    </div>
</div>

<h3 class="fw-bold mb-4 cyber-text">สินค้าแนะนำ</h3>
<div class="row g-4">
    <?php while ($product = $featured->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card cyber-card h-100">
                <a href="products/detail.php?id=<?= $product['id'] ?>" class="text-decoration-none">
                    <div class="d-flex justify-content-center align-items-center" style="height: 180px;">
                        <?php if (!empty($product['image'])): ?>
                            <img src="images/products/<?= htmlspecialchars($product['image']) ?>" class="img-fluid" style="max-height: 160px;">
                        <?php else: ?>
                            <div class="text-muted">ไม่มีรูปสินค้า</div>
                        <?php endif; ?>
                    </div>
                </a>
                <div class="card-body">
                    <span class="badge cyber-badge mb-2"><?= htmlspecialchars($product['category_name']) ?></span>
                    <h6 class="fw-bold text-light"><?= htmlspecialchars($product['name']) ?></h6>
                    <div class="cyber-price fw-bold"><?= number_format($product['price'], 2) ?> บาท</div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<style>
    .hero-spotlight {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0a0a0f 0%, #1a0a2e 100%);
        border: 1px solid rgba(0, 255, 242, 0.2);
    }

    .spotlight-glow {
        position: absolute;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(255, 0, 230, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.2s;
        transform: translate(-50%, -50%);
    }
</style>

<?php require "includes/footer.php"; ?>