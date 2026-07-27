<aside class="sidebar">
    <h2>لوحة التحكم</h2>
    <p><?= e($_SESSION['name'] ?? '') ?> - <?= e($_SESSION['role'] ?? '') ?></p>
    <br>
    <a href="dashboard.php">الرئيسية</a>
    <a href="announcements.php">إدارة الإعلانات</a>
    
    <a href="messages.php">رسائل التواصل</a>
    <?php if (($_SESSION['role'] ?? '') === 'Admin'): ?>
<a href="team.php">إدارة الأعضاء</a>
        <a href="users.php">إدارة المستخدمين</a>
    <?php endif; ?>
    <a href="../index.php">عرض الموقع</a>
    <a href="logout.php">تسجيل الخروج</a>
</aside>
