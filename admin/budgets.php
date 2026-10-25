<?php
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $amount = $_POST['amount'];
    $b_type = 'expense'; // Force expense

    if($pdo) {
        $stmt = $pdo->prepare("INSERT INTO budgets (item_name, amount, b_type) VALUES (?, ?, ?)");
        $stmt->execute([$item_name, $amount, $b_type]);
    }
    header("Location: budgets.php");
    exit;
}

if (isset($_GET['delete'])) {
    if($pdo) {
        $stmt = $pdo->prepare("DELETE FROM budgets WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }
    header("Location: budgets.php");
    exit;
}

$budgets = $pdo ? $pdo->query("SELECT * FROM budgets WHERE b_type='expense' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC) : [];
require_once 'includes/header.php';
?>

<h3 class="mb-4">บันทึกงบประมาณการจัดงาน (รายจ่าย)</h3>

<div class="card p-4 mb-4 shadow-sm border-0 no-print">
    <form method="POST">
        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label">ชื่อรายการ (เช่น ค่าอาหารว่าง, ค่าสถานที่)</label>
                <input type="text" name="item_name" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">จำนวนเงิน (บาท)</label>
                <input type="number" step="0.01" name="amount" class="form-control" required min="0">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">บันทึกรายจ่าย</button>
    </form>
</div>

<div class="card p-3 shadow-sm border-0">
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th width="150">วันที่บันทึก</th>
                <th>รายการ</th>
                <th class="text-end" width="150">จำนวนเงิน (บาท)</th>
                <th class="no-print text-center" width="80">ลบ</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($budgets) == 0): ?><tr><td colspan="4" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
            <?php foreach($budgets as $b): ?>
            <tr>
                <td><?php echo date('d/m/Y H:i', strtotime($b['created_at'])); ?></td>
                <td><?php echo htmlspecialchars($b['item_name']); ?></td>
                <td class="text-end"><?php echo number_format($b['amount'], 2); ?></td>
                <td class="no-print text-center">
                    <a href="budgets.php?delete=<?php echo $b['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ลบรายการนี้?')">ลบ</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>
