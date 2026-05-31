<?php require_once 'auth.php'; requireLogin();
$items = $pdo->query('SELECT * FROM announcements ORDER BY id DESC')->fetchAll();
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?><main class="admin-content">
<h1>إدارة الإعلانات</h1><a class="btn" href="announcement-add.php">إضافة إعلان</a><br><br>
<table class="table"><tr><th>العنوان</th><th>الوصف المختصر</th><th>التحكم</th></tr>
<?php foreach($items as $item): ?><tr><td><?= e($item['title']) ?></td><td><?= e($item['short_description']) ?></td><td class="actions"><a class="btn btn-secondary" href="announcement-edit.php?id=<?= $item['id'] ?>">تعديل</a><a class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')" href="announcement-delete.php?id=<?= $item['id'] ?>">حذف</a></td></tr><?php endforeach; ?>
</table></main></div></body></html>
