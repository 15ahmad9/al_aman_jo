<?php
require_once 'auth.php';
requireLogin();
$announcementsCount = $pdo->query('SELECT COUNT(*) FROM announcements')->fetchColumn();
$teamCount = $pdo->query('SELECT COUNT(*) FROM team_members')->fetchColumn();
$messagesCount = $pdo->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn();
$usersCount = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
require_once 'header.php';
?>
<div class="admin-layout">
<?php require_once 'sidebar.php'; ?>
<main class="admin-content">
    <h1>أهلاً بك في لوحة التحكم</h1>
    <div class="cards" style="margin-top:25px">
        <div class="card"><h3>الإعلانات</h3><p><?= $announcementsCount ?></p></div>
        <div class="card"><h3>أعضاء الشركة</h3><p><?= $teamCount ?></p></div>
        <div class="card"><h3>الرسائل</h3><p><?= $messagesCount ?></p></div>
        <?php if ($_SESSION['role'] === 'Admin'): ?><div class="card"><h3>المستخدمون</h3><p><?= $usersCount ?></p></div><?php endif; ?>
    </div>
</main>
</div>
</body></html>
