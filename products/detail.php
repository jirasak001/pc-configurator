<?php
require_once "../config/db.php";
$id = (int) ($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        JOIN brands b ON p.brand_id = b.id
        WHERE p.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("ไม่พบสินค้า");
}

$specStmt = $conn->prepare("SELECT * FROM product_specs WHERE product_id = ?");
$specStmt->bind_param("i", $id);
$specStmt->execute();
$spec = $specStmt->get_result()->fetch_assoc();

$labels = [
    'socket' => 'Socket', 'ram_type' => 'RAM Type', 'form_factor' => 'Form Factor',
    'tdp_watt' => 'TDP (W)', 'wattage' => 'Wattage (W)', 'length_mm' => 'ความยาว (mm)',
    'max_gpu_length_mm' => 'รองรับ GPU ยาวสุด (mm)', 'max_cpu_cooler_height_mm' => 'รองรับฮีทซิงก์สูงสุด (mm)',
    'ram_slots' => 'RAM Slots', 'max_ram_gb' => 'RAM สูงสุด (GB)', 'storage_type' => 'Storage Type',
];

$pageTitle = $product['name'] . " | PC Configurator";
require "../includes/header.php";
?>

<div class="row g-4">
    <div class="col-md-5">
        <div class="cyber-card d-flex justify-content-center align-items-center p-3" style="height: 320px;">
            <?php if (!empty($product['image'])): ?>
            <img src="../images/products/<?= htmlspecialchars($product['image']) ?>" class="img-fluid" style="max-height: 300px;">
            <?php else: ?>
            <div class="text-muted">ไม่มีรูปสินค้า</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-7">
        <span class="badge cyber-badge mb-2"><?= htmlspecialchars($product['category_name']) ?></span>
        <h2 class="fw-bold cyber-text"><?= htmlspecialchars($product['name']) ?></h2>
        <p class="text-secondary"><?= htmlspecialchars($product['description']) ?></p>
        <div class="cyber-price fw-bold fs-3"><?= number_format($product['price'], 2) ?> บาท</div>
        <button class="btn cyber-btn mt-3" type="button">เพิ่มลงตะกร้า</button>
        <table class="table table-dark table-borderless mt-4">
            <?php if ($spec): foreach ($labels as $key => $label): if (!is_null($spec[$key])): ?>
            <tr class="border-bottom border-secondary border-opacity-25">
                <td class="text-secondary"><?= $label ?></td>
                <td class="text-light"><?= htmlspecialchars($spec[$key]) ?></td>
            </tr>
            <?php endif; endforeach; endif; ?>
        </table>
    </div>
</div>

<?php require "../includes/footer.php"; ?>