<?php
require_once 'config/db.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM announcements WHERE id=?");
$stmt->execute([$id]);
$item = $stmt->fetch();
$files = [];
if ($item) { $f=$pdo->prepare('SELECT * FROM announcement_files WHERE announcement_id=?'); $f->execute([$id]); $files=$f->fetchAll(); }
?>
<section class="section">
    <?php if (!$item): ?>
        <div class="alert error">الإعلان غير موجود</div>
    <?php else: ?>
        <div class="card">
            <?php if ($item['image']): ?><img src="uploads/announcements/<?= e($item['image']) ?>" alt=""><?php endif; ?>
            <h1><?= e($item['title']) ?></h1>
            <p><?= clickableText($item['description']) ?></p>
            <?php if (!empty($files)): ?>
            <div class="announcement-files">
                <h3>المرفقات</h3>
                <?php foreach($files as $file): $ext=strtolower(pathinfo($file['file_name'], PATHINFO_EXTENSION)); ?>
                    <div class="attachment">
                        <div class="attachment-name"><?= e($file['file_name']) ?></div>
                    <?php if ($ext === 'pdf'): ?>
                        <a class="btn" target="_blank" href="uploads/announcements/files/<?= e($file['file_name']) ?>">عرض ملف PDF</a>
                    <?php else: ?>
                        <a target="_blank" href="uploads/announcements/files/<?= e($file['file_name']) ?>">
                            <img src="uploads/announcements/files/<?= e($file['file_name']) ?>" alt="<?= e($file['file_name']) ?>">
                        </a>
                    <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($item['link'])): ?>
                <a class="btn" href="<?= e($item['link']) ?>" target="_blank" rel="noopener noreferrer">زيارة الرابط</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
<?php require_once 'includes/footer.php'; ?>