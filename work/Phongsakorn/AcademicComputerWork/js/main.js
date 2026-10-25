/**
 * Portfolio JavaScript - นาย พงศกร บุษษะ
 * จัดการข้อมูลโปรเจกต์, ระบบเปิด Modal แสดงรายละเอียด, การสลับรูปภาพ และการกรองผลงาน
 */

/* ==========================================================================
   ข้อมูลผลงาน (Projects Data)
   >>> น้องสามารถแก้ไขชื่อรายวิชาตรงคำว่า "subject" ได้เลยครับ <<<
   ========================================================================== */
const projectsData = [
  {
    id: "wayside_edit",
    title: "Wayside Market - ระบบร้านค้าริมทางพร้อมแผนที่พิกัด",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "โครงงานวิทยาการคอมพิวเตอร์", 
    category: "web",
    categoryLabel: "Web Application / GIS",
    image: "mywork/wayside_edit.png",
    folder: "mywork/wayside_edit",
    entryLink: "mywork/wayside_edit/index.php",
    description: "แพลตฟอร์มบริหารจัดการและค้นหาร้านค้าริมทางในชุมชน เชื่อมต่อกับระบบพิกัดแผนที่ (Leaflet OpenStreetMap) มีระบบลงทะเบียนร้านค้าสำหรับผู้ค้า จัดการเมนูและสินค้า ค้นหาร้านค้าใกล้เคียง และส่งข้อความรายงานร้านค้า",
    features: [
      "ระบบค้นหาร้านค้าและสินค้าตามพิกัดแผนที่ Interactive",
      "ระบบจัดการร้านค้าสำหรับผู้ขาย (Shop Panel)",
      "ระบบจัดการสินค้า และโปรไฟล์ร้านค้า",
      "รองรับการใช้งานผ่านเว็บบราวเซอร์ทุกอุปกรณ์ (Responsive Design)"
    ],
    tech: ["PHP", "MySQL", "Leaflet GIS", "Bootstrap 5", "JavaScript", "HTML5/CSS3"]
  },
  {
    id: "activity_pbru",
    title: "ระบบกิจกรรมนักศึกษา PBRU (มหาวิทยาลัยราชภัฏเพชรบุรี)",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "วิศวกรรมซอฟต์แวร์",
    category: "web",
    categoryLabel: "Web Application / Management",
    image: "mywork/activity_pbru.png",
    folder: "mywork/activity_pbru",
    entryLink: "mywork/activity_pbru/index.php",
    description: "ระบบจัดการและติดตามกิจกรรมนักศึกษา รองรับการเปิดรับสมัครกิจกรรม ตรวจสอบสถานะการเข้าร่วม แสดงรายละเอียดกำหนดการ สถานที่ และการจัดหมวดหมู่ประเภทกิจกรรมของมหาวิทยาลัย",
    features: [
      "ระบบแสดงรายการกิจกรรมที่เปิดรับสมัครล่าสุด",
      "ระบบเข้าสู่ระบบและยืนยันตัวตนนศ.",
      "ระบบจัดหมวดหมู่และค้นหากิจกรรม",
      "หน้ารายละเอียดกิจกรรมพร้อมข้อมูลวัน-เวลาและสถานที่"
    ],
    tech: ["PHP", "MySQL", "Bootstrap 5", "Kanit Font", "Responsive Web"]
  },
  {
    id: "camping_store",
    title: "Camping Gear Store - เว็บร้านค้าอุปกรณ์แคมป์ปิ้งออนไลน์",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "การพัฒนาเว็บไซต์พาณิชย์อิเล็กทรอนิกส์",
    category: "ecommerce",
    categoryLabel: "E-Commerce",
    image: "mywork/camping_store.png",
    folder: "mywork/camping_store",
    entryLink: "mywork/camping_store/index.php",
    description: "ระบบร้านค้าออนไลน์สำหรับจัดจำหน่ายอุปกรณ์แคมป์ปิ้ง อุปกรณ์เดินป่า มีระบบแคตตาล็อกสินค้า การค้นหาและกรองตามหมวดหมู่/แบรนด์ ตะกร้าสินค้า และขั้นตอนการสั่งซื้อสินค้าอย่างเป็นระบบ",
    features: [
      "ระบบแสดงแคตตาล็อกสินค้าพร้อมราคาและโปรโมชั่น",
      "ระบบตะกร้าสินค้า (Shopping Cart) และคำนวณยอดเงิน",
      "ระบบจัดการบัญชีผู้ใช้ ประวัติการสั่งซื้อ และเช็คสินค้าคงเหลือ",
      "ระบบยืนยันคำสั่งซื้อ (Checkout Flow)"
    ],
    tech: ["PHP", "MySQL", "Bootstrap", "Session Management", "JavaScript"]
  },
  {
    id: "mark_map_1",
    title: "แฟนพันธุ์แท้เพชรบุรี (Interactive Quiz & Map Game)",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "สัมมนาวิทยาการคอมพิวเตอร์",
    category: "game",
    categoryLabel: "Interactive & Game",
    image: "mywork/mark_map_1.png",
    folder: "mywork/mark_map_1",
    entryLink: "mywork/mark_map_1/index.html",
    description: "เว็บเกมแฟนพันธุ์แท้และแบบทดสอบความรู้เชิงปฏิสัมพันธ์เกี่ยวกับสถานที่สำคัญในจังหวัดเพชรบุรี โดดเด่นด้วยกราฟิกสวยงาม ระบบจับเวลา และการคำนวณคะแนนแบบ Real-time",
    features: [
      "ระบบแบบทดสอบ Interactive ทายสถานที่ท่องเที่ยวเพชรบุรี",
      "ระบบจับเวลาและคิดคะแนนอัตโนมัติ",
      "แอนิเมชันและเอฟเฟกต์ตอบรับแบบทันที",
      "รองรับการเล่นบนทุกหน้าจอคอมพิวเตอร์และมือถือ"
    ],
    tech: ["HTML5", "CSS3 Canvas/Gradients", "JavaScript ES6", "Node.js (Backend)", "JSON"]
  },
  {
    id: "khao_yoi",
    title: "เว็บประชาสัมพันธ์ท่องเที่ยว วัดถ้ำเขาย้อย จ.เพชรบุรี",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "การพัฒนาเว็บไซต์พาณิชย์อิเล็กทรอนิกส์",
    category: "web",
    categoryLabel: "Tourism Showcase",
    image: "mywork/khao_yoi.png",
    folder: "mywork/khao_yoi",
    entryLink: "mywork/khao_yoi/index.html",
    description: "เว็บไซต์แนะนำสถานที่ท่องเที่ยวเชิงประวัติศาสตร์และวัฒนธรรม วัดถ้ำเขาย้อย อำเภอเขาย้อย จังหวัดเพชรบุรี ถ่ายทอดข้อมูลประวัติความเป็นมา จุดสำคัญภายในถ้ำ แกลเลอรีภาพถ่าย และแผนที่การเดินทาง",
    features: [
      "Hero Banner พร้อมภาพบรรยากาศวัดถ้ำเขาย้อย",
      "เนื้อหาประวัติความเป็นมาและจุดท่องเที่ยวสำคัญ",
      "แกลเลอรีรูปภาพความละเอียดสูง",
      "ข้อมูลการเดินทางและคำแนะนำสำหรับนักท่องเที่ยว"
    ],
    tech: ["HTML5", "Bootstrap 5", "CSS3 Custom Styling", "Prompt Font"]
  },
  {
    id: "pbru2",
    title: "ระบบรับสมัครวิ่ง MARATHON การแข่งขัน พจนก ที่จอมบึง",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "การแข่งขัน พจนก",
    category: "web",
    categoryLabel: "Web Application / Sports",
    image: "mywork/pbru2.png",
    folder: "mywork/pbru2",
    entryLink: "mywork/pbru2/index.php",
    description: "ระบบจัดการและรับสมัครแข่งขันวิ่งมาราธอนสำหรับการแข่งขัน พจนก ที่จอมบึง มีระบบแสดงรายละเอียดระยะทาง เวลาปล่อยตัว อัตราค่าสมัคร ของที่ระลึกที่ได้รับ พร้อมระบบลงทะเบียนและจัดการข้อมูลรายการแข่งขัน",
    features: [
      "ระบบแสดงรายการแข่งขันวิ่งมาราธอน ข้อมูลระยะทาง และค่าสมัคร",
      "ระบบฟอร์มลงทะเบียนเข้าร่วมแข่งขันวิ่งออนไลน์",
      "ระบบจัดการรายการแข่งขัน (เพิ่ม / แก้ไข / ลบ รายการวิ่ง)",
      "ระบบฐานข้อมูลเชื่อมโยงประเภทการแข่งขันและผู้สมัคร"
    ],
    tech: ["PHP", "MySQL", "PDO", "Bootstrap", "Responsive Web"]
  },
  {
    id: "ai_resume",
    title: "AI Resume Builder - ระบบสร้างเรซูเม่ด้วย Google Gemini API",
    // แก้ไขชื่อรายวิชาสำหรับผลงานนี้ได้ที่บรรทัดล่างนี้:
    subject: "สัมมนาวิทยาการคอมพิวเตอร์",
    category: "ai",
    categoryLabel: "AI & Web Innovation",
    image: "mywork/AI-Resume.png",
    folder: "mywork/AI-Resume",
    entryLink: "mywork/AI-Resume/index.html",
    description: "เว็บแอปพลิเคชันสร้างเรซูเม่ระดับมืออาชีพ ขับเคลื่อนด้วยขุมพลัง Google Gemini AI สำหรับช่วยเขียนสรุปประวัติ (AI Summary Writer), ขัดเกลาข้อความให้โดนใจ HR, แนะนำคีย์เวิร์ดทักษะที่ระบบ ATS ต้องการ และสร้างเอกสารขนาด A4 พร้อมส่งสมัครงานได้ทันที",
    features: [
      "เชื่อมต่อ Google Gemini API พร้อมระบบทดสอบการเชื่อมต่อ (Test Connection)",
      "AI Superpowers: สรุปโปรไฟล์, ขัดเกลาเนื้อหา และประเมินคะแนน ATS Score",
      "ระบบกรอกข้อมูลประวัติการศึกษา ประสบการณ์ โครงงาน และทักษะอย่างละเอียด",
      "พรีวิวเรซูเม่แบบ Real-time และพิมพ์/บันทึกเอกสาร A4 คุณภาพสูง"
    ],
    tech: ["HTML5", "CSS3 / Modern UI", "JavaScript (ES6+)", "Google Gemini AI API", "Local Storage", "ATS Optimization"]
  }
];

