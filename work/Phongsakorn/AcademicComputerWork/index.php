<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แฟ้มสะสมผลงาน | นาย พงศกร บุษษะ - วิทยาการคอมพิวเตอร์</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/Avatar/Avatar-half.png">

    <!-- Google Fonts: Prompt & Kanit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS (Theme: Blue & White) -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- ==========================================================================
         Navigation Bar (แถบเมนูด้านบน)
         ========================================================================== -->
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="#home">
                <div class="brand-badge">PB</div>
                <div>
                    <h1 class="brand-title">พงศกร บุษษะ</h1>
                    <span class="brand-subtitle">Computer Science Portfolio</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-primary"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav align-items-lg-center gap-1 my-3 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home"><i class="bi bi-house-door me-1"></i>หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about"><i class="bi bi-person me-1"></i>ประวัติและทักษะ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio"><i class="bi bi-collection me-1"></i>ผลงานทั้งหมด</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary rounded-pill px-4 py-2 font-heading shadow-sm" href="#portfolio">
                            <i class="bi bi-rocket-takeoff me-1"></i> ดูผลงาน
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==========================================================================
         Hero Section: ข้อมูลนักศึกษา และรูปโปรไฟล์ (สลับครึ่งตัว/เต็มตัว)
         ========================================================================== -->
    <header id="home" class="hero-section">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center gy-5">
                
                <!-- ข้อมูลประจำตัว -->
                <div class="col-lg-7">
                    <div class="hero-badge-pill">
                        <i class="bi bi-mortarboard-fill me-2 text-warning"></i> แฟ้มสะสมผลงานการพัฒนาเว็บไซต์ & โปรเจกต์
                    </div>

                    <h1 class="hero-name">นาย พงศกร บุษษะ</h1>
                    <p class="hero-tagline">นักศึกษาภาควิชาวิทยาการคอมพิวเตอร์ ผู้หลงใหลการสร้างสรรค์เว็บแอปพลิเคชัน</p>

                    <!-- กล่องข้อมูลการศึกษา (ชั้นปี คณะ สาขา) -->
                    <div class="hero-info-grid">
                        <!-- ชั้นปี -->
                        <div class="hero-info-card">
                            <div class="hero-info-icon"><i class="bi bi-award-fill"></i></div>
                            <div class="hero-info-label">ระดับชั้น</div>
                            <div class="hero-info-value">นักศึกษาชั้นปีที่ 4</div>
                        </div>

                        <!-- คณะ -->
                        <div class="hero-info-card">
                            <div class="hero-info-icon"><i class="bi bi-buildings-fill"></i></div>
                            <div class="hero-info-label">คณะ</div>
                            <div class="hero-info-value">เทคโนโลยีสารสนเทศ</div>
                        </div>

                        <!-- สาขา -->
                        <div class="hero-info-card">
                            <div class="hero-info-icon"><i class="bi bi-laptop-fill"></i></div>
                            <div class="hero-info-label">สาขาวิชา</div>
                            <div class="hero-info-value">วิทยาการคอมพิวเตอร์</div>
                        </div>
                    </div>

                    <!-- ปุ่ม Action -->
                    <div class="d-flex flex-wrap gap-3 pt-2">
                        <a href="#portfolio" class="btn btn-light btn-lg px-4 py-3 rounded-pill text-primary fw-bold shadow">
                            <i class="bi bi-grid-fill me-2"></i> เลื่อนดูผลงานของฉัน
                        </a>
                        <button type="button" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill" onclick="toggleAvatar()">
                            <i class="bi bi-arrow-repeat me-2"></i> สลับรูปเต็มตัว / ครึ่งตัว
                        </button>
                    </div>
                </div>

                <!-- รูปโปรไฟล์ พร้อมตัวสลับรูป (ครึ่งตัว / เต็มตัว) -->
                <div class="col-lg-5">
                    <div class="avatar-showcase-wrapper">
                        <div class="avatar-frame">
                            <div class="avatar-img-container">
                                <!-- รูปเริ่มต้น: รูปครึ่งตัว -->
                                <img id="heroAvatarImg" src="img/Avatar/Avatar-half.png" alt="รูป นาย พงศกร บุษษะ" class="avatar-img">
                                <!-- ป้ายสถานะรูป -->
                                <div id="avatarFloatingTag" class="avatar-floating-tag">
                                    <i class="bi bi-person-badge me-1 text-info"></i> รูปครึ่งตัว (Portrait)
                                </div>
                            </div>
                        </div>

                        <!-- ปุ่มกดสลับดูรูปภาพ -->
                        <div class="avatar-switcher-group mt-3">
                            <button id="btnAvatarHalf" class="avatar-switch-btn active" onclick="switchAvatar('half')">
                                <i class="bi bi-person-bounding-box me-1"></i> รูปครึ่งตัว
                            </button>
                            <button id="btnAvatarFull" class="avatar-switch-btn" onclick="switchAvatar('full')">
                                <i class="bi bi-person-standing me-1"></i> รูปเต็มตัว
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- คลื่นตกแต่งด้านล่าง -->
        <div class="hero-shape-wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,121.31,200,111.4,242.09,105.35,283.47,83.49,321.39,56.44Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </header>

    <!-- ==========================================================================
         About & Academic Skills Section
         ========================================================================== -->
    <section id="about" class="py-5">
        <div class="container py-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="about-card">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <img src="img/Avatar/Avatar-half.png" alt="พงศกร บุษษะ" class="about-avatar-thumb">
                            <div>
                                <h4 class="mb-1 text-primary fw-bold">นาย พงศกร บุษษะ</h4>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                                    นักศึกษาชั้นปีที่ 4
                                </span>
                            </div>
                        </div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                            <li class="d-flex align-items-center gap-3">
                                <span class="brand-badge" style="width: 36px; height: 36px; font-size: 1rem;"><i class="bi bi-bank"></i></span>
                                <div>
                                    <small class="text-muted d-block">คณะที่สังกัด</small>
                                    <strong>คณะเทคโนโลยีสารสนเทศ</strong>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <span class="brand-badge" style="width: 36px; height: 36px; font-size: 1rem;"><i class="bi bi-code-square"></i></span>
                                <div>
                                    <small class="text-muted d-block">สาขาวิชา</small>
                                    <strong>สาขาวิทยาการคอมพิวเตอร์</strong>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <span class="brand-badge" style="width: 36px; height: 36px; font-size: 1rem;"><i class="bi bi-folder-check"></i></span>
                                <div>
                                    <small class="text-muted d-block">ผลงานในแฟ้มสะสม</small>
                                    <strong>7 โครงงานเว็บไซต์และระบบประยุกต์</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="about-card">
                        <h3 class="fw-bold text-dark mb-3">
                            <i class="bi bi-code-slash text-primary me-2"></i>ความเชี่ยวชาญ & เทคโนโลยีที่ใช้ในการพัฒนา
                        </h3>
                        <p class="text-muted mb-4">
                            มีความสนใจและประสบการณ์ในการพัฒนาโปรแกรมประยุกต์บนเว็บ ทั้งส่วนหน้าเว็บ (Frontend) และส่วนระบบหลังบ้าน (Backend Database) ตลอดจนการออกแบบฐานข้อมูล การเชื่อมต่อแผนที่สารสนเทศภูมิศาสตร์ (GIS) และการประยุกต์ใช้ปัญญาประดิษฐ์ (Generative AI)
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="skill-badge"><i class="bi bi-filetype-php text-primary fs-5"></i> PHP</span>
                            <span class="skill-badge"><i class="bi bi-database text-info fs-5"></i> MySQL / Database</span>
                            <span class="skill-badge"><i class="bi bi-robot text-primary fs-5"></i> Gemini AI API</span>
                            <span class="skill-badge"><i class="bi bi-bootstrap text-purple fs-5"></i> Bootstrap 5</span>
                            <span class="skill-badge"><i class="bi bi-filetype-html text-danger fs-5"></i> HTML5</span>
                            <span class="skill-badge"><i class="bi bi-filetype-css text-primary fs-5"></i> CSS3</span>
                            <span class="skill-badge"><i class="bi bi-filetype-js text-warning fs-5"></i> JavaScript (ES6)</span>
                            <span class="skill-badge"><i class="bi bi-geo-alt-fill text-success fs-5"></i> Leaflet & Map GIS</span>
                            <span class="skill-badge"><i class="bi bi-phone text-secondary fs-5"></i> Responsive Design</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         Portfolio Section (ส่วนแสดงผลงาน)
         ========================================================================== -->
    <section id="portfolio" class="py-5" style="background-color: #f1f5f9;">
        <div class="container py-4">
            
            <!-- หัวข้อผลงาน -->
            <div class="section-title-wrap">
                <span class="section-subtitle-badge">
                    <i class="bi bi-stars me-1"></i> PORTFOLIO SHOWCASE
                </span>
                <h2 class="section-main-title">ผลงานการพัฒนาเว็บไซต์ของฉัน</h2>
                <p class="section-desc">
                    รวบรวมโปรเจกต์และผลงานเว็บไซต์ สามารถกดคลิกที่ภาพผลงานเพื่อดูรูปภาพตัวอย่างขนาดเต็ม ข้อมูลรายละเอียด และชื่อรายวิชา
                </p>
            </div>

            <!-- ปุ่มตัวกรองผลงาน -->
            <div class="filter-container">
                <button type="button" class="filter-btn active" data-filter="all">
                    <i class="bi bi-grid-fill me-1"></i> ผลงานทั้งหมด (7)
                </button>
                <button type="button" class="filter-btn" data-filter="web">
                    <i class="bi bi-window-stack me-1"></i> เว็บแอปพลิเคชัน & กีฬา & ท่องเที่ยว (4)
                </button>
                <button type="button" class="filter-btn" data-filter="ai">
                    <i class="bi bi-robot me-1"></i> AI & นวัตกรรม (1)
                </button>
                <button type="button" class="filter-btn" data-filter="ecommerce">
                    <i class="bi bi-cart3 me-1"></i> ระบบร้านค้าออนไลน์ (1)
                </button>
                <button type="button" class="filter-btn" data-filter="game">
                    <i class="bi bi-controller me-1"></i> เว็บเกม & Interactive (1)
                </button>
            </div>

            <!-- ตารางแสดงการ์ดผลงาน (Render ผ่าน JavaScript และรองรับ fallback) -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="projectsContainer">
                <!-- Javascript will dynamically inject the project cards here -->
            </div>

            <!-- คำแนะนำการแก้ไขชื่อรายวิชาสำหรับผู้ใช้ -->
            <div class="mt-5 p-4 bg-white rounded-4 border border-primary-subtle text-center shadow-sm">
                <h5 class="text-primary fw-bold mb-2">
                    <i class="bi bi-lightbulb-fill text-warning me-2"></i>จัดทำโดย นาย พงศกร บุษษะ
                </h5>
            </div>

        </div>
    </section>

    <!-- ==========================================================================
         Project Detail Modal (หน้าต่างแสดงรายละเอียดผลงานเมื่อคลิก)
         ========================================================================== -->
    <div class="modal fade custom-modal" id="projectDetailModal" tabindex="-1" aria-labelledby="modalProjectTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                
                <!-- หัว Modal -->
                <div class="modal-header align-items-center">
                    <div>
                        <span id="modalCategoryBadge" class="badge bg-light text-primary px-3 py-1 rounded-pill mb-2">หมวดหมู่</span>
                        <h4 class="modal-title" id="modalProjectTitle">ชื่อผลงาน</h4>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- เนื้อหาใน Modal -->
                <div class="modal-body p-4">
                    
                    <!-- ภาพสกรีนช็อตของเว็บผลงาน (คลิกเพื่อดูรูปขนาดเต็ม) -->
                    <div class="modal-img-container position-relative" style="cursor: pointer;" onclick="window.open(document.getElementById('modalProjectImage').src, '_blank')" title="คลิกเพื่อดูรูปภาพขนาดเต็ม">
                        <img id="modalProjectImage" src="" alt="ภาพตัวอย่างผลงาน" class="modal-img">
                        <span class="position-absolute bottom-0 end-0 m-3 badge bg-dark bg-opacity-75 text-white px-3 py-2 rounded-pill shadow">
                            <i class="bi bi-arrows-fullscreen me-1"></i> คลิกดูภาพขนาดเต็ม
                        </span>
                    </div>

                    <!-- กล่องแสดงรายวิชา (เด่นชัดและแก้ไขได้) -->
                    <div class="modal-course-card">
                        <div class="modal-course-label">
                            <i class="bi bi-journal-bookmark-fill me-1"></i> ของรายวิชา:
                        </div>
                        <h3 class="modal-course-title" id="modalCourseTitle">
                            [ ระบุชื่อรายวิชา ]
                        </h3>
                        <p class="modal-course-hint">
                            <i class="bi bi-info-circle me-1"></i>(สามารถเขียน/แก้ไขชื่อวิชาได้ในไฟล์ <code>js/main.js</code>)
                        </p>
                    </div>

                    <!-- ข้อมูลสำคัญของโปรเจกต์ -->
                    <div class="modal-info-grid">
                        <div class="modal-info-item">
                            <div class="modal-info-item-label"><i class="bi bi-person-check me-1"></i> ผู้จัดทำ:</div>
                            <div class="modal-info-item-value">นาย พงศกร บุษษะ (ชั้นปีที่ 4)</div>
                        </div>
                        <div class="modal-info-item">
                            <div class="modal-info-item-label"><i class="bi bi-laptop me-1"></i> สาขาวิชา:</div>
                            <div class="modal-info-item-value">วิทยาการคอมพิวเตอร์</div>
                        </div>
                    </div>

                    <!-- คำอธิบายผลงาน -->
                    <h5 class="fw-bold text-dark mb-2"><i class="bi bi-card-text text-primary me-2"></i>รายละเอียดผลงาน</h5>
                    <p class="text-secondary mb-4" id="modalProjectDesc">คำอธิบาย...</p>

                    <!-- คุณสมบัติเด่น (Features) -->
                    <h5 class="fw-bold text-dark mb-2"><i class="bi bi-stars text-primary me-2"></i>ฟังก์ชันการทำงานหลัก</h5>
                    <ul class="list-unstyled mb-4" id="modalFeaturesList">
                        <!-- รายการฟังก์ชันจะแสดงที่นี่ -->
                    </ul>

                    <!-- เทคโนโลยีที่ใช้ -->
                    <h5 class="fw-bold text-dark mb-2"><i class="bi bi-tools text-primary me-2"></i>เครื่องมือและเทคโนโลยี</h5>
                    <div id="modalTechBadges" class="d-flex flex-wrap gap-2 mb-2">
                        <!-- แท็กเทคโนโลยีจะแสดงที่นี่ -->
                    </div>

                </div>

                <!-- ท้าย Modal -->
                <div class="modal-footer bg-light p-3 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> ปิด
                    </button>
                    <a id="modalViewFullImgLink" href="#" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                        <i class="bi bi-arrows-fullscreen me-1"></i> เปิดดูรูปภาพขนาดเต็ม
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- ==========================================================================
         Footer
         ========================================================================== -->
    <footer class="custom-footer">
        <div class="container text-center">
            <div class="brand-badge mx-auto mb-3" style="width: 52px; height: 52px; font-size: 1.4rem;">PB</div>
            <h3 class="footer-name">นาย พงศกร บุษษะ</h3>
            <p class="footer-subtitle">
                นักศึกษาชั้นปีที่ 4 คณะเทคโนโลยีสารสนเทศ สาขาวิทยาการคอมพิวเตอร์
            </p>
            <div class="d-flex justify-content-center gap-3 my-3">
                <a href="#home" class="text-white-50 text-decoration-none hover-white">หน้าหลัก</a>
                <span class="text-white-50">•</span>
                <a href="#about" class="text-white-50 text-decoration-none hover-white">ประวัติ</a>
                <span class="text-white-50">•</span>
                <a href="#portfolio" class="text-white-50 text-decoration-none hover-white">ผลงาน</a>
            </div>
            <div class="footer-copy">
                &copy; 2026 นาย พงศกร บุษษะ - แฟ้มสะสมผลงานวิทยาการคอมพิวเตอร์ | พัฒนาด้วย HTML, CSS, JS และ Bootstrap 5
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTopBtn" class="back-to-top" title="กลับขึ้นด้านบน">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Main JS -->
    <script src="js/main.js"></script>

</body>
</html>
