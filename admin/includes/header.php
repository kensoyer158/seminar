<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Seminar Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #2c3e50; color: white; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 12px 20px; transition: 0.2s;}
        .sidebar a:hover, .sidebar a.active { background-color: #34495e; padding-left: 25px;}
        @media print {
            .no-print { display: none !important; }
            body { background-color: white; }
            .col-md-10 { width: 100% !important; padding: 0 !important; }
            .card { border: none !important; box-shadow: none !important; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 p-0 sidebar no-print">
            <h4 class="text-center py-4 mb-0 border-bottom border-secondary">Admin Panel</h4>
            <div class="mt-3">
                <a href="index.php">📊 Dashboard</a>
                <a href="images.php">🖼️ จัดการรูปภาพ (หน้าแรก)</a>
                <a href="participants.php">👥 บันทึกผู้เข้าร่วม</a>
                <a href="budgets.php">💰 บันทึกงบประมาณ</a>
                <a href="team.php">👷 สมาชิกผู้จัดงาน</a>
                <a href="speakers.php">🎤 ทีมวิทยากร</a>
                <a href="../index.php" class="mt-4 text-info">🌐 กลับสู่หน้าเว็บ</a>
                <a href="logout.php" class="text-danger mt-2">🚪 ออกจากระบบ</a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-md-10 p-4">
