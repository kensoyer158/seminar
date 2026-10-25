<?php
$slidesDir = __DIR__ . '/img/main';
$slides = [];

if (is_dir($slidesDir)) {
    $files = scandir($slidesDir);
    foreach ($files as $file) {
        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'webp'])) {
            $slides[] = 'img/main/' . $file;
        }
    }
    // Natural sort: 1.png, 2.png, ... 10.png, 23.png
    natsort($slides);
    $slides = array_values($slides);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สไลด์สัมมนา - AI Agent กับอนาคตของ Software Developer</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            margin: 0;
            padding-top: 75px;
        }
        /* Top Navigation Bar */
        .slide-nav-bar {
            background: #1e293b;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            padding: 12px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            border-bottom: 1px solid #334155;
        }
        .nav-container {
            max-width: 1300px;
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
            background: #334155;
            color: #ffffff;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid #475569;
        }
        .btn-back:hover {
            background: #e74c3c;
            border-color: #e74c3c;
            color: white;
            transform: translateX(-3px);
        }

        /* Presentation Stage */
        .presentation-stage {
            max-width: 1100px;
            margin: 20px auto 40px auto;
            padding: 0 20px;
        }
        .stage-card {
            background: #1e293b;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            border: 1px solid #334155;
            position: relative;
        }
        .main-slide-container {
            width: 100%;
            height: 580px;
            background: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
        }
        .main-slide-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: opacity 0.2s ease;
        }

        /* Stage Controls */
        .stage-controls {
            padding: 18px 25px;
            background: #1e293b;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #334155;
        }
        .slide-counter {
            font-size: 1.1rem;
            font-weight: 600;
            color: #94a3b8;
        }
        .slide-counter span {
            color: #e74c3c;
            font-size: 1.3rem;
        }
        .ctrl-btn-group {
            display: flex;
            gap: 12px;
        }
        .btn-ctrl {
            background: #334155;
            color: #ffffff;
            border: 1px solid #475569;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 0.95rem;
            cursor: pointer;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-ctrl:hover:not(:disabled) {
            background: #e74c3c;
            border-color: #e74c3c;
        }
        .btn-ctrl:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Section Title Header */
        .page-header-title {
            text-align: center;
            margin: 20px 0 10px 0;
            padding: 0 20px;
        }
        .page-header-title h1 {
            font-size: 1.85rem;
            color: #ffffff;
            margin-bottom: 6px;
        }
        .page-header-title p {
            color: #94a3b8;
            font-size: 1.05rem;
            margin: 0;
        }

        /* Thumbnails Grid */
        .thumbnails-section {
            max-width: 1300px;
            margin: 40px auto 60px auto;
            padding: 0 20px;
        }
        .thumbnails-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .thumbnails-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }
        .thumb-card {
            background: #1e293b;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #334155;
            cursor: pointer;
            position: relative;
            transition: all 0.25s ease;
        }
        .thumb-card:hover {
            transform: translateY(-4px);
            border-color: #e74c3c;
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.2);
        }
        .thumb-card.active {
            border-color: #e74c3c;
            box-shadow: 0 0 0 2px #e74c3c;
        }
        .thumb-card img {
            width: 100%;
            height: 125px;
            object-fit: cover;
            display: block;
        }
        .thumb-badge {
            position: absolute;
            top: 6px;
            left: 6px;
            background: rgba(15, 23, 42, 0.85);
            color: #fff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .main-slide-container {
                height: 280px;
            }
            .page-header-title h1 {
                font-size: 1.35rem;
            }
            .thumbnails-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <!-- Nav Bar -->
    <header class="slide-nav-bar">
        <div class="nav-container">
            <a href="index.php" class="btn-back">
                &#8592; ย้อนกลับหน้าหลัก
            </a>
            <div style="font-weight: 600; color: #f8fafc;">
                SEMINAR<span style="color: #e74c3c;">EVENT</span>
            </div>
        </div>
    </header>

    <!-- Page Title Header -->
    <div class="page-header-title">
        <h1>AI Agent กับอนาคตของ Software Developer</h1>
        <p>สไลด์นำเสนอการบรรยายหลักภายในงานสัมมนา (ทั้งหมด <?php echo count($slides); ?> สไลด์)</p>
    </div>

    <!-- Presentation Stage -->
    <div class="presentation-stage">
        <div class="stage-card">
            <div class="main-slide-container" onclick="nextSlide()" title="คลิกเพื่อไปสไลด์ถัดไป">
                <img id="current-slide" class="main-slide-img" src="<?php echo htmlspecialchars($slides[0] ?? ''); ?>" alt="Slide">
            </div>
            <div class="stage-controls">
                <div class="slide-counter">
                    สไลด์ที่ <span id="slide-num">1</span> / <?php echo count($slides); ?>
                </div>
                <div class="ctrl-btn-group">
                    <button id="btn-prev" class="btn-ctrl" onclick="prevSlide()" disabled>&#10094; ก่อนหน้า</button>
                    <button id="btn-next" class="btn-ctrl" onclick="nextSlide()">ถัดไป &#10095;</button>
                </div>
            </div>
        </div>
        <p style="text-align: center; color: #64748b; font-size: 0.85rem; margin-top: 10px;">
            💡 เคล็ดลับ: สามารถใช้ปุ่มลูกศรซ้าย-ขวาบนคีย์บอร์ด (&#8592; / &#8594;) หรือคลิกที่รูปภาพเพื่อเปลี่ยนสไลด์ได้
        </p>
    </div>

    <!-- Thumbnails Overview -->
    <div class="thumbnails-section">
        <div class="thumbnails-title">
            <span>📑 ภาพรวมสไลด์ทั้งหมด</span>
            <span style="font-size: 0.9rem; color: #94a3b8;">คลิกที่สไลด์เพื่อกระโดดไปยังหน้าที่ต้องการ</span>
        </div>
        <div class="thumbnails-grid">
            <?php foreach ($slides as $idx => $slide): ?>
            <div class="thumb-card <?php echo $idx === 0 ? 'active' : ''; ?>" onclick="goToSlide(<?php echo $idx; ?>)" id="thumb-<?php echo $idx; ?>">
                <span class="thumb-badge"><?php echo $idx + 1; ?></span>
                <img src="<?php echo htmlspecialchars($slide); ?>" alt="Slide <?php echo $idx + 1; ?>" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    const slides = <?php echo json_encode($slides); ?>;
    let currentIndex = 0;

    const imgElement = document.getElementById('current-slide');
    const numElement = document.getElementById('slide-num');
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');

    function updateSlide() {
        imgElement.style.opacity = '0.4';
        setTimeout(() => {
            imgElement.src = slides[currentIndex];
            imgElement.style.opacity = '1';
        }, 120);

        numElement.innerText = currentIndex + 1;
        btnPrev.disabled = (currentIndex === 0);
        btnNext.disabled = (currentIndex === slides.length - 1);

        document.querySelectorAll('.thumb-card').forEach(c => c.classList.remove('active'));
        const activeThumb = document.getElementById('thumb-' + currentIndex);
        if (activeThumb) {
            activeThumb.classList.add('active');
        }
    }

    function nextSlide() {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
            updateSlide();
        }
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlide();
        }
    }

    function goToSlide(idx) {
        if (idx >= 0 && idx < slides.length) {
            currentIndex = idx;
            updateSlide();
            window.scrollTo({ top: 90, behavior: 'smooth' });
        }
    }

    // Keyboard navigation (ArrowLeft & ArrowRight)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight' || e.key === ' ') {
            nextSlide();
        } else if (e.key === 'ArrowLeft') {
            prevSlide();
        }
    });
    </script>
</body>
</html>