// Document Ready
document.addEventListener("DOMContentLoaded", function () {
  initNavbar();
  renderProjects("all");
  initFilterButtons();
  initBackToTop();
});

/* ==========================================================================
   เรนเดอร์การ์ดผลงานลงในหน้าเว็บ (Render Project Cards)
   ========================================================================== */
function renderProjects(filterCategory = "all") {
  const container = document.getElementById("projectsContainer");
  if (!container) return;

  const filtered = filterCategory === "all" 
    ? projectsData 
    : projectsData.filter(p => p.category === filterCategory);

  container.innerHTML = "";

  if (filtered.length === 0) {
    container.innerHTML = `
      <div class="col-12 text-center py-5">
        <p class="text-muted fs-5">ไม่พบผลงานในหมวดหมู่นี้</p>
      </div>
    `;
    return;
  }

  filtered.forEach(project => {
    const cardHtml = `
      <div class="col project-item" data-category="${project.category}">
        <div class="project-card">
          <!-- ภาพตัวอย่างผลงาน -->
          <div class="project-img-wrapper" onclick="openProjectModal('${project.id}')" title="คลิกเพื่อดูรายละเอียด">
            <span class="project-category-badge">${project.categoryLabel}</span>
            <img src="${project.image}" alt="${project.title}" class="project-card-img" loading="lazy">
            <div class="project-overlay">
              <span class="overlay-btn"><i class="bi bi-eye-fill me-1"></i> ดูรายละเอียด</span>
            </div>
          </div>

          <!-- เนื้อหาการ์ด -->
          <div class="project-card-body">
            <!-- ส่วนแสดงวิชา (ผู้ใช้สามารถแก้ไขชื่อวิชาได้) -->
            <div class="course-badge-box">
              <span class="course-badge-label"><i class="bi bi-mortarboard-fill me-1"></i>วิชา:</span>
              <span class="course-badge-value" title="${project.subject}">${project.subject}</span>
            </div>

            <!-- ชื่อผลงาน -->
            <h3 class="project-title" onclick="openProjectModal('${project.id}')">${project.title}</h3>

            <!-- คำอธิบายย่อ -->
            <p class="project-short-desc">${project.description}</p>

            <!-- เทคโนโลยีที่ใช้ -->
            <div class="project-tags">
              ${project.tech.slice(0, 3).map(t => `<span class="tag-pill">${t}</span>`).join("")}
              ${project.tech.length > 3 ? `<span class="tag-pill">+${project.tech.length - 3}</span>` : ""}
            </div>

            <!-- ปุ่มเปิดดูรูปภาพและรายละเอียดผลงาน -->
            <div class="project-card-footer">
              <button type="button" class="btn btn-card-detail w-100" onclick="openProjectModal('${project.id}')">
                <i class="bi bi-image me-1"></i> ดูรูปผลงาน & รายละเอียด
              </button>
            </div>
          </div>
        </div>
      </div>
    `;
    container.insertAdjacentHTML("beforeend", cardHtml);
  });
}

