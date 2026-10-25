<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check against hardcoded values as requested
    if ($_POST['username'] === 'admin007' && $_POST['password'] === '123456zsa') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Organizing Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Prompt', sans-serif; background-color: #2c3e50; }</style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 380px; border-radius: 10px;">
        <h3 class="text-center mb-4">Organizing Team<br><small class="text-muted">เข้าสู่ระบบจัดการ</small></h3>
        <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required placeholder="admin007">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">เข้าสู่ระบบ</button>
            <a href="../index.php" class="btn btn-light w-100 mt-2 border">กลับสู่หน้าแรก</a>
        </form>
    </div>
</body>
</html>
