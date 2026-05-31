<?php require_once 'auth.php'; requireLogin();
$items=$pdo->query('SELECT * FROM contact_messages ORDER BY id DESC')->fetchAll();require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?><main class="admin-content"><h1>رسائل التواصل</h1>
<table class="table"><tr><th>الاسم</th><th>الإيميل</th><th>الهاتف</th><th>الرسالة</th><th>التاريخ</th></tr><?php foreach($items as $item): ?><tr><td><?= e($item['name']) ?></td><td><?= e($item['email']) ?></td><td><?= e($item['phone']) ?></td><td><?= nl2br(e($item['message'])) ?></td><td><?= e($item['created_at']) ?></td></tr><?php endforeach; ?></table>
</main></div></body></html>
