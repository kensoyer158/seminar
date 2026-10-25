<?php
require_once 'includes/auth.php';

// Fetch stats safely handling missing DB setup
$parti_count = $pdo ? ($pdo->query("SELECT COUNT(*) FROM participants")->fetchColumn() ?: 0) : 0;
$budget_out = $pdo ? ($pdo->query("SELECT SUM(amount) FROM budgets WHERE b_type='expense'")->fetchColumn() ?: 0) : 0;
$team_count = $pdo ? ($pdo->query("SELECT COUNT(*) FROM team_members")->fetchColumn() ?: 0) : 0;

$participants = $pdo ? $pdo->query("SELECT * FROM participants ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC) : [];
$budgets = $pdo ? $pdo->query("SELECT * FROM budgets WHERE b_type='expense' ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC) : [];

require_once 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard สรุปผลการดำเนินงาน</h2>
    <button onclick="window.print()" class="btn btn-success no-print">🖨️ พิมพ์รายงาน (PDF)</button>
</div>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card bg-primary text-white p-3 shadow-sm h-100">
            <h6 class="text-uppercase mb-2">ผู้เข้าร่วมทั้งหมด</h6>
            <h2><?php echo number_format($parti_count); ?> คน</h2>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-danger text-white p-3 shadow-sm h-100">
            <h6 class="text-uppercase mb-2">รายจ่ายรวมทั้งหมด</h6>
            <h2><?php echo number_format($budget_out, 2); ?> ฿</h2>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card bg-info text-white p-3 shadow-sm h-100">
            <h6 class="text-uppercase mb-2">สมาชิกทีมผู้จัดงาน</h6>
            <h2><?php echo number_format($team_count); ?> คน</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card p-3 h-100 shadow-sm border-0">
            <h5 class="border-bottom pb-2 mb-3">💰 รายการงบประมาณล่าสุด (รายจ่าย)</h5>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>รายการ</th>
                        <th class="text-end">จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($budgets) == 0): ?><tr><td colspan="2" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
                    <?php foreach($budgets as $b): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($b['item_name']); ?></td>
                        <td class="text-end"><?php echo number_format($b['amount'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card p-3 h-100 shadow-sm border-0">
            <h5 class="border-bottom pb-2 mb-3">👥 ผู้เข้าร่วมล่าสุด</h5>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ประเภท</th>
                        <th>ชื่อ-นามสกุล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($participants) == 0): ?><tr><td colspan="2" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
                    <?php foreach($participants as $p): ?>
                    <tr>
                        <td><?php 
                            if($p['p_type']=='student') echo '<span class="badge bg-primary">นักศึกษา</span>';
                            elseif($p['p_type']=='teacher') echo '<span class="badge bg-secondary">อาจารย์</span>';
                            else echo '<span class="badge bg-dark">บุคคลภายนอก</span>';
                        ?></td>
                        <td><?php echo htmlspecialchars($p['title'].$p['first_name'].' '.$p['last_name']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