/* ==========================================================================
   ระบบเปิด Modal แสดงรายละเอียดผลงาน (Project Detail Modal)
   ========================================================================== */
function openProjectModal(projectId) {
  const project = projectsData.find(p => p.id === projectId);
  if (!project) return;

  // กำหนดข้อมูลลงใน Modal
  document.getElementById("modalProjectTitle").textContent = project.title;
  document.getElementById("modalCategoryBadge").textContent = project.categoryLabel;
  document.getElementById("modalProjectImage").src = project.image;
  document.getElementById("modalProjectImage").alt = project.title;
  
  // รายวิชา
  const courseElem = document.getElementById("modalCourseTitle");
  if (courseElem) courseElem.textContent = project.subject;
  
  // คำอธิบาย
  const descElem = document.getElementById("modalProjectDesc");
  if (descElem) descElem.textContent = project.description;
  
  // จุดเด่น / ฟีเจอร์
  const featuresList = document.getElementById("modalFeaturesList");
  if (featuresList) {
    featuresList.innerHTML = project.features.map(f => `<li><i class="bi bi-check2-circle text-primary me-2"></i>${f}</li>`).join("");
  }
  
  // เทคโนโลยี
  const techContainer = document.getElementById("modalTechBadges");
  if (techContainer) {
    techContainer.innerHTML = project.tech.map(t => `<span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 me-1 mb-1 rounded-pill"><i class="bi bi-code-slash me-1"></i>${t}</span>`).join("");
  }
  
  // ลิงก์ดูภาพขนาดเต็ม
  const fullImgLink = document.getElementById("modalViewFullImgLink");
  if (fullImgLink) {
    fullImgLink.href = project.image;
  }

  // เปิด Modal ผ่าน Bootstrap API
  const modalElement = document.getElementById("projectDetailModal");
  const bsModal = bootstrap.Modal.getOrCreateInstance(modalElement);
  bsModal.show();
}

