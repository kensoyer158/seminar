<?php
// =========================================================================
// PHP BACKEND LOGIC & DATA CONFIGURATION
// =========================================================================

// Handle Contact Form Submission
$formMessage = "";
$formStatus = ""; // 'success' or 'error'

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // ในระบบจริงสามารถใช้ mail($to, $subject, $message, $headers) ส่งอีเมลได้
        $formStatus = "success";
        $formMessage = "ขอบคุณครับคุณ $name! ข้อมูลการติดต่อของคุณถูกส่งเรียบร้อยแล้ว";
    } else {
        $formStatus = "error";
        $formMessage = "กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน!";
    }
}

// Personal Data Config (ปรับเปลี่ยนข้อมูลของคุณตรงนี้ได้เลย)
$profile = [
    "name" => "กมลภพ อร่ามรักษ์",
    "nickname" => "ต้น",
    "title" => "Full Stack Developer & UI/UX Enthusiast",
    "bio" => "นักพัฒนาเว็บแอปพลิเคชันที่มีความเชี่ยวชาญทั้งการออกแบบหน้าตาผู้ใช้ (Frontend) และระบบหลังบ้าน (Backend) มุ่งมั่นที่จะสร้างสรรค์ผลงานที่มีคุณภาพ ประสิทธิภาพสูง และรองรับการเติบโตของธุรกิจในยุคดิจิทัล",
    "about_me" => "ผมเริ่มเขียนโปรแกรมตั้งแต่วัยเรียน และหลงใหลการสร้างสรรค์สิ่งใหม่ๆ ด้วยเทคโนโลยี เคารพในวินัยการทำงาน ชอบทำงานเป็นทีม และไม่หยุดที่จะเรียนรู้เครื่องมือใหม่ๆ เป้าหมายคือการพัฒนาซอฟต์แวร์ที่เปลี่ยนไอเดียให้กลายเป็นผลิตภัณฑ์จริงที่ทรงคุณค่า",
    "email" => "kamonphoparamrak@gmail.com",
    "phone" => "+80 768 9500",
    "location" => "เพชรบุรี, ประเทศไทย",
    "avatar" => "t.png",
    "socials" => [
        "github" => "https://github.com",
        "linkedin" => "https://linkedin.com",
        "facebook" => "https://facebook.com",
        "twitter" => "https://twitter.com"
    ]
];

// Experience Data
$experiences = [
    /*[
        "period" => "2023 - ปัจจุบัน",
        "role" => "Senior Full Stack Developer",
        "company" => "Tech Innovation Co., Ltd.",
        "desc" => "ดูแลและพัฒนาระบบ Enterprise Web Application ด้วย PHP (Laravel), React และ MySQL ออกแบบ RESTful API และควบรวมระบบ payment gateway"
    ],
    [
        "period" => "2021 - 2023",
        "role" => "Frontend Developer",
        "company" => "Digital Studio Agency",
        "desc" => "ออกแบบและพัฒนารูปแบบเว็บไซต์ที่ตอบสนองหลายหน้าจอ (Responsive Design) พัฒนา UI Components โดยใช้ Tailwind CSS และ Vue.js"
    ],
    [
        "period" => "2019 - 2021",
        "role" => "Junior Web Developer",
        "company" => "Soft Solutions Thailand",
        "desc" => "พัฒนาเว็บไซต์บริษัทด้วย PHP & HTML/CSS/JS บริหารจัดการฐานข้อมูล MySQL และแก้ไขปัญหาด้านเทคนิคของลูกค้า"
    ]*/
];

// Education Data
$education = [
    [
        "period" => "2023 - 2026",
        "degree" => "ปริญญาตรี วิทยาการคอมพิวเตอร์ (B.Sc. Computer Science)",
        "school" => "มหาวิทยาลัยราชภัฏเพชรบุรี",
        "desc" => "เกรดเฉลี่ยสะสม 2.80  "
    ]
];

// Skills Data
$technicalSkills = [
    ["name" => "PHP ", "level" => 90],
    ["name" => "JavaScript (ES6+) / React", "level" => 60],
    ["name" => "HTML5 /  CSS", "level" => 70],
    ["name" => "MySQL / Database Design", "level" => 70],
    ["name" => "Git / GitHub / CI-CD", "level" => 65],
    ["name" => "RESTful APIs / Node.js", "level" => 60]
];

