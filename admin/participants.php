<?php
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $p_type = $_POST['p_type'];
    $student_id = !empty($_POST['student_id']) ? $_POST['student_id'] : null;
    $title = !empty($_POST['title']) ? $_POST['title'] : null;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $year = !empty($_POST['year']) ? $_POST['year'] : null;
    $faculty = !empty($_POST['faculty']) ? $_POST['faculty'] : null;
    $major = !empty($_POST['major']) ? $_POST['major'] : null;

    if($pdo) {
        $stmt = $pdo->prepare("INSERT INTO participants (p_type, student_id, title, first_name, last_name, year, faculty, major) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$p_type, $student_id, $title, $first_name, $last_name, $year, $faculty, $major]);
    }
    header("Location: participants.php");
    exit;
}

if (isset($_GET['delete'])) {
    if($pdo) {
        $stmt = $pdo->prepare("DELETE FROM participants WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }
    header("Location: participants.php");
    exit;
}

$participants = $pdo ? $pdo->query("SELECT * FROM participants ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC) : [];
require_once 'includes/header.php';
?>

<h3 class="mb-4">บันทึกผู้เข้าร่วมงาน</h3>

<div class="card p-4 mb-4 shadow-sm border-0 no-print">
    <h5 class="mb-3">เพิ่มผู้เข้าร่วม</h5>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">ประเภทผู้เข้าร่วม</label>
                <select name="p_type" id="p_type" class="form-select" onchange="toggleFields()" required>
                    <option value="student">นักศึกษา</option>
                    <option value="teacher">อาจารย์</option>
                    <option value="outsider">บุคคลภายนอก</option>
                </select>
            </div>
            
            <div class="col-md-2 mb-3 non-student-field" style="display:none;">
                <label class="form-label">คำนำหน้า</label>
                <input type="text" name="title" class="form-control" placeholder="นาย, นาง, นางสาว, อ.">
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label">ชื่อ</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">นามสกุล</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3 student-field">
                <label class="form-label">รหัสนักศึกษา</label>
                <input type="text" name="student_id" class="form-control">
            </div>
            <div class="col-md-3 mb-3 student-field">
                <label class="form-label">ชั้นปี</label>
                <select name="year" class="form-select">
                    <option value="">เลือก</option>
                    <option value="1">ปี 1</option><option value="2">ปี 2</option>
                    <option value="3">ปี 3</option><option value="4">ปี 4</option>
                </select>
            </div>
            <div class="col-md-3 mb-3 student-field">
                <label class="form-label">คณะ</label>
                <input type="text" name="faculty" class="form-control">
            </div>
            <div class="col-md-3 mb-3 student-field">
                <label class="form-label">สาขา</label>
                <input type="text" name="major" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">บันทึกข้อมูล</button>
    </form>
</div>

<script>
function toggleFields() {
    const type = document.getElementById('p_type').value;
    const studentFields = document.querySelectorAll('.student-field');
    const nonStudentFields = document.querySelectorAll('.non-student-field');
    
    if (type === 'student') {
        studentFields.forEach(el => el.style.display = 'block');
        nonStudentFields.forEach(el => el.style.display = 'none');
    } else {
        studentFields.forEach(el => el.style.display = 'none');
        nonStudentFields.forEach(el => el.style.display = 'block');
    }
}
toggleFields();
</script>

<div class="card p-3 shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ประเภท</th>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>รายละเอียดเพิ่มเติม</th>
                    <th class="no-print text-center" width="80">ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($participants) == 0): ?><tr><td colspan="5" class="text-center">ยังไม่มีข้อมูล</td></tr><?php endif; ?>
                <?php foreach($participants as $p): ?>
                <tr>
                    <td><?php 
                        if($p['p_type']=='student') echo '<span class="badge bg-primary">นักศึกษา</span>';
                        elseif($p['p_type']=='teacher') echo '<span class="badge bg-secondary">อาจารย์</span>';
                        else echo '<span class="badge bg-dark">บุคคลภายนอก</span>';
                    ?></td>
                    <td><?php echo htmlspecialchars($p['student_id'] ?: '-'); ?></td>
                    <td><?php echo htmlspecialchars($p['title'].$p['first_name'].' '.$p['last_name']); ?></td>
                    <td>
                        <?php if($p['p_type'] == 'student') {
                            echo "ชั้นปี " . htmlspecialchars($p['year'] ?: '-') . " คณะ " . htmlspecialchars($p['faculty'] ?: '-') . " สาขา " . htmlspecialchars($p['major'] ?: '-');
                        } else { echo "-"; } ?>
                    </td>
                    <td class="no-print text-center">
                        <a href="participants.php?delete=<?php echo $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ลบข้อมูลนี้?')">ลบ</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
