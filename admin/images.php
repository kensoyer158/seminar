<?php
require_once 'includes/auth.php';

// Ensure uploads directory exists
$upload_dir = '../assets/uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_image') {
    $title = $_POST['title'];
    $section = $_POST['section'];
    $description = $_POST['description'];
    $image_url = '';

    // Handle File Upload from Local Folder
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        $file_info = pathinfo($_FILES['image_file']['name']);
        // Create unique name to prevent duplicate overrides
        $new_filename = uniqid() . '.' . $file_info['extension'];
        $target_file = $upload_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
            $image_url = 'assets/uploads/' . $new_filename; // Save relative path
        }
    } else {
        // Fallback to manual URL if provided
        $image_url = $_POST['image_url'] ?? '';
    }

    if (!empty($image_url) && $pdo) {
        $stmt = $pdo->prepare("INSERT INTO images (title, image_url, section, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $image_url, $section, $description]);
    }
    header("Location: images.php");
    exit;
}

if (isset($_GET['delete'])) {
    if($pdo) {
        // Find image path first
        $stmt_get = $pdo->prepare("SELECT image_url FROM images WHERE id = ?");
        $stmt_get->execute([$_GET['delete']]);
        $img = $stmt_get->fetch();
        
        // Delete physical file if it was uploaded
        if ($img && strpos($img['image_url'], 'assets/uploads/') === 0) {
            $file_path = '../' . $img['image_url'];
            if(file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Delete from DB
        $stmt = $pdo->prepare("DELETE FROM images WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }
    header("Location: images.php");
    exit;
}

$images = $pdo ? $pdo->query("SELECT * FROM images ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC) : [];
require_once 'includes/header.php';
?>

<h3 class="mb-4">จัดการรูปภาพสำหรับแสดงในหน้าแรก</h3>

<div class="card p-4 mb-4 shadow-sm border-0 no-print">
    <h5 class="mb-3">เพิ่มรูปภาพใหม่</h5>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_image">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">แสดงใน Section</label>
                <select name="section" class="form-select" required>
                    <option value="seminar">Seminar (ภาพบรรยากาศ)</option>
                    <option value="activity">Activity (กิจกรรม)</option>
                    <option value="reward">Reward (ของรางวัล)</option>
                    <option value="team">Organizing Team (ทีมงาน)</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">ชื่อรูปภาพ (Title)</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="col-md-5 mb-3">
                <label class="form-label">อัพโหลดรูปภาพจากเครื่อง</label>
                <input type="file" name="image_file" class="form-control" accept="image/*">
                <small class="text-muted">หรือวางลิงก์ URL แทน: <input type="url" name="image_url" class="form-control form-control-sm mt-1" placeholder="https://..."></small>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">คำอธิบายเพิ่มเติม (Description - ถ้ามี)</label>
                <input type="text" name="description" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">บันทึกและแสดงที่หน้าแรก</button>
    </form>
</div>

<div class="card p-3 shadow-sm border-0">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th width="120">ภาพตัวอย่าง</th>
                <th>ชื่อ</th>
                <th>Section</th>
                <th width="100" class="text-center no-print">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($images) == 0): ?><tr><td colspan="4" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
            <?php foreach($images as $img): ?>
            <tr class="align-middle">
                <td>
                    <?php 
                        $imgSrc = (strpos($img['image_url'], 'http') === 0) ? htmlspecialchars($img['image_url']) : '../' . htmlspecialchars($img['image_url']);
                    ?>
                    <img src="<?php echo $imgSrc; ?>" style="width:100px; height:60px; object-fit:cover; border-radius:5px;">
                </td>
                <td>
                    <strong><?php echo htmlspecialchars($img['title']); ?></strong><br>
                    <small class="text-muted"><?php echo htmlspecialchars($img['description']); ?></small>
                </td>
                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($img['section']); ?></span></td>
                <td class="text-center no-print">
                    <a href="images.php?delete=<?php echo $img['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบภาพนี้ใช่หรือไม่?')">ลบ</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>