$softSkills = [
    "Problem Solving", "Team Collaboration", "Agile/Scrum", "Fast Learner", "Communication", "Time Management"
];

// Portfolio Projects Data
$projects = [
    [
        "title" => "A web application for calculating the income and wages of coconut plantation workers",
        "category" => "Web Application",
        "image" => "coco.jpg",
        "desc" => "เว็บแอปพลิเคชันคิดคำนวณรายได้และค่าแรงคนงานสวนมะพร้าว ",
        "tags" => ["PHP", "JavaScript","MySQL","HTML"],
        "link" => "https://cocoton.free.je/login.php?fbclid=IwY2xjawVCg2FleHRuA2FlbQIxMABwZG9mAWJyaWQRMUVKbUZhV1dmWk92SnZpUFpzcnRjBmFwcF9pZBAyMjIwMzkxNzg4MjAwODkyAAEeEUXy_AGBq-5SdpPxz3inBpKVVWfsGZ1Wz0MVSQAeCVK5kFpaEq1YxwBswfk_aem_UW5KaSuRT-Ha2rE9UhcH_A"
    ],
    [
        "title" => "PBRU Activity Portal",
        "category" => "Website",
        "image" => "pbru.png",
        "desc" => "เว็บไซต์ PBRU Activity Portal ระบบจำลองเว็บของมหาวิทยาลัยราชภัฏเพชร",
        "tags" => ["PHP", "MySQL", "HTML"],
        "link" => "https://664244119.makeallcode.com/attachments/"
    ],
    [
        "title" => "ระบบจำลองฐานข้อมูลการขายผลไม้ผ่านช่องทางออนไลน์",
        "category" => "MySQL",
        "image" => "rabitfn.jpg",
        "desc" => "ระบบจำลองฐานข้อมูลการขายผลไม้ผ่านช่องทางออนไลน์",
        "tags" => ["PHP",  "MySQL"],
        "link" => "https://drive.google.com/drive/folders/1i089MFRcC4cRbTlpzuWfNJ-zMWQ0OmS0?usp=sharing"
    ],
    [
        "title" => "Peril in Pinebrook",
        "category" => "VisualNovel",
        "image" => "Peril in Pinebrook.jpg",
        "desc" => "เกมจาก VisualNovelStudio",
        "tags" => ["HTML"],
        "link" => "https://drive.google.com/drive/folders/1ssC0bc58a6lVXLhuBnqDWSyQYTdrC7pR?usp=sharing"
    ],
    [
        "title" => "จำลองระบบตอกบัตรเข้างาน",
        "category" => "wokwi",
        "image" => "wokwi.jpg",
        "desc" => "วงจรจำลองระบบตอกบัตรเข้าประตู",
        "tags" => ["wokwi"],
        "link" => "https://drive.google.com/drive/folders/1Mq1AAKP1g_z-mKgkpBIqJsiM_0zDbwWz?usp=sharing"
    ]
];
?>
<!DOCTYPE html>
<html lang="th" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $profile['name']; ?> - Resume & Portfolio</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Prompt -->
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            blue: '#2563eb',
                            navy: '#1e3a8a',
                            dark: '#0f172a',
                            cardDark: '#1e293b',
                            lightBg: '#f8fafc'
                        }
                    },
                    fontFamily: {
                        sans: ['Prompt', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Prompt', sans-serif; }
    </style>
</head>
<body class="bg-brand-dark text-slate-100 antialiased selection:bg-brand-blue selection:text-white">

    <!-- ========================================== -->
    <!-- NAVBAR / HEADER                            -->
    <!-- ========================================== -->
    <header class="fixed top-0 left-0 w-full z-50 bg-brand-dark/90 backdrop-blur-md border-b border-slate-800 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="#" class="text-2xl font-bold tracking-wider text-white flex items-center gap-2">
                <span class="bg-brand-blue text-white px-3 py-1 rounded-lg shadow-lg shadow-blue-500/30">DEV</span>
                <span><?php echo explode(' ', $profile['name'])[0]; ?></span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="#hero" class="hover:text-brand-blue transition-colors">หน้าแรก</a>
                <a href="#about" class="hover:text-brand-blue transition-colors">เกี่ยวกับผม</a>
                <a href="#experience" class="hover:text-brand-blue transition-colors">ประสบการณ์</a>
                <a href="#skills" class="hover:text-brand-blue transition-colors">ทักษะ</a>
                <a href="#portfolio" class="hover:text-brand-blue transition-colors">ผลงาน</a>
                <a href="#contact" class="bg-brand-blue hover:bg-blue-700 text-white px-5 py-2.5 rounded-full transition-all duration-300 shadow-md shadow-blue-600/30">ติดต่อเรา</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-300 focus:outline-none focus:text-white p-2">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-brand-cardDark border-b border-slate-800 px-4 pt-2 pb-6 space-y-3">
            <a href="#hero" class="block px-3 py-2 rounded-md hover:bg-slate-800 transition-colors">หน้าแรก</a>
            <a href="#about" class="block px-3 py-2 rounded-md hover:bg-slate-800 transition-colors">เกี่ยวกับผม</a>
            <a href="#experience" class="block px-3 py-2 rounded-md hover:bg-slate-800 transition-colors">ประสบการณ์</a>
            <a href="#skills" class="block px-3 py-2 rounded-md hover:bg-slate-800 transition-colors">ทักษะ</a>
            <a href="#portfolio" class="block px-3 py-2 rounded-md hover:bg-slate-800 transition-colors">ผลงาน</a>
            <a href="#contact" class="block px-3 py-2 text-center bg-brand-blue rounded-lg font-medium">ติดต่อเรา</a>
        </div>
    </header>

    <!-- ========================================== -->
    <!-- 1. HERO SECTION                            -->
    <!-- ========================================== -->
    <section id="hero" class="relative min-h-screen pt-28 pb-16 flex items-center justify-center overflow-hidden bg-gradient-to-b from-brand-dark via-slate-900 to-brand-dark">
        <!-- Light Accents in Background -->
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-navy/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid md:grid-cols-12 gap-12 items-center">
                
                <!-- Text Intro -->
                <div class="md:col-span-7 text-center md:text-left space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-brand-blue text-sm font-medium">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-ping"></span>
                        พร้อมเริ่มงานได้ทันที (Open to Work)
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                        สวัสดีครับ, ผม <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-blue-500 to-indigo-300">
                            <?php echo $profile['name']; ?>
                        </span>
                    </h1>
                    
                    <p class="text-xl font-medium text-slate-300">
                        <?php echo $profile['title']; ?>
                    </p>
                    
                    <p class="text-slate-400 max-w-2xl leading-relaxed text-base sm:text-lg">
                        <?php echo $profile['bio']; ?>
                    </p>

                    <!-- Buttons CTA -->
                    <div class="pt-4 flex flex-wrap justify-center md:justify-start gap-4">
                        <a href="#contact" class="px-7 py-3.5 bg-brand-blue hover:bg-blue-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5">
                            <i class="fa-regular fa-paper-plane mr-2"></i> ติดต่อผม
                        </a>
                        <a href="#portfolio" class="px-7 py-3.5 bg-brand-cardDark hover:bg-slate-700 text-slate-200 border border-slate-700 font-medium rounded-xl transition-all duration-300 hover:-translate-y-0.5">
                            <i class="fa-solid fa-briefcase mr-2"></i> ดูผลงาน
                        </a>
                    </div>

                    <!-- Social Icons -->
                    <div class="pt-6 flex items-center justify-center md:justify-start gap-4 text-slate-400">
                        <span class="text-sm">ติดตามผมได้ที่:</span>
                        <a href="<?php echo $profile['socials']['github']; ?>" target="_blank" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center hover:text-white hover:bg-brand-blue hover:border-brand-blue transition-all">
                            <i class="fa-brands fa-github text-lg"></i>
                        </a>
                        <a href="<?php echo $profile['socials']['linkedin']; ?>" target="_blank" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center hover:text-white hover:bg-brand-blue hover:border-brand-blue transition-all">
                            <i class="fa-brands fa-linkedin-in text-lg"></i>
                        </a>
                        <a href="<?php echo $profile['socials']['facebook']; ?>" target="_blank" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center hover:text-white hover:bg-brand-blue hover:border-brand-blue transition-all">
                            <i class="fa-brands fa-facebook-f text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Avatar Image Container -->
                <div class="md:col-span-5 flex justify-center">
                    <div class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96">
                        <!-- Glowing Ring Effect -->
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-brand-blue to-cyan-400 rotate-6 blur-lg opacity-70 animate-pulse"></div>
                        <div class="relative w-full h-full rounded-3xl overflow-hidden border-2 border-slate-700 bg-brand-cardDark shadow-2xl">
                            <img src="<?php echo $profile['avatar']; ?>" alt="<?php echo $profile['name']; ?>" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 2. ABOUT ME SECTION                        -->
    <!-- ========================================== -->
    <section id="about" class="py-20 bg-slate-900 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-white tracking-tight sm:text-4xl">เกี่ยวกับผม</h2>
                <div class="w-16 h-1 bg-brand-blue mx-auto mt-3 rounded-full"></div>
                <p class="mt-4 text-slate-400">ประวัติและเป้าหมายในการทำงานของผม</p>
            </div>

            <div class="grid md:grid-cols-12 gap-8 items-stretch">
                <!-- Main Description -->
                <div class="md:col-span-7 bg-brand-cardDark p-8 rounded-2xl border border-slate-800 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-semibold text-white mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-user-gear text-brand-blue"></i>
                            ประวัติย่อ & เป้าหมาย
                        </h3>
                        <p class="text-slate-300 leading-relaxed space-y-4">
                            <?php echo $profile['about_me']; ?>
                        </p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-8 pt-6 border-t border-slate-800">
                        <div>//เกี่ยวกับประสบการณ์
                            <span class="block text-slate-400 text-xs">ประสบการณ์</span>
                            <span class="text-2xl font-bold text-brand-blue">- ปี</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs">โปรเจกต์ที่สำเร็จ</span>
                            <span class="text-2xl font-bold text-brand-blue">5+ งาน</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs">ทัศนะคติและการทำงานร่วมกับผู้อื่น</span>
                            <span class="text-2xl font-bold text-brand-blue">100%</span>
                        </div>
                    </div>
                </div>

                <!-- Info Cards / Key Highlights -->
                <div class="md:col-span-5 space-y-4">
                    <div class="bg-brand-cardDark p-6 rounded-2xl border border-slate-800 flex items-start gap-4">
                        <div class="p-3 bg-blue-500/10 text-brand-blue rounded-xl text-xl">
                            <i class="fa-solid fa-code"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Clean & Maintainable Code</h4>
                            <p class="text-slate-400 text-sm mt-1">เขียนโค้ดอย่างมีระเบียบ อ่านง่าย ทำงานร่วมกับผู้อื่นได้ราบรื่น</p>
                        </div>
                    </div>

                    <div class="bg-brand-cardDark p-6 rounded-2xl border border-slate-800 flex items-start gap-4">
                        <div class="p-3 bg-blue-500/10 text-brand-blue rounded-xl text-xl">
                            <i class="fa-solid fa-mobile-screen"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Responsive First</h4>
                            <p class="text-slate-400 text-sm mt-1">ออกแบบและพัฒนาให้รองรับทั้งสมาร์ทโฟน แท็บเล็ต และคอมพิวเตอร์</p>
                        </div>
                    </div>

                    <div class="bg-brand-cardDark p-6 rounded-2xl border border-slate-800 flex items-start gap-4">
                        <div class="p-3 bg-blue-500/10 text-brand-blue rounded-xl text-xl">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Problem Solver</h4>
                            <p class="text-slate-400 text-sm mt-1">เน้นการแก้ไขปัญหาทางธุรกิจด้วยเทคโนโลยีที่คุ้มค่าและเหมาะสมที่สุด</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 3. WORK EXPERIENCE & EDUCATION             -->
    <!-- ========================================== -->
    <section id="experience" class="py-20 bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-white tracking-tight sm:text-4xl">ประวัติการทำงานและการศึกษา</h2>
                <div class="w-16 h-1 bg-brand-blue mx-auto mt-3 rounded-full"></div>
                <p class="mt-4 text-slate-400">เส้นทางการเติบโตและประสบการณ์ในสายงาน</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Experience Timeline -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                        <i class="fa-solid fa-briefcase text-brand-blue"></i>
                        ประวัติการทำงาน
                    </h3>
                    <div class="relative border-l-2 border-slate-800 ml-4 space-y-8">
                        <?php foreach($experiences as $exp): ?>
                            <div class="relative pl-8">
                                <!-- Timeline Dot -->
                                <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-brand-blue border-4 border-brand-dark"></div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-blue-500/10 text-brand-blue border border-blue-500/20">
                                    <?php echo $exp['period']; ?>
                                </span>
                                <h4 class="text-lg font-bold text-white mt-2"><?php echo $exp['role']; ?></h4>
                                <p class="text-slate-400 text-sm font-medium mb-2"><?php echo $exp['company']; ?></p>
                                <p class="text-slate-300 text-sm leading-relaxed"><?php echo $exp['desc']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Education Timeline -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-8 flex items-center gap-3">
                        <i class="fa-solid fa-graduation-cap text-brand-blue"></i>
                        ประวัติการศึกษา
                    </h3>
                    <div class="relative border-l-2 border-slate-800 ml-4 space-y-8">
                        <?php foreach($education as $edu): ?>
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-brand-blue border-4 border-brand-dark"></div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded bg-blue-500/10 text-brand-blue border border-blue-500/20">
                                    <?php echo $edu['period']; ?>
                                </span>
                                <h4 class="text-lg font-bold text-white mt-2"><?php echo $edu['degree']; ?></h4>
                                <p class="text-slate-400 text-sm font-medium mb-2"><?php echo $edu['school']; ?></p>
                                <p class="text-slate-300 text-sm leading-relaxed"><?php echo $edu['desc']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 4. SKILLS SECTION                          -->
    <!-- ========================================== -->
    <section id="skills" class="py-20 bg-slate-900 border-t border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-white tracking-tight sm:text-4xl">ทักษะและความสามารถ</h2>
                <div class="w-16 h-1 bg-brand-blue mx-auto mt-3 rounded-full"></div>
                <p class="mt-4 text-slate-400">เทคโนโลยีและทักษะรอบด้านที่ใช้ในการทำงาน</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Technical Skills Progress Bars -->
                <div class="bg-brand-cardDark p-8 rounded-2xl border border-slate-800">
                    <h3 class="text-xl font-bold text-white mb-6">Technical Skills</h3>
                    <div class="space-y-6">
                        <?php foreach($technicalSkills as $skill): ?>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm font-medium text-slate-200"><?php echo $skill['name']; ?></span>
                                    <span class="text-sm font-medium text-brand-blue"><?php echo $skill['level']; ?>%</span>
                                </div>
                                <div class="w-full bg-slate-800 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 h-2.5 rounded-full" style="width: <?php echo $skill['level']; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Soft Skills & Tools Badges -->
                <div class="flex flex-col justify-between space-y-6">
                    <div class="bg-brand-cardDark p-8 rounded-2xl border border-slate-800">
                        <h3 class="text-xl font-bold text-white mb-6">Soft Skills</h3>
                        <div class="flex flex-wrap gap-3">
                            <?php foreach($softSkills as $soft): ?>
                                <span class="px-4 py-2 bg-slate-800 hover:bg-brand-blue/20 hover:border-brand-blue border border-slate-700 text-slate-200 text-sm font-medium rounded-xl transition-all">
                                    <i class="fa-regular fa-circle-check mr-2 text-brand-blue"></i><?php echo $soft; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="bg-brand-cardDark p-8 rounded-2xl border border-slate-800">
                         <h3 class="text-xl font-bold text-white mb-4">สภาพแวดล้อมและเครื่องมือที่ใช้</h3>
                            <div class="flex flex-wrap gap-6 text-slate-400 text-3xl">
                                 <i class="fa-brands fa-php hover:text-white transition-colors" title="PHP"></i>                                         
                                 <i class="fa-brands fa-js hover:text-white transition-colors" title="JavaScript"></i>
                                 <i class="fa-brands fa-html5 hover:text-white transition-colors" title="HTML5"></i>
                                 <i class="fa-solid fa-database hover:text-white transition-colors" title="MySQL"></i>
                                 <i class="fa-solid fa-c hover:text-white transition-colors" title="C++"></i>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 5. PORTFOLIO / PROJECTS SECTION            -->
    <!-- ========================================== -->
    <section id="portfolio" class="py-20 bg-brand-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-white tracking-tight sm:text-4xl">ผลงานตัวอย่าง</h2>
                <div class="w-16 h-1 bg-brand-blue mx-auto mt-3 rounded-full"></div>
                <p class="mt-4 text-slate-400">บางส่วนของโปรเจกต์ที่ผมได้ออกแบบและพัฒนา</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($projects as $project): ?>
                    <div class="bg-brand-cardDark rounded-2xl overflow-hidden border border-slate-800 flex flex-col group hover:-translate-y-2 transition-all duration-300 shadow-xl">
                        <div class="relative overflow-hidden h-48 bg-slate-800">
                            <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <span class="absolute top-3 right-3 text-xs bg-brand-dark/80 backdrop-blur-md border border-slate-700 text-white px-3 py-1 rounded-full">
                                <?php echo $project['category']; ?>
                            </span>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-brand-blue transition-colors">
                                    <?php echo $project['title']; ?>
                                </h3>
                                <p class="text-slate-400 text-sm leading-relaxed mb-4">
                                    <?php echo $project['desc']; ?>
                                </p>
                            </div>
                            <div>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    <?php foreach($project['tags'] as $tag): ?>
                                        <span class="text-xs bg-slate-800 text-blue-300 px-2.5 py-1 rounded-md">#<?php echo $tag; ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <a href="<?php echo $project['link']; ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-blue hover:text-blue-400 transition-colors">
                                    ดูรายละเอียดโปรเจกต์ <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 6. CONTACT FORM & INFORMATION              -->
    <!-- ========================================== -->
    <section id="contact" class="py-24 md:py-32 bg-slate-900 border-t border-slate-800/80">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Heading (Center) -->
            <div class="text-center max-w-3xl mx-auto mb-16 md:mb-20">
                <h2 class="text-3xl font-bold text-white tracking-tight sm:text-4xl">ติดต่อผม</h2>
                <div class="w-16 h-1 bg-brand-blue mx-auto mt-3 rounded-full"></div>
                <p class="mt-4 text-slate-400">สนใจร่วมงาน สอบถามข้อมูลเพิ่มเติม หรือส่งข้อความหาผมได้ทันที</p>
            </div>

            <!-- Contact Details (Center, 3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16 md:mb-20 text-center">
                <!-- Email -->
                <div class="bg-brand-cardDark p-8 rounded-2xl border border-slate-800 hover:border-blue-600/60 transition-all duration-300 h-full flex flex-col items-center justify-center">
                    <div class="w-16 h-16 flex items-center justify-center bg-blue-500/10 text-brand-blue rounded-2xl text-2xl mb-5">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h4 class="text-sm font-medium text-slate-400 tracking-wide uppercase">อีเมล</h4>
                    <p class="text-slate-100 font-medium mt-2 break-all"><?php echo $profile['email']; ?></p>
                </div>

                <!-- Phone -->
                <div class="bg-brand-cardDark p-8 rounded-2xl border border-slate-800 hover:border-blue-600/60 transition-all duration-300 h-full flex flex-col items-center justify-center">
                    <div class="w-16 h-16 flex items-center justify-center bg-blue-500/10 text-brand-blue rounded-2xl text-2xl mb-5">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h4 class="text-sm font-medium text-slate-400 tracking-wide uppercase">เบอร์โทรศัพท์</h4>
                    <p class="text-slate-100 font-medium mt-2"><?php echo $profile['phone']; ?></p>
                </div>

                <!-- Location -->
                <div class="bg-brand-cardDark p-8 rounded-2xl border border-slate-800 hover:border-blue-600/60 transition-all duration-300 h-full flex flex-col items-center justify-center">
                    <div class="w-16 h-16 flex items-center justify-center bg-blue-500/10 text-brand-blue rounded-2xl text-2xl mb-5">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4 class="text-sm font-medium text-slate-400 tracking-wide uppercase">ที่อยู่</h4>
                    <p class="text-slate-100 font-medium mt-2"><?php echo $profile['location']; ?></p>
                </div>
            </div>

            
        </div>
    </section>

    <!-- ========================================== -->
    <!-- FOOTER                                     -->
    <!-- ========================================== -->
    <footer class="bg-brand-dark py-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-slate-500 text-sm">
            <p>© <?php echo date('Y'); ?> <?php echo $profile['name']; ?>. All rights reserved.</p>
            <p>Built with <span class="text-blue-500">PHP</span> & <span class="text-cyan-400">Tailwind CSS</span></p>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Auto close menu when clicking link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>
</body>
</html>