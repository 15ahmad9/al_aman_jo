<?php
session_start();
require_once __DIR__ . '/../config/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email=? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        header('Location: dashboard.php'); exit;
    } else {
        $error = 'بيانات الدخول غير صحيحة';
    }
}
require_once 'header.php';
require_once 'navbar-public.php';
?>
<div class="login-box">
    <h2>تسجيل دخول المسؤول</h2>
    <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
    <form method="POST">
        <input class="form-control" type="email" name="email" placeholder="الإيميل" required>
        <input class="form-control" type="password" name="password" placeholder="كلمة المرور" required>
        <button class="btn" type="submit">دخول</button>
    </form>
    <p style="margin-top:15px">Admin: admin@company.com / Admin12345</p>
</div>
</body></html>
