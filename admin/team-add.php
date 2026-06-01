<?php require_once 'auth.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $member_type = $_POST['member_type'];

    $image = uploadImage(
        $_FILES['image'] ?? null,
        __DIR__ . '/../uploads/team'
    );

    $stmt = $pdo->prepare("
        INSERT INTO team_members
        (name,position,image,member_type)
        VALUES(?,?,?,?)
    ");

    $stmt->execute([
        $name,
        $position,
        $image,
        $member_type
    ]);

    header('Location: team.php');
    exit;
}
require_once 'header.php'; ?>
<div class="admin-layout"><?php require_once 'sidebar.php'; ?>
    <main class="admin-content">
        <h1>إضافة عضو</h1>
<form method="POST" enctype="multipart/form-data" class="card">

    <input
        class="form-control"
        name="name"
        placeholder="اسم العضو"
        required>

    <input
        class="form-control"
        name="position"
        placeholder="المنصب"
        required>

    <select
        class="form-control"
        name="member_type"
        required>

        <option value="board">عضو مجلس إدارة</option>
        <option value="executive">الإدارة التنفيذية العليا</option>

    </select>

    <input
        class="form-control"
        type="file"
        name="image">

    <button class="btn">حفظ</button>

</form>
    </main>
</div>
</body>

</html>