/* ==========================================================================
   ระบบสลับรูปภาพโปรไฟล์ (ครึ่งตัว / เต็มตัว)
   ========================================================================== */
let currentAvatarType = 'half';

function switchAvatar(type) {
  const avatarImg = document.getElementById("heroAvatarImg");
  const btnHalf = document.getElementById("btnAvatarHalf");
  const btnFull = document.getElementById("btnAvatarFull");
  const avatarTag = document.getElementById("avatarFloatingTag");

  if (!avatarImg) return;

  currentAvatarType = type;

  // Fade out effect
  avatarImg.style.opacity = '0';
  avatarImg.style.transform = 'scale(0.96)';

  setTimeout(() => {
    if (type === 'full') {
      avatarImg.src = 'img/Avatar/Avatar-full.png';
      avatarImg.alt = 'รูปนาย พงศกร บุษษะ (เต็มตัว)';
      avatarImg.classList.add('avatar-full-fit');
      if (avatarTag) avatarTag.innerHTML = '<i class="bi bi-person-standing me-1 text-info"></i> รูปเต็มตัว (Full Body)';
      
      btnFull?.classList.add('active');
      btnHalf?.classList.remove('active');
    } else {
      avatarImg.src = 'img/Avatar/Avatar-half.png';
      avatarImg.alt = 'รูปนาย พงศกร บุษษะ (ครึ่งตัว)';
      avatarImg.classList.remove('avatar-full-fit');
      if (avatarTag) avatarTag.innerHTML = '<i class="bi bi-person-badge me-1 text-info"></i> รูปครึ่งตัว (Portrait)';
      
      btnHalf?.classList.add('active');
      btnFull?.classList.remove('active');
    }

    // Fade in effect
    avatarImg.style.opacity = '1';
    avatarImg.style.transform = 'scale(1)';
  }, 200);
}

function toggleAvatar() {
  if (currentAvatarType === 'half') {
    switchAvatar('full');
  } else {
    switchAvatar('half');
  }
}

/* ==========================================================================
   ระบบตัวกรองประเภทผลงาน (Category Filter Buttons)
   ========================================================================== */
function initFilterButtons() {
  const filterBtns = document.querySelectorAll(".filter-btn");
  filterBtns.forEach(btn => {
    btn.addEventListener("click", function () {
      filterBtns.forEach(b => b.classList.remove("active"));
      this.classList.add("active");
      const category = this.getAttribute("data-filter");
      renderProjects(category);
    });
  });
}

/* ==========================================================================
   Navbar Shadow on Scroll
   ========================================================================== */
function initNavbar() {
  const navbar = document.querySelector(".custom-navbar");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 40) {
      navbar?.classList.add("scrolled");
    } else {
      navbar?.classList.remove("scrolled");
    }
  });
}

/* ==========================================================================
   Back to Top Button
   ========================================================================== */
function initBackToTop() {
  const btn = document.getElementById("backToTopBtn");
  if (!btn) return;

  window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
      btn.classList.add("show");
    } else {
      btn.classList.remove("show");
    }
  });

  btn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}
