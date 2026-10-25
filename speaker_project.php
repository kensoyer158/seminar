<?php
require_once 'includes/db.php';

$speaker_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$speaker = null;

if ($speaker_id > 0 && $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM speakers WHERE id = ?");
    $stmt->execute([$speaker_id]);
    $speaker = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fallback if not found by id
if (!$speaker) {
    // If aminta was requested by name or default fallback
    $stmt = $pdo ? $pdo->query("SELECT * FROM speakers WHERE first_name LIKE '%อมินตา%' OR last_name LIKE '%อมินตา%' LIMIT 1") : null;
    $speaker = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
}

$speakerName = $speaker ? trim($speaker['first_name'] . ' ' . $speaker['last_name']) : 'วิทยากร';
$speakerTeam = $speaker ? ($speaker['team_name'] ?: 'วิทยากรรับเชิญ') : 'วิทยากรรับเชิญ';
$speakerImg = ($speaker && !empty($speaker['image_url'])) ? $speaker['image_url'] : 'https://via.placeholder.com/150';

// Registered Speaker Projects with Evaluation Data
$speakerProjects = [
    'aminta' => [
        'keyword' => 'อมินตา',
        'title' => 'ระบบบริหารจัดการและบริการลูกค้าออนไลน์ โรงงานฝาทรงไทยเมืองเพชร',
        'desc' => 'โปรเจกต์พัฒนาระบบบริหารจัดการข้อมูลและการให้บริการลูกค้าผ่านช่องทางออนไลน์ สำหรับโรงงานฝาทรงไทยเมืองเพชร ครอบคลุมตั้งแต่การจัดการฐานข้อมูล การสั่งผลิตสินค้า การจัดส่ง ตลอดจนระบบประสานงานลูกค้าแบบครบวงจร',
        'folder' => 'img/aminta',
        'rank' => 1,
        'presenter' => 'น.ส. อมินตา รุ่งเรือง (โบนัส)',
        'highlight' => 'ครบเครื่อง สมบูรณ์แบบทุกมิติ (คะแนนเต็ม 5 ทุกเกณฑ์)',
        'rating' => 'ดีเยี่ยมสูงสุด (Exceptional)',
        'rating_class' => 'rating-exceptional'
    ],
    'nattawut' => [
        'keyword' => 'ณัฐวุฒิ',
        'title' => 'เว็บแอปพลิเคชันค้นหาที่พัก',
        'desc' => 'โปรเจกต์พัฒนาระบบเว็บแอปพลิเคชันสำหรับการค้นหา จอง และจัดการข้อมูลที่พักออนไลน์ เพิ่มความสะดวกรวดเร็วในการค้นหาที่พักตามทำเล ราคา และสิ่งอำนวยความสะดวก พร้อมระบบจัดการสำหรับเจ้าของที่พัก',
        'folder' => 'img/nattawut',
        'rank' => 2,
        'presenter' => 'นาย ณัฐวุฒิ อิ่มจิตร (นัท)',
        'highlight' => 'ความพร้อมและประโยชน์ในการนำไปใช้งานจริงเชิงธุรกิจ',
        'rating' => 'ดีเยี่ยม (Excellent)',
        'rating_class' => 'rating-excellent'
    ],
    'jetniphat' => [
        'keyword' => 'เจตนิพัทธ์',
        'title' => 'ระบบสมุดบันทึกการประมงอัจฉริยะ',
        'desc' => 'โปรเจกต์พัฒนาระบบสมุดบันทึกการประมงอัจฉริยะ (Smart Fisheries Logbook) สำหรับบันทึก วิเคราะห์ และติดตามข้อมูลการทำประมง การจับสัตว์น้ำ เส้นทางการเดินเรือ และการบริหารจัดการทรัพยากรประมงอย่างมีประสิทธิภาพผ่านเทคโนโลยีดิจิทัล',
        'folder' => 'img/jetniphat',
        'rank' => 3,
        'presenter' => 'นาย เจตนิพัทธ์ รักทอง (บอล)',
        'highlight' => 'การอธิบายแนวคิดเชิงเทคนิคและสถาปัตยกรรมระบบ',
        'rating' => 'ดีเยี่ยม (Excellent)',
        'rating_class' => 'rating-excellent'
    ],
    'tanapot' => [
        'keyword' => 'ธนพจน์',
        'title' => 'ระบบประมูลภาพศิลปะออนไลน์',
        'desc' => 'โปรเจกต์พัฒนาระบบประมูลภาพศิลปะออนไลน์ (Online Art Auction Platform) สำหรับการจัดแสดง เสนอราคา และประมูลผลงานศิลปะผ่านช่องทางออนไลน์ พร้อมระบบติดตามสถานะการประมูลแบบเรียลไทม์ และระบบความปลอดภัยในการทำธุรกรรม',
        'folder' => 'img/tanapot',
        'rank' => 4,
        'presenter' => 'นาย ธนพจน์ โพธิ์เกตุ (ฟลุ๊ค)',
        'highlight' => 'การตอบคำถามและไหวพริบในการแก้ปัญหาเฉพาะหน้า',
        'rating' => 'ดีเยี่ยม (Excellent)',
        'rating_class' => 'rating-excellent'
    ],
    'poramaet' => [
        'keyword' => 'ปรเมษฐ์',
        'title' => 'เว็บแอปพลิเคชันโอริกามิ',
        'desc' => 'โปรเจกต์พัฒนาระบบเว็บแอปพลิเคชันโอริกามิ (Origami Web Application) สำหรับการเรียนรู้ ฝึกฝน และแบ่งปันเทคนิคการพับกระดาษศิลปะญี่ปุ่น นำเสนอขั้นตอนการพับแบบทีละสเต็ป พร้อมระบบจัดการเนื้อหาสำหรับผู้ใช้งานและผู้ที่สนใจในศิลปะโอริกามิ',
        'folder' => 'img/poramaet',
        'rank' => 5,
        'presenter' => 'นาย ปรเมษฐ์ ใจห้าว (มิกซ์)',
        'highlight' => 'ความคิดสร้างสรรค์ แปลกใหม่ น่าสนใจ',
        'rating' => 'ดีมาก (Very Good)',
        'rating_class' => 'rating-verygood'
    ]
];

// Match project by speaker name keyword
$currentProject = null;
foreach ($speakerProjects as $key => $proj) {
    if (mb_strpos($speakerName, $proj['keyword']) !== false) {
        $currentProject = $proj;
        break;
    }
}

// Scan project images
$projectImages = [];
if ($currentProject && is_dir(__DIR__ . '/' . $currentProject['folder'])) {
    $files = scandir(__DIR__ . '/' . $currentProject['folder']);
    foreach ($files as $file) {
        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'webp'])) {
            $projectImages[] = $currentProject['folder'] . '/' . $file;
        }
    }
    natsort($projectImages);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลงานโปรเจกต์ - <?php echo htmlspecialchars($speakerName); ?></title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            padding-top: 80px;
        }
        .project-header-bar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2c3e50;
            color: #ffffff;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            background: #e74c3c;
            color: white;
            transform: translateX(-3px);
        }

        /* Speaker Profile Hero */
        .speaker-hero-card {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            border-radius: 16px;
            padding: 35px 30px;
            color: white;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 25px;
            box-shadow: 0 10px 25px rgba(30, 41, 59, 0.12);
        }
        .speaker-hero-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e74c3c;
            background: #fff;
            flex-shrink: 0;
        }
        .speaker-hero-info h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .speaker-badge {
            display: inline-block;
            background: rgba(231, 76, 60, 0.2);
            color: #ff7675;
            border: 1px solid rgba(231, 76, 60, 0.4);
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* Project Section */
        .project-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            margin-bottom: 40px;
            border: 1px solid #e2e8f0;
        }
        .project-title {
            font-size: 1.7rem;
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .project-title span {
            color: #e74c3c;
        }
        .project-desc {
            font-size: 1.05rem;
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        /* Gallery Grid */
        .project-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
        }
        .project-img-card {
            background: #f1f5f9;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }
        .project-img-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
            border-color: #e74c3c;
        }
        .project-img-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
        .project-img-card:hover img {
            transform: scale(1.04);
        }
        .img-overlay-hint {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 8px 12px;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            color: #ffffff;
            font-size: 0.85rem;
            text-align: right;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .project-img-card:hover .img-overlay-hint {
            opacity: 1;
        }

        /* Empty State */
        .empty-project {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            border: 1px dashed #cbd5e1;
        }
        .empty-project h3 {
            font-size: 1.3rem;
            color: #475569;
            margin-bottom: 10px;
        }

        /* Lightbox Modal */
        .lightbox-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .lightbox-modal.active {
            display: flex;
        }
        .lightbox-content {
            max-width: 90%;
            max-height: 90vh;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            object-fit: contain;
        }
        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: #ffffff;
            font-size: 36px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }
        .lightbox-close:hover {
            color: #e74c3c;
        }

        @media (max-width: 768px) {
            .speaker-hero-card {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }
            .project-gallery-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Evaluation Card */
        .eval-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 26px 30px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            position: relative;
            overflow: hidden;
        }
        .eval-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: #e74c3c;
        }
        .eval-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px dashed #e2e8f0;
        }
        .eval-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .rating-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .rating-exceptional {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border: 1px solid #f59e0b;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25);
        }
        .rating-excellent {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 1px solid #22c55e;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.25);
        }
        .rating-verygood {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #075985;
            border: 1px solid #38bdf8;
            box-shadow: 0 2px 8px rgba(56, 189, 248, 0.25);
        }
        .eval-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .eval-item {
            background: #f8fafc;
            border: 1px solid #edf2f7;
            padding: 14px 18px;
            border-radius: 10px;
        }
        .eval-item-label {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 4px;
            font-weight: 500;
        }
        .eval-item-val {
            font-size: 1.1rem;
            color: #1e293b;
            font-weight: 600;
        }
        .eval-highlight-box {
            background: #fff8f8;
            border: 1px solid #fed7d7;
            border-radius: 12px;
            padding: 18px 22px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 16px;
        }
        .eval-highlight-icon {
            font-size: 1.8rem;
            line-height: 1;
            flex-shrink: 0;
        }
        .eval-highlight-text h4 {
            margin: 0 0 5px 0;
            color: #c53030;
            font-size: 1rem;
            font-weight: 600;
        }
        .eval-highlight-text p {
            margin: 0;
            color: #2d3748;
            font-size: 1.05rem;
            font-weight: 500;
        }
        .btn-open-modal {
            background: #2c3e50;
            color: #ffffff;
            border: none;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .btn-open-modal:hover {
            background: #e74c3c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        /* Summary Table Modal */
        .table-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.75);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(4px);
        }
        .table-modal.active {
            display: flex;
        }
        .table-modal-dialog {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            max-width: 950px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            animation: modalFadeIn 0.25s ease-out;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(20px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .table-modal-header {
            padding: 20px 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-modal-header h3 {
            margin: 0;
            font-size: 1.25rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .table-modal-close {
            background: none;
            border: none;
            font-size: 26px;
            color: #94a3b8;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
        .table-modal-close:hover {
            color: #e74c3c;
        }
        .table-modal-body {
            padding: 25px;
            overflow-x: auto;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }
        .summary-table th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
        }
        .summary-table td {
            padding: 14px;
            border: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: middle;
        }
        .summary-table tr:hover {
            background: #f8fafc;
        }
        .summary-table tr.highlight-current {
            background: #fff5f5;
            font-weight: 500;
        }
        .summary-table tr.highlight-current td {
            border-color: #fca5a5;
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <header class="project-header-bar">
        <div class="header-container">
            <a href="index.php#speakers" class="btn-back">
                &#8592; ย้อนกลับหน้าหลัก
            </a>
            <div style="font-weight: 600; color: #2c3e50;">
                SEMINAR<span style="color: #e74c3c;">EVENT</span>
            </div>
        </div>
    </header>

    <div class="container" style="max-width: 1200px; margin: 30px auto; padding: 0 20px;">
        
        <!-- Speaker Info Card -->
        <div class="speaker-hero-card">
            <img src="<?php echo htmlspecialchars($speakerImg); ?>" alt="<?php echo htmlspecialchars($speakerName); ?>" class="speaker-hero-img">
            <div class="speaker-hero-info">
                <h1><?php echo htmlspecialchars($speakerName); ?></h1>
                <p style="margin: 0; color: #cbd5e1;"><?php echo htmlspecialchars($speakerTeam); ?></p>
                <div class="speaker-badge">วิทยากรประจำการสัมมนา</div>
            </div>
        </div>

        <?php if ($currentProject): ?>
        
        <!-- Evaluation Summary Card -->
        <?php if (!empty($currentProject['rating'])): ?>
        <div class="eval-card">
            <div class="eval-header">
                <div class="eval-title">
                    <span>📊</span> ผลการประเมินโครงงาน (Evaluation Result)
                </div>
                <div>
                    <span class="rating-badge <?php echo $currentProject['rating_class']; ?>">
                        🏆 <?php echo htmlspecialchars($currentProject['rating']); ?>
                    </span>
                </div>
            </div>

            <div class="eval-grid">
                <div class="eval-item">
                    <div class="eval-item-label">ลำดับผลการประเมิน</div>
                    <div class="eval-item-val" style="color: #e74c3c;">
                        อันดับที่ <?php echo $currentProject['rank']; ?> <span style="font-size: 0.85rem; color: #64748b; font-weight: normal;">(จาก 5 โครงงาน)</span>
                    </div>
                </div>
                <div class="eval-item">
                    <div class="eval-item-label">ผู้นำเสนอ</div>
                    <div class="eval-item-val">
                        <?php echo htmlspecialchars($currentProject['presenter']); ?>
                    </div>
                </div>
            </div>

            <div class="eval-highlight-box">
                <div class="eval-highlight-icon">⭐</div>
                <div class="eval-highlight-text">
                    <h4>จุดเด่นเฉพาะตัวที่โดดเด่นที่สุด:</h4>
                    <p><?php echo htmlspecialchars($currentProject['highlight']); ?></p>
                </div>
            </div>

            <div style="text-align: right; margin-top: 15px;">
                <button type="button" class="btn-open-modal" onclick="openTableModal()">
                    📑 ดูตารางสรุปภาพรวมการประเมินทั้งหมด
                </button>
            </div>
        </div>
        <?php endif; ?>

        <!-- Project Showcase -->
        <div class="project-card">
            <div class="project-title">
                <span>📁</span> <?php echo htmlspecialchars($currentProject['title']); ?>
            </div>
            <div class="project-desc">
                <?php echo htmlspecialchars($currentProject['desc']); ?>
            </div>

            <h3 style="font-size: 1.25rem; color: #1e293b; margin-bottom: 20px; font-weight: 600;">
                📸 ภาพตัวอย่างหน้าจอระบบ (System Screenshots)
            </h3>

            <?php if (!empty($projectImages)): ?>
            <div class="project-gallery-grid">
                <?php foreach ($projectImages as $img): ?>
                <div class="project-img-card" onclick="openLightbox('<?php echo htmlspecialchars($img); ?>')">
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Project Screenshot">
                    <div class="img-overlay-hint">🔍 คลิกเพื่อดูรูปขนาดเต็ม</div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-muted">ไม่พบรูปภาพในโฟลเดอร์ <?php echo htmlspecialchars($currentProject['folder']); ?></p>
            <?php endif; ?>
        </div>

        <?php else: ?>
        <!-- Other Speakers Placeholder -->
        <div class="empty-project">
            <div style="font-size: 3rem; margin-bottom: 10px;">⏳</div>
            <h3>อยู่ระหว่างการจัดเตรียมข้อมูลผลงานโปรเจกต์</h3>
            <p style="color: #94a3b8; margin-bottom: 25px;">รายละเอียดโปรเจกต์ของ <?php echo htmlspecialchars($speakerName); ?> กำลังอยู่ระหว่างการอัปเดต</p>
            <a href="index.php#speakers" class="btn-back" style="display: inline-flex;">กลับสู่หน้าสัมมนา</a>
        </div>
        <?php endif; ?>

    </div>

    <!-- Summary Comparison Table Modal -->
    <div id="tableModal" class="table-modal" onclick="closeTableModal(event)">
        <div class="table-modal-dialog">
            <div class="table-modal-header">
                <h3>📊 ตารางสรุปภาพรวมการประเมิน (Summary Comparison Table)</h3>
                <button type="button" class="table-modal-close" onclick="closeTableModalDirect()">&times;</button>
            </div>
            <div class="table-modal-body">
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">ลำดับ</th>
                            <th>ชื่อโครงงาน</th>
                            <th>ผู้นำเสนอ</th>
                            <th>จุดเด่นเฉพาะตัวที่โดดเด่นที่สุด</th>
                            <th style="width: 190px;">ระดับคุณภาพโดยรวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($speakerProjects as $p): ?>
                        <tr class="<?php echo ($currentProject && $p['rank'] === $currentProject['rank']) ? 'highlight-current' : ''; ?>">
                            <td style="text-align: center; font-weight: 600;"><?php echo $p['rank']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($p['title']); ?></strong>
                                <?php if ($currentProject && $p['rank'] === $currentProject['rank']): ?>
                                    <span style="font-size: 0.75rem; background: #e74c3c; color: white; padding: 2px 7px; border-radius: 4px; margin-left: 6px;">โปรเจกต์นี้</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($p['presenter']); ?></td>
                            <td><?php echo htmlspecialchars($p['highlight']); ?></td>
                            <td>
                                <span class="rating-badge <?php echo $p['rating_class']; ?>" style="font-size: 0.85rem; padding: 4px 10px;">
                                    <?php echo htmlspecialchars($p['rating']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox-modal" onclick="closeLightbox(event)">
        <span class="lightbox-close" onclick="closeLightbox(event)">&times;</span>
        <img id="lightbox-img" class="lightbox-content" src="" alt="Full preview">
    </div>

    <script>
    function openLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox(e) {
        if (e.target.id === 'lightbox' || e.target.classList.contains('lightbox-close')) {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
    function openTableModal() {
        document.getElementById('tableModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeTableModalDirect() {
        document.getElementById('tableModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    function closeTableModal(e) {
        if (e.target.id === 'tableModal') {
            closeTableModalDirect();
        }
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('lightbox').classList.remove('active');
            closeTableModalDirect();
            document.body.style.overflow = 'auto';
        }
    });
    </script>
</body>
</html>
