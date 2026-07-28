<?php require_once 'auth.php';
requireLogin();
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM announcements WHERE id=?');
$stmt->execute([$id]);
$item = $stmt->fetch();
$filesStmt = $pdo->prepare('SELECT * FROM announcement_files WHERE announcement_id=? ORDER BY id DESC');
$filesStmt->execute([$id]);
$files = $filesStmt->fetchAll();
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
    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['name'] as $i => $n) {
            $file = ['name'=>$n,'type'=>$_FILES['files']['type'][$i],'tmp_name'=>$_FILES['files']['tmp_name'][$i],'error'=>$_FILES['files']['error'][$i]];
            $uploaded = uploadAttachment($file, __DIR__ . '/../uploads/announcements/files');
            if ($uploaded) {
                $f = $pdo->prepare('INSERT INTO announcement_files(announcement_id,file_name) VALUES(?,?)');
                $f->execute([$id,$uploaded]);
            }
        }
    }
    header('Location: announcements.php');
    exit;
}
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?>
    <main class="admin-content">
        <h1>تعديل إعلان</h1>
        <form method="POST" enctype="multipart/form-data" class="card">
            <input class="form-control" name="title" value="<?= e($item['title']) ?>" required>
            <input class="form-control" name="short_description" value="<?= e($item['short_description']) ?>">
            <textarea class="form-control" name="description" rows="7"><?= e($item['description']) ?></textarea>
            <!-- <input class="form-control" type="url" name="link" placeholder="رابط خارجي اختياري"
                value="<?= e($item['link'] ?? '') ?>"> -->
            <h3>الملفات المرفوعة</h3>
<div class="uploaded-files">
<?php foreach($files as $file): ?>
<div class="file-item">
<?php $ext=strtolower(pathinfo($file['file_name'], PATHINFO_EXTENSION)); ?>
<?php if(in_array($ext,['jpg','jpeg','png','webp'])): ?>
<img src="../uploads/announcements/files/<?= e($file['file_name']) ?>" style="width:120px;height:80px;object-fit:cover;">
<?php else: ?>
<a target="_blank" href="../uploads/announcements/files/<?= e($file['file_name']) ?>">📄 <?= e($file['file_name']) ?></a>
<?php endif; ?>
<a class="btn btn-danger" onclick="return confirm('حذف الملف؟')" href="announcement-file-delete.php?id=<?= $file['id'] ?>&announcement_id=<?= $id ?>">حذف</a>
</div>
<?php endforeach; ?>
</div>
<!-- <input class="form-control" type="file" name="image"> -->
<label>إضافة ملفات مرفقة</label>
<input class="form-control" type="file" name="files[]" multiple accept=".jpg,.jpeg,.png,.webp,.pdf">
            <button class="btn">تحديث</button>
        </form>
    </main>
</div>
</body>

</html>