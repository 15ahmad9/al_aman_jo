<?php
require_once 'config/db.php';
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name && $email && $message) {
        $stmt = $pdo->prepare("INSERT INTO contact_messages(name,email,phone,message) VALUES(?,?,?,?)");
        $stmt->execute([$name, $email, $phone, $message]);
        header('Location: contact.php?success=1'); exit;
    }
}
$success = isset($_GET['success']);
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<section class="section">
    <h2 class="section-title">تواصل معنا</h2>
    <?php if ($success): ?><div class="alert success">تم إرسال الرسالة بنجاح</div><?php endif; ?>
    <div class="contact-grid">

    <div class="contact-info card">

        <h3>
            <i class="fas fa-address-card"></i>
            معلومات التواصل
        </h3>

        <div class="contact-item">

            <div class="contact-icon">
                <i class="fas fa-envelope"></i>
            </div>

            <div>
                <strong>البريد الإلكتروني</strong>
                <p>
                    <a href="mailto:israatemp@gmail.com">
                        israatemp@gmail.com
                    </a>
                </p>
            </div>

        </div>

        <div class="contact-item">

            <div class="contact-icon">
                <i class="fas fa-phone"></i>
            </div>

            <div>
                <strong>الهاتف</strong>
                <p>
                    <a href="tel:+96265538450">
                        0096265538450
                    </a>
                </p>
            </div>

        </div>

        <div class="contact-item">

            <div class="contact-icon">
                <i class="fas fa-mobile-alt"></i>
            </div>

            <div>
                <strong>رقم الموبايل</strong>
                <p>
                    <a href="tel:+962777666294">
                        00962777666294
                    </a>
                </p>
            </div>

        </div>

    </div>

    <form class="contact-form card" method="POST">

        <h3>
            <i class="fas fa-paper-plane"></i>
            أرسل لنا رسالة
        </h3>

        <input
            class="form-control"
            type="text"
            name="name"
            placeholder="الاسم الكامل"
            required>

        <input
            class="form-control"
            type="email"
            name="email"
            placeholder="البريد الإلكتروني"
            required>

        <input
            class="form-control"
            type="text"
            name="phone"
            placeholder="رقم الهاتف">

        <textarea
            class="form-control"
            name="message"
            rows="6"
            placeholder="اكتب رسالتك هنا..."
            required></textarea>

        <button class="btn contact-btn">
            <i class="fas fa-paper-plane"></i>
            إرسال الرسالة
        </button>

    </form>

</div>
</section>
<?php require_once 'includes/footer.php'; ?>
