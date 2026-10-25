<?php
require_once 'includes/db.php';

// Function to fetch images by section
function getImagesBySection($pdo, $section) {
    if (!$pdo) return [];
    $stmt = $pdo->prepare("SELECT * FROM images WHERE section = ? ORDER BY id ASC");
    $stmt->execute([$section]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data
$seminarImages = getImagesBySection($pdo, 'seminar');
$activityImages = getImagesBySection($pdo, 'activity');
$rewardImages = getImagesBySection($pdo, 'reward');

// Fetch Team and Speakers from new specific tables
$teamMembers = $pdo ? $pdo->query("SELECT * FROM team_members ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC) : [];
$speakers = $pdo ? $pdo->query("SELECT * FROM speakers ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC) : [];

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminar Event Gallery</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        #speakers .container, #team .container {
            max-width: 1280px;
        }
        .speakers-grid, .team-grid { 
            display: grid; 
            grid-template-columns: repeat(5, 1fr); 
            gap: 20px; 
        }
        .profile-card {
            background: white; 
            border-radius: 12px; 
            padding: 22px 12px; 
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06); 
            transition: all 0.3s ease;
            border: 1px solid #edf2f7;
        }
        .profile-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 8px 18px rgba(0,0,0,0.1);
        }
        a.profile-card {
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
            position: relative;
        }
        a.profile-card:hover {
            border-color: #e74c3c;
            transform: translateY(-7px);
            box-shadow: 0 12px 24px rgba(231, 76, 60, 0.15);
        }
        a.profile-card:hover .profile-name {
            color: #e74c3c;
        }
        .view-project-btn {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.78rem;
            color: #e74c3c;
            background: #fff5f5;
            border: 1px solid #ffd4d4;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        a.profile-card:hover .view-project-btn {
            background: #e74c3c;
            color: #ffffff;
            border-color: #e74c3c;
        }

        /* Organizing Team Card Links */
        a.team-card-link:hover {
            border-color: #3498db !important;
            transform: translateY(-7px);
            box-shadow: 0 12px 24px rgba(52, 152, 219, 0.2);
        }
        a.team-card-link:hover .profile-name {
            color: #2980b9;
        }
        .view-work-btn {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.78rem;
            color: #2980b9;
            background: #ebf5fb;
            border: 1px solid #aed6f1;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        a.team-card-link:hover .view-work-btn {
            background: #3498db;
            color: #ffffff;
            border-color: #3498db;
        }
        .profile-img { 
            width: 120px; 
            height: 120px; 
            border-radius: 50%; 
            object-fit: cover; 
            margin: 0 auto 14px auto; 
            border: 3px solid #e74c3c; 
            display: block;
        }
        .profile-name { 
            font-size: 1.05rem; 
            color: #2c3e50; 
            font-weight: 600; 
            margin-bottom: 6px; 
            word-break: break-word;
        }
        .profile-role { 
            color: #7f8c8d; 
            font-size: 0.85rem; 
        }

        @media screen and (max-width: 1150px) {
            .speakers-grid, .team-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media screen and (max-width: 768px) {
            .speakers-grid, .team-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        }
        @media screen and (max-width: 480px) {
            .speakers-grid, .team-grid { grid-template-columns: 1fr; }
        }

        /* Force Slider Styles to bypass any cached CSS */
        .slider-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }
        .gallery {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            gap: 20px !important;
            padding: 10px 5px 25px 5px !important;
            scroll-snap-type: x mandatory !important;
            -webkit-overflow-scrolling: touch !important;
            scroll-behavior: smooth !important;
            width: 100% !important;
        }
        .gallery-item {
            flex: 0 0 350px !important;
            height: 260px !important;
            max-width: 100% !important;
            scroll-snap-align: start !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            background-color: #f1f5f9;
        }
        .gallery-item:only-child {
            margin: 0 auto !important;
        }
        .slide-nav-btn {
            position: absolute;
            top: calc(50% - 15px);
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.95);
            color: #2c3e50;
            border: 1px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            z-index: 10;
            font-size: 1.2rem;
            transition: all 0.2s ease;
        }
        .slide-nav-btn:hover {
            background: #e74c3c;
            color: white;
            border-color: #e74c3c;
            transform: translateY(-50%) scale(1.1);
        }
        .slide-prev { left: -20px; }
        .slide-next { right: -20px; }
        @media screen and (max-width: 768px) {
            .gallery-item { flex: 0 0 85% !important; height: 220px !important; }
            .slide-nav-btn { display: none !important; }
        }

        /* Clickable Hero */
        .hero {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .hero:hover {
            filter: brightness(1.08);
        }
        .hero-slides-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
            background: rgba(231, 76, 60, 0.9);
            color: #ffffff;
            padding: 8px 24px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero:hover .hero-slides-badge {
            background: #e74c3c;
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.6);
        }
    </style>
