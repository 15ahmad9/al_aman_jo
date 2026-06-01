<?php require_once 'auth.php';
requireLogin();
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM team_members WHERE id=?');
$stmt->execute([$id]);
$item = $stmt->fetch();
if (!$item) {
    header('Location: team.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $image = $item['image'];
    $new = uploadImage($_FILES['image'] ?? null, __DIR__ . '/../uploads/team');
    if ($new) {
        $image = $new;
    }
$member_type = $_POST['member_type'];

$stmt = $pdo->prepare("
    UPDATE team_members
    SET
        name=?,
        position=?,
        image=?,
        member_type=?
    WHERE id=?
");

$stmt->execute([
    $name,
    $position,
    $image,
    $member_type,
    $id
]);
    header('Location: team.php');
    exit;
}
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?>
    <main class="admin-content">
        <h1>تعديل عضو</h1>
        <form method="POST" enctype="multipart/form-data" class="card">
            <input class="form-control" name="name"
                value="<?= e($item['name']) ?>" required>
            <input class="form-control" name="position"
                value="<?= e($item['position']) ?>" required>
                <select
    class="form-control"
    name="member_type"
    required>

    <option
        value="board"
        <?= $item['member_type'] === 'board' ? 'selected' : '' ?>>
        عضو مجلس إدارة
    </option>

    <option
        value="executive"
        <?= $item['member_type'] === 'executive' ? 'selected' : '' ?>>
        الإدارة التنفيذية العليا
    </option>

</select>
            <input class="form-control" type="file"
                name="image">
            <button class="btn">تحديث</button>
        </form>
    </main>
</div>
</body>

</html>