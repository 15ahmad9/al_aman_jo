<?php
require_once 'auth.php';
requireLogin();
$id=(int)($_GET['id']??0);
$announcement=(int)($_GET['announcement_id']??0);
$stmt=$pdo->prepare('SELECT file_name FROM announcement_files WHERE id=?');
$stmt->execute([$id]);
$file=$stmt->fetch();
if($file){
    $path=__DIR__.'/../uploads/announcements/files/'.$file['file_name'];
    if(file_exists($path)) unlink($path);
    $del=$pdo->prepare('DELETE FROM announcement_files WHERE id=?');
    $del->execute([$id]);
}
header('Location: announcement-edit.php?id='.$announcement);
exit;
