<?php
require_once 'config/db.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM announcements WHERE id=?");
$stmt->execute([$id]);
$item = $stmt->fetch();
?>
<section class="section">
    <?php if (!$item): ?>
        <div class="alert error">الإعلان غير موجود</div>
    <?php else: ?>
        <div class="card">
            <?php if ($item['image']): ?><img src="uploads/announcements/<?= e($item['image']) ?>" alt=""><?php endif; ?>
            <h1><?= e($item['title']) ?></h1>
            <p><?= clickableText($item['description']) ?></p>
            <?php if (!empty($item['link'])): ?>
                <a class="btn" href="<?= e($item['link']) ?>" target="_blank" rel="noopener noreferrer">زيارة الرابط</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
<?php require_once 'includes/footer.php'; ?>