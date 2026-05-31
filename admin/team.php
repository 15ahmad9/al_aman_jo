<?php require_once 'auth.php'; requireLogin();
$items=$pdo->query('SELECT * FROM team_members ORDER BY id DESC')->fetchAll();require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?><main class="admin-content"><h1>إدارة أعضاء الشركة</h1><a class="btn" href="team-add.php">إضافة عضو</a><br><br>
<table class="table"><tr><th>الاسم</th><th>المنصب</th><th>التحكم</th></tr><?php foreach($items as $item): ?><tr><td><?= e($item['name']) ?></td><td><?= e($item['position']) ?></td><td class="actions"><a class="btn btn-secondary" href="team-edit.php?id=<?= $item['id'] ?>">تعديل</a><a class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')" href="team-delete.php?id=<?= $item['id'] ?>">حذف</a></td></tr><?php endforeach; ?></table>
</main></div></body></html>
