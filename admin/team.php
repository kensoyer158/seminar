<?php
require_once 'includes/auth.php';

$upload_dir = '../assets/uploads/';
if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'];
    $role = $_POST['role'];
    
    $image_url = '';

    if ($action == 'add_member') {
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
            $new_name = uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $new_name)) {
                $image_url = 'assets/uploads/' . $new_name;
            }
        }
        if($pdo) {
            $stmt = $pdo->prepare("INSERT INTO team_members (name, role, image_url) VALUES (?, ?, ?)");
            $stmt->execute([$name, $role, $image_url]);
        }
        header("Location: team.php");
        exit;
    }
    
    if ($action == 'edit_member') {
        // Fetch old image
        $stmt_old = $pdo->prepare("SELECT image_url FROM team_members WHERE id = ?");
        $stmt_old->execute([$id]);
        $image_url = $stmt_old->fetchColumn();

        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
            $new_name = uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $new_name)) {
                // Delete old image
                if ($image_url && file_exists('../' . $image_url)) {
                    unlink('../' . $image_url);
                }
                $image_url = 'assets/uploads/' . $new_name;
            }
        }

        if($pdo) {
            $stmt = $pdo->prepare("UPDATE team_members SET name=?, role=?, image_url=? WHERE id=?");
            $stmt->execute([$name, $role, $image_url, $id]);
        }
        header("Location: team.php");
        exit;
    }
}

if (isset($_GET['delete'])) {
    if($pdo) {
        $stmt_get = $pdo->prepare("SELECT image_url FROM team_members WHERE id = ?");
        $stmt_get->execute([$_GET['delete']]);
        $img = $stmt_get->fetchColumn();
        if ($img && file_exists('../' . $img)) {
            unlink('../' . $img);
        }

        $stmt = $pdo->prepare("DELETE FROM team_members WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }
    header("Location: team.php");
    exit;
}

$edit_member = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $edit_member = $stmt->fetch(PDO::FETCH_ASSOC);
}

$members = $pdo ? $pdo->query("SELECT * FROM team_members ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC) : [];
require_once 'includes/header.php';
?>

<h3 class="mb-4">จัดการสมาชิกผู้จัดงาน (Organizing Team)</h3>

<div class="card p-4 mb-4 shadow-sm border-0 no-print">
    <h5 class="mb-3"><?php echo $edit_member ? 'แก้ไขข้อมูลสมาชิก' : 'เพิ่มสมาชิกในทีม'; ?></h5>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?php echo $edit_member ? 'edit_member' : 'add_member'; ?>">
        <?php if($edit_member): ?><input type="hidden" name="id" value="<?php echo $edit_member['id']; ?>"><?php endif; ?>
        
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" name="name" class="form-control" required placeholder="นาย สมชาย ใจดี" value="<?php echo $edit_member ? htmlspecialchars($edit_member['name']) : ''; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">หน้าที่ (Role)</label>
                <input type="text" name="role" class="form-control" required placeholder="เช่น ประธานโครงการ" value="<?php echo $edit_member ? htmlspecialchars($edit_member['role']) : ''; ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">รูปภาพ (ถ้ามี)</label>
                <input type="file" name="image_file" class="form-control" accept="image/*">
                <?php if($edit_member && $edit_member['image_url']): ?>
                    <small class="text-muted d-block mt-1">รูปปัจจุบัน: มีรูปภาพแล้ว (อัปโหลดใหม่เพื่อเปลี่ยน)</small>
                <?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-<?php echo $edit_member ? 'warning' : 'primary'; ?>"><?php echo $edit_member ? 'บันทึกการแก้ไข' : 'เพิ่มสมาชิก'; ?></button>
        <?php if($edit_member): ?>
            <a href="team.php" class="btn btn-secondary">ยกเลิก</a>
        <?php endif; ?>
    </form>
</div>

<div class="card p-3 shadow-sm border-0">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th width="80">รูปภาพ</th>
                <th>ชื่อ-นามสกุล</th>
                <th>หน้าที่รับผิดชอบ</th>
                <th width="150" class="text-center no-print">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($members) == 0): ?><tr><td colspan="4" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
            <?php foreach($members as $m): ?>
            <tr>
                <td>
                    <?php if($m['image_url']): ?>
                        <img src="../<?php echo htmlspecialchars($m['image_url']); ?>" style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                    <?php else: ?>
                        <div style="width:50px; height:50px; background:#ddd; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; color:#666;">No Image</div>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($m['name']); ?></td>
                <td><?php echo htmlspecialchars($m['role']); ?></td>
                <td class="text-center no-print">
                    <a href="team.php?edit=<?php echo $m['id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                    <a href="team.php?delete=<?php echo $m['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ลบข้อมูลนี้?')">ลบ</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>
