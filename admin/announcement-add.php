<?php require_once 'auth.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $short = trim($_POST['short_description']);
    $desc = trim($_POST['description']);
    $link = normalizeUrl($_POST['link'] ?? '');
    $image = uploadImage($_FILES['image'] ?? null, __DIR__ . '/../uploads/announcements');
    $stmt = $pdo->prepare('INSERT INTO announcements(title,short_description,description,image,link) VALUES(?,?,?,?,?)');
    $stmt->execute([$title, $short, $desc, $image, $link]);
    header('Location: announcements.php');
    exit;
}
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?>
    <main class="admin-content">
        <h1>إضافة إعلان</h1>
        <form method="POST" enctype="multipart/form-data" class="card">
            <input class="form-control" name="title" placeholder="عنوان الإعلان" required>
            <input class="form-control" name="short_description" placeholder="وصف مختصر" required>
            <textarea class="form-control" name="description" rows="7"
                placeholder="تفاصيل الإعلان - يمكنك كتابة رابط داخل الوصف مثل https://example.com" required></textarea>
            <!-- <input class="form-control" type="url" name="link" placeholder="رابط خارجي اختياري مثل https://example.com"> -->
            <input class="form-control" type="file" name="image">
            <button class="btn">حفظ</button>
        </form>
    </main>
</div>
</body>

</html>