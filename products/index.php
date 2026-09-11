<?php
require_once "../config/db.php";
$sql = "SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        JOIN brands b ON p.brand_id = b.id
        WHERE p.is_active = 1
        ORDER BY p.id ASC";
$result = $conn->query($sql);
$pageTitle = "สินค้า | PC Configurator";
require "../includes/header.php";
?>

<h1 class="fw-bold mb-4 cyber-text">สินค้าคอมพิวเตอร์</h1>
<div class="row g-4">
    <?php while ($product = $result->fetch_assoc()): ?>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card cyber-card h-100">
            <a href="detail.php?id=<?= $product['id'] ?>" class="text-decoration-none">
                <div class="d-flex justify-content-center align-items-center" style="height: 220px;">
                    <?php if (!empty($product['image'])): ?>
                    <img src="../images/products/<?= htmlspecialchars($product['image']) ?>" class="img-fluid" style="max-height: 200px;">
                    <?php else: ?>
                    <div class="text-muted">ไม่มีรูปสินค้า</div>
                    <?php endif; ?>
                </div>
            </a>
            <div class="card-body">
                <span class="badge cyber-badge mb-2"><?= htmlspecialchars($product['category_name']) ?></span>
                <h5 class="card-title fw-bold text-light"><?= htmlspecialchars($product['name']) ?></h5>
                <p class="text-secondary small"><?= htmlspecialchars($product['brand_name']) ?></p>
            </div>
            <div class="card-footer bg-transparent border-top border-secondary border-opacity-25">
                <div class="cyber-price fw-bold fs-5"><?= number_format($product['price'], 2) ?> บาท</div>
                <small class="text-secondary">เหลือ <?= $product['stock'] ?> ชิ้น</small>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php require "../includes/footer.php"; ?>