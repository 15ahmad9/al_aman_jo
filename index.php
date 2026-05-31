<?php
require_once 'config/db.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
$announcements = $pdo->query("SELECT * FROM announcements ORDER BY id DESC LIMIT 3")->fetchAll();
$members = $pdo->query("SELECT * FROM team_members ORDER BY id DESC")->fetchAll();
?>
<section class="hero">
    <h1>مرحباً بكم في شركتنا</h1>
    <p>نقدم حلولاً احترافية وخدمات مميزة تساعدكم على تحقيق أهدافكم.</p>
    <a class="btn" href="contact.php">تواصل معنا</a>
</section>
<section id="about" class="section">
    <h2 class="section-title">عن الشركة</h2>
    <div class="about-grid">
        <div>
            <p>نحن شركة متخصصة في تقديم خدمات عالية الجودة، نعمل على تطوير حلول عملية ومبتكرة تناسب احتياجات عملائنا.</p>
            <p>هدفنا بناء علاقة ثقة طويلة الأمد مع العملاء من خلال الاحترافية والالتزام والدقة في التنفيذ.</p>
        </div>
        <div class="about-logo">شعار الشركة</div>
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
    <div class="cards">
        <?php foreach ($members as $member): ?>
            <div class="card">
                <?php if ($member['image']): ?><img src="uploads/team/<?= e($member['image']) ?>" alt=""><?php else: ?><div class="placeholder-img">صورة العضو</div><?php endif; ?>
                <h3><?= e($member['name']) ?></h3>
                <p><?= e($member['position']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section class="section">
    <h2 class="section-title">تواصل معنا</h2>
    <div class="contact-grid">
        <div class="card">
            <h3>معلومات التواصل</h3>
            <p>الإيميل: info@company.com</p>
            <p>الهاتف: 0790000000</p>
        </div>
        <form class="card" action="contact.php" method="POST">
            <input class="form-control" type="text" name="name" placeholder="الاسم" required>
            <input class="form-control" type="email" name="email" placeholder="الإيميل" required>
            <input class="form-control" type="text" name="phone" placeholder="رقم الهاتف">
            <textarea class="form-control" name="message" placeholder="رسالتك" rows="5" required></textarea>
            <button class="btn" type="submit">إرسال</button>
        </form>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>
