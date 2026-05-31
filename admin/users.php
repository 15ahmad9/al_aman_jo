<?php require_once 'auth.php'; requireAdmin();
$items=$pdo->query('SELECT * FROM users ORDER BY id DESC')->fetchAll();require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?><main class="admin-content"><h1>إدارة المستخدمين</h1><a class="btn" href="user-add.php">إضافة مستخدم</a><br><br>
<table class="table"><tr><th>الاسم</th><th>الإيميل</th><th>الصلاحية</th><th>التحكم</th></tr><?php foreach($items as $item): ?><tr><td><?= e($item['name']) ?></td><td><?= e($item['email']) ?></td><td><?= e($item['role']) ?></td><td class="actions"><a class="btn btn-secondary" href="user-edit.php?id=<?= $item['id'] ?>">تعديل</a><?php if($item['id'] != $_SESSION['user_id']): ?><a class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')" href="user-delete.php?id=<?= $item['id'] ?>">حذف</a><?php endif; ?></td></tr><?php endforeach; ?></table>
</main></div></body></html>
