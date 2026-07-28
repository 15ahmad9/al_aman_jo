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
    $announcementId = $pdo->lastInsertId();
    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['name'] as $i => $n) {
            $file = ['name'=>$n,'type'=>$_FILES['files']['type'][$i],'tmp_name'=>$_FILES['files']['tmp_name'][$i],'error'=>$_FILES['files']['error'][$i]];
            $uploaded = uploadAttachment($file, __DIR__ . '/../uploads/announcements/files');
            if ($uploaded) {
                $f = $pdo->prepare('INSERT INTO announcement_files(announcement_id,file_name) VALUES(?,?)');
                $f->execute([$announcementId,$uploaded]);
            }
        }
    }
    header('Location: announcements.php');
    exit;
}
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?>
    <main class="admin-content">
        <h1>إضافة إعلان</h1>
        <form method="POST" enctype="multipart/form-data" class="card">
            <input class="form-control" name="title" placeholder="عنوان الإعلان" required>
            <input class="form-control" name="short_description" placeholder="وصف مختصر" >
            <textarea class="form-control" name="description" rows="7"
                placeholder="تفاصيل الإعلان - يمكنك كتابة رابط داخل الوصف مثل https://example.com"></textarea>
            <!-- <input class="form-control" type="url" name="link" placeholder="رابط خارجي اختياري مثل https://example.com"> -->
            <!-- <input class="form-control" type="file" name="image"> -->
            <label>ملفات مرفقة (صور أو PDF)</label>
            <input class="form-control" type="file" name="files[]" multiple accept=".jpg,.jpeg,.png,.webp,.pdf">
            <button class="btn">حفظ</button>
        </form>
    </main>
</div>
</body>

</html>