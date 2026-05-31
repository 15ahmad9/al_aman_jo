<?php require_once 'auth.php';
requireLogin();
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM announcements WHERE id=?');
$stmt->execute([$id]);
$item = $stmt->fetch();
if (!$item) {
    header('Location: announcements.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $short = trim($_POST['short_description']);
    $desc = trim($_POST['description']);
    $link = normalizeUrl($_POST['link'] ?? '');
    $image = $item['image'];
    $new = uploadImage($_FILES['image'] ?? null, __DIR__ . '/../uploads/announcements');
    if ($new) {
        $image = $new;
    }
    $stmt = $pdo->prepare('UPDATE announcements SET title=?,short_description=?,description=?,image=?,link=? WHERE id=?');
    $stmt->execute([$title, $short, $desc, $image, $link, $id]);
    header('Location: announcements.php');
    exit;
}
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?>
    <main class="admin-content">
        <h1>تعديل إعلان</h1>
        <form method="POST" enctype="multipart/form-data" class="card">
            <input class="form-control" name="title" value="<?= e($item['title']) ?>" required>
            <input class="form-control" name="short_description" value="<?= e($item['short_description']) ?>" required>
            <textarea class="form-control" name="description" rows="7"
                required><?= e($item['description']) ?></textarea>
            <!-- <input class="form-control" type="url" name="link" placeholder="رابط خارجي اختياري"
                value="<?= e($item['link'] ?? '') ?>"> -->
            <input class="form-control" type="file" name="image">
            <button class="btn">تحديث</button>
        </form>
    </main>
</div>
</body>

</html>