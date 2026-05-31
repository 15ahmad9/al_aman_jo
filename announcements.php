<?php
require_once 'config/db.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
$announcements = $pdo->query("SELECT * FROM announcements ORDER BY id DESC")->fetchAll();
?>
<section class="section">
    <h2 class="section-title">جميع الإعلانات</h2>
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
<?php require_once 'includes/footer.php'; ?>
