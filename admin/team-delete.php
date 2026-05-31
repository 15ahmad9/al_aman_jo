<?php require_once 'auth.php'; requireLogin();
$id=(int)($_GET['id']??0);$stmt=$pdo->prepare('DELETE FROM team_members WHERE id=?');$stmt->execute([$id]);header('Location: team.php');exit;
