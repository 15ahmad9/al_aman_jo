<?php
require_once 'config/db.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
$announcements = $pdo->query("SELECT * FROM announcements ORDER BY id DESC LIMIT 3")->fetchAll();
$boardMembers = $pdo->query("SELECT * FROM team_members WHERE member_type = 'board' ORDER BY id DESC")->fetchAll();
$executiveMembers = $pdo->query("SELECT * FROM team_members WHERE member_type = 'executive' ORDER BY id DESC")->fetchAll();?>
<section class="hero">

    <div class="hero-slider">

        <img src="assets/images/hero1.jpg" class="slide active">
        <img src="assets/images/hero2.jpg" class="slide">
        <img src="assets/images/hero3.jpg" class="slide">

    </div>

    <div class="hero-content">
        <h1>مرحباً بكم في شركة دار الأمان للإستثمار</h1>

        <p>
            شركة مساهمة عامة محدودة متخصصة في الاستثمار
            والتطوير العقاري والخدمات الاستثمارية.
        </p>

        <a class="btn" href="contact.php">
            تواصل معنا
        </a>
    </div>

</section>
<section id="about" class="section">
    <h2 class="section-title">عن الشركة</h2>

    <div class="about-grid">
        <div>
            <p>
                تأسست شركة دار الأمان للإستثمار بتاريخ 20 نيسان 2008
                كشركة مساهمة عامة محدودة في سجل الشركات المساهمة العامة
                تحت الرقم (451) برأسمال (5,000,000) مليون دينار.
            </p>

            <p>
                تهدف شركة دار الأمان إلى تحقيق الغايات المنصوص عليها في عقد
                تأسيسها ونظامها الأساسي، ومن أهمها:
            </p>

            <ul class="about-list">
                <li>أنشطة تطوير الأراضي المملوكة ملكية خاصة دون التشييد.</li>
                <li>تأجير وإدارة المحلات والمجمعات التجارية المملوكة ملكية خاصة.</li>
                <li>شراء وبيع العقارات الخاصة.</li>
                <li>أنشطة شركات الإستثمار المشترك.</li>
                <li>خدمات الدراسات الإكتوارية.</li>
                <li>دراسات وأبحاث السوق.</li>
                <li>صناديق وحدات الإستثمار الإئتمانية والإتحادات الإحتكارية أو التركات أو حسابات الوكالات.</li>
                <li>أنشطة صناديق الإستثمار المشترك.</li>
                <li>أنشطة خدمات التسويق.</li>
            </ul>
        </div>

        <div class="about-logo">
            <img src="assets/images/logo.png"   style="
    border-radius: 15px;
" alt="شعار شركة دار الأمان للإستثمار">
        </div>
    </div>
</section>
<section class="section">
    <h2 class="section-title">أحدث الإعلانات</h2>
    <div class="cards">
        <?php foreach ($announcements as $item): ?>
            <div class="card">
                <?php if ($item['image']): ?><img src="uploads/announcements/<?= e($item['image']) ?>" alt=""><?php else: ?><div class="placeholder-img">إعلان</div><?php endif; ?>
                <h3><?= e($item['title']) ?></h3>
                <p><?= e($item['short_description']) ?></p>
                <a class="btn" href="announcement-details.php?id=<?= $item['id'] ?>">عرض التفاصيل</a>
                <?php if (!empty($item['link'])): ?>
                    <a class="btn btn-secondary" href="<?= e($item['link']) ?>" target="_blank" rel="noopener noreferrer">زيارة الرابط</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section id="team" class="section">
    <h2 class="section-title">أعضاء الشركة</h2>

    <h3 class="sub-section-title" style="
    margin: 15px 0;" >أعضاء مجلس الإدارة</h3>
    <div class="cards">
        <?php foreach ($boardMembers as $member): ?>
            <div class="card">
                <?php if ($member['image']): ?>
                    <img src="uploads/team/<?= e($member['image']) ?>" alt="">
                <?php else: ?>
                    <div class="placeholder-img">صورة العضو</div>
                <?php endif; ?>

                <h3><?= e($member['name']) ?></h3>
                <p><?= e($member['position']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <h3 class="sub-section-title" style="
    margin: 15px 0;" >الإدارة التنفيذية العليا</h3>
    <div class="cards">
        <?php foreach ($executiveMembers as $member): ?>
            <div class="card">
                <?php if ($member['image']): ?>
                    <img src="uploads/team/<?= e($member['image']) ?>" alt="">
                <?php else: ?>
                    <div class="placeholder-img">صورة العضو</div>
                <?php endif; ?>

                <h3><?= e($member['name']) ?></h3>
                <p><?= e($member['position']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="card auditor-card">
        <h3>مدقق الحسابات الخارجي للشركة</h3>
        <p>شركة سمان وشركاه محاسبون قانونيون ومستشارون ماليون</p>
    </div>
</section>
<section class="section">
    <h2 class="section-title">تواصل معنا</h2>
<div class="contact-grid">

    <div class="contact-info card">

        <h3>
            <i class="fas fa-address-card"></i>
            معلومات التواصل
        </h3>

        <div class="contact-item">

            <div class="contact-icon">
                <i class="fas fa-envelope"></i>
            </div>

            <div>
                <strong>البريد الإلكتروني</strong>
                <p>
                    <a href="mailto:israatemp@gmail.com">
                        israatemp@gmail.com
                    </a>
                </p>
            </div>

        </div>

        <div class="contact-item">

            <div class="contact-icon">
                <i class="fas fa-phone"></i>
            </div>

            <div>
                <strong>الهاتف</strong>
                <p>
                    <a href="tel:065538450">
                        065538450
                    </a>
                </p>
            </div>

        </div>

        <div class="contact-item">

            <div class="contact-icon">
                <i class="fas fa-mobile-alt"></i>
            </div>

            <div>
                <strong>رقم الموبايل</strong>
                <p>
                    <a href="tel:0777666294">
                        0777666294
                    </a>
                </p>
            </div>

        </div>

    </div>

    <form class="contact-form card" method="POST">

        <h3>
            <i class="fas fa-paper-plane"></i>
            أرسل لنا رسالة
        </h3>

        <input
            class="form-control"
            type="text"
            name="name"
            placeholder="الاسم الكامل"
            required>

        <input
            class="form-control"
            type="email"
            name="email"
            placeholder="البريد الإلكتروني"
            required>

        <input
            class="form-control"
            type="text"
            name="phone"
            placeholder="رقم الهاتف">

        <textarea
            class="form-control"
            name="message"
            rows="6"
            placeholder="اكتب رسالتك هنا..."
            required></textarea>

        <button class="btn contact-btn">
            <i class="fas fa-paper-plane"></i>
            إرسال الرسالة
        </button>

    </form>

</div>
</section>
<?php require_once 'includes/footer.php'; ?>

<script src="assets/js/main.js"></script>