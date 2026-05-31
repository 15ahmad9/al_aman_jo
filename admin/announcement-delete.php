<?php require_once 'auth.php'; requireLogin();
$id=(int)($_GET['id']??0);$stmt=$pdo->prepare('DELETE FROM announcements WHERE id=?');$stmt->execute([$id]);header('Location: announcements.php');exit;
