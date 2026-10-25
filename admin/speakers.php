<?php
require_once 'includes/auth.php';

$upload_dir = '../assets/uploads/';
if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? null;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $team_name = $_POST['team_name'];
    
    $image_url = '';

    if ($action == 'add_speaker') {
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
            $new_name = uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $new_name)) {
                $image_url = 'assets/uploads/' . $new_name;
            }
        }
        if($pdo) {
            $stmt = $pdo->prepare("INSERT INTO speakers (first_name, last_name, team_name, image_url) VALUES (?, ?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $team_name, $image_url]);
        }
        header("Location: speakers.php");
        exit;
    }
    
    if ($action == 'edit_speaker') {
        $stmt_old = $pdo->prepare("SELECT image_url FROM speakers WHERE id = ?");
        $stmt_old->execute([$id]);
        $image_url = $stmt_old->fetchColumn();

        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
            $new_name = uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $new_name)) {
                if ($image_url && file_exists('../' . $image_url)) {
                    unlink('../' . $image_url);
                }
                $image_url = 'assets/uploads/' . $new_name;
            }
        }

        if($pdo) {
            $stmt = $pdo->prepare("UPDATE speakers SET first_name=?, last_name=?, team_name=?, image_url=? WHERE id=?");
            $stmt->execute([$first_name, $last_name, $team_name, $image_url, $id]);
        }
        header("Location: speakers.php");
        exit;
    }
}

if (isset($_GET['delete'])) {
    if($pdo) {
        $stmt_get = $pdo->prepare("SELECT image_url FROM speakers WHERE id = ?");
        $stmt_get->execute([$_GET['delete']]);
        $img = $stmt_get->fetchColumn();
        if ($img && file_exists('../' . $img)) {
            unlink('../' . $img);
        }

        $stmt = $pdo->prepare("DELETE FROM speakers WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }
    header("Location: speakers.php");
    exit;
}

$edit_item = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM speakers WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_item = $stmt->fetch(PDO::FETCH_ASSOC);
}

$speakers = $pdo ? $pdo->query("SELECT * FROM speakers ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC) : [];
require_once 'includes/header.php';
?>

<h3 class="mb-4">จัดการทีมวิทยากร (Speakers Team)</h3>

<div class="card p-4 mb-4 shadow-sm border-0 no-print">
    <h5 class="mb-3"><?php echo $edit_item ? 'แก้ไขข้อมูลวิทยากร' : 'เพิ่มวิทยากร'; ?></h5>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?php echo $edit_item ? 'edit_speaker' : 'add_speaker'; ?>">
        <?php if($edit_item): ?><input type="hidden" name="id" value="<?php echo $edit_item['id']; ?>"><?php endif; ?>
        
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">ชื่อ</label>
                <input type="text" name="first_name" class="form-control" required value="<?php echo $edit_item ? htmlspecialchars($edit_item['first_name']) : ''; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">นามสกุล</label>
                <input type="text" name="last_name" class="form-control" required value="<?php echo $edit_item ? htmlspecialchars($edit_item['last_name']) : ''; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">ชื่อทีม (ถ้ามี)</label>
                <input type="text" name="team_name" class="form-control" value="<?php echo $edit_item ? htmlspecialchars($edit_item['team_name']) : ''; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">รูปภาพประจำตัว</label>
                <input type="file" name="image_file" class="form-control" accept="image/*">
                <?php if($edit_item && $edit_item['image_url']): ?>
                    <small class="text-muted d-block mt-1">รูปปัจจุบัน: มีรูปภาพแล้ว</small>
                <?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-<?php echo $edit_item ? 'warning' : 'primary'; ?>"><?php echo $edit_item ? 'บันทึกการแก้ไข' : 'เพิ่มวิทยากร'; ?></button>
        <?php if($edit_item): ?>
            <a href="speakers.php" class="btn btn-secondary">ยกเลิก</a>
        <?php endif; ?>
    </form>
</div>

<div class="card p-3 shadow-sm border-0">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th width="80">รูปภาพ</th>
                <th>ชื่อ-นามสกุล</th>
                <th>ชื่อทีม</th>
                <th width="150" class="text-center no-print">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($speakers) == 0): ?><tr><td colspan="4" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
            <?php foreach($speakers as $s): ?>
            <tr>
                <td>
                    <?php if($s['image_url']): ?>
                        <img src="../<?php echo htmlspecialchars($s['image_url']); ?>" style="width:50px; height:50px; object-fit:cover; border-radius:5px;">
                    <?php else: ?>
                        <div style="width:50px; height:50px; background:#ddd; border-radius:5px; display:flex; align-items:center; justify-content:center; font-size:10px; color:#666;">No Image</div>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($s['first_name'] . ' ' . $s['last_name']); ?></td>
                <td><?php echo htmlspecialchars($s['team_name'] ?: '-'); ?></td>
                <td class="text-center no-print">
                    <a href="speakers.php?edit=<?php echo $s['id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                    <a href="speakers.php?delete=<?php echo $s['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ลบข้อมูลนี้?')">ลบ</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>