</head>
<body>

    <!-- Fixed Top Navbar -->
    <nav class="navbar" id="navbar">
        <div class="logo">
            <a href="#home">SEMINAR<span>EVENT</span></a>
        </div>
        <ul class="nav-links">
            <li><a href="#speakers" class="nav-link">Speakers</a></li>
            <li><a href="#seminar" class="nav-link">Seminar</a></li>
            <li><a href="#activity" class="nav-link">Activity</a></li>
            <li><a href="#team" class="nav-link">Organizing Team</a></li>
        </ul>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </nav>

    <!-- Header Section -->
    <header id="home" class="hero" onclick="window.location.href='seminar_slides.php'" title="คลิกเพื่อดูสไลด์การบรรยายหลัก">
        <div class="hero-content">
            <h1>ยินดีต้อนรับสู่งานสัมมนา</h1>
            <h1>AI Agent กับอนาคตของ Software Developer</h1>
            <div class="hero-slides-badge">
                ดูเนื้อหาการบรรยายหลัก
            </div>
        </div>
    </header>

    <!-- Speakers Section -->
    <section id="speakers" class="section">
        <div class="container">
            <h2 class="section-title">ทีมวิทยากร</h2>
            <div class="speakers-grid">
                <?php if(empty($speakers)): ?><p class="text-center w-100">ยังไม่มีข้อมูลวิทยากร</p><?php endif; ?>
                <?php foreach($speakers as $s): ?>
                <a href="speaker_project.php?id=<?php echo $s['id']; ?>" class="profile-card">
                    <?php $imgSrc = $s['image_url'] ? $s['image_url'] : 'https://via.placeholder.com/150'; ?>
                    <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="Speaker" class="profile-img">
                    <div class="profile-name"><?php echo htmlspecialchars($s['first_name'] . ' ' . $s['last_name']); ?></div>
                    <div class="profile-role"><?php echo htmlspecialchars($s['team_name'] ?: 'วิทยากรรับเชิญ'); ?></div>
                    <div class="view-project-btn">ดูโปรเจกต์ &#8594;</div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Seminar Section -->
    <section id="seminar" class="section">
        <div class="container">
            <h2 class="section-title">ภาพภายในงานสัมมนา (Seminar)</h2>
            <div class="slider-wrapper">
                <?php if(count($seminarImages) > 1): ?>
                <button class="slide-nav-btn slide-prev" onclick="slideSlider(this, -1)">&#10094;</button>
                <?php endif; ?>
                <div class="gallery">
                    <?php if(empty($seminarImages)): ?><p class="text-center w-100">ยังไม่มีรูปภาพในส่วนนี้</p><?php endif; ?>
                    <?php foreach($seminarImages as $img): ?>
                    <div class="gallery-item">
                        <?php $src = (strpos($img['image_url'], 'http') === 0) ? $img['image_url'] : $img['image_url']; ?>
                        <img src="<?php echo htmlspecialchars($src); ?>" alt="<?php echo htmlspecialchars($img['title']); ?>">
                        <div class="overlay">
                            <h3><?php echo htmlspecialchars($img['title']); ?></h3>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if(count($seminarImages) > 1): ?>
                <button class="slide-nav-btn slide-next" onclick="slideSlider(this, 1)">&#10095;</button>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Activity Section -->
    <section id="activity" class="section bg-light">
        <div class="container">
            <h2 class="section-title">กิจกรรม (Activity)</h2>
            <div class="slider-wrapper">
                <?php if(count($activityImages) > 1): ?>
                <button class="slide-nav-btn slide-prev" onclick="slideSlider(this, -1)">&#10094;</button>
                <?php endif; ?>
                <div class="gallery">
                    <?php if(empty($activityImages)): ?><p class="text-center w-100">ยังไม่มีรูปภาพในส่วนนี้</p><?php endif; ?>
                    <?php foreach($activityImages as $img): ?>
                    <div class="gallery-item">
                        <?php $src = (strpos($img['image_url'], 'http') === 0) ? $img['image_url'] : $img['image_url']; ?>
                        <img src="<?php echo htmlspecialchars($src); ?>" alt="<?php echo htmlspecialchars($img['title']); ?>">
                        <div class="overlay">
                            <h3><?php echo htmlspecialchars($img['title']); ?></h3>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if(count($activityImages) > 1): ?>
                <button class="slide-nav-btn slide-next" onclick="slideSlider(this, 1)">&#10095;</button>
                <?php endif; ?>
            </div>
        </div>
    </section>

    

    

    <!-- Team Section -->
    <section id="team" class="section">
        <div class="container">
            <h2 class="section-title">ผู้จัดกิจกรรม (Organizing Team)</h2>
            <div class="team-grid">
                <?php if(empty($teamMembers)): ?><p class="text-center w-100">ยังไม่มีข้อมูลผู้จัดงาน</p><?php endif; ?>
                <?php foreach($teamMembers as $m): ?>
                <?php
                    $workLink = '';
                    if (mb_strpos($m['name'], 'พงศกร') !== false) {
                        $workLink = 'work/Phongsakorn/AcademicComputerWork/index.php';
                    } elseif (mb_strpos($m['name'], 'ภูริเดช') !== false) {
                        $workLink = 'work/Puridate/MyPortfolio/index.html';
                    } elseif (mb_strpos($m['name'], 'กมลภพ') !== false) {
                        $workLink = 'work/kamonphop/layzome/107.php';
                    } elseif (mb_strpos($m['name'], 'จักรกฤษณ์') !== false) {
                        $workLink = 'work/jakkit/jakkrit-resume/index.html';
                    } elseif (mb_strpos($m['name'], 'ณฐกร') !== false) {
                        $workLink = 'work/nuttakorn/portfolio-room/index.html';
                    }
                    $imgSrc = $m['image_url'] ? $m['image_url'] : 'https://via.placeholder.com/150';
                ?>
                <?php if ($workLink): ?>
                <a href="<?php echo htmlspecialchars($workLink); ?>" class="profile-card team-card-link" title="คลิกเพื่อดูผลงานของ <?php echo htmlspecialchars($m['name']); ?>">
                    <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="Team" class="profile-img" style="border-color: #3498db;">
                    <div class="profile-name"><?php echo htmlspecialchars($m['name']); ?></div>
                    <div class="profile-role"><?php echo htmlspecialchars($m['role']); ?></div>
                    <div class="view-work-btn">ดูผลงาน &#8594;</div>
                </a>
                <?php else: ?>
                <div class="profile-card" style="border: 1px solid #edf2f7;">
                    <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="Team" class="profile-img" style="border-color: #3498db;">
                    <div class="profile-name"><?php echo htmlspecialchars($m['name']); ?></div>
                    <div class="profile-role"><?php echo htmlspecialchars($m['role']); ?></div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
                
            </div>
                <div style="text-align: center; margin-top: 40px;">
                    <a href="admin/login.php" style="background-color: #2c3e50; color: white; padding: 10px 25px; border-radius: 5px; font-weight: 600; display: inline-block;">เข้าสู่ระบบจัดการ (Admin)</a>
                </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Seminar Event. All Rights Reserved.</p>
    </footer>

    <script>
    function slideSlider(btn, direction) {
        const wrapper = btn.closest('.slider-wrapper');
        const gallery = wrapper.querySelector('.gallery');
        const scrollAmount = gallery.clientWidth * 0.75;
        gallery.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }
    </script>
    <script src="assets/js/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
