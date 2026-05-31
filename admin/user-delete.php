<?php require_once 'auth.php'; requireAdmin();
$id=(int)($_GET['id']??0);if($id != $_SESSION['user_id']){$stmt=$pdo->prepare('DELETE FROM users WHERE id=?');$stmt->execute([$id]);}header('Location: users.php');exit;
