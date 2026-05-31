<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

function requireLogin() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php'); exit;
    }
}

function requireAdmin() {
    requireLogin();
    if ($_SESSION['role'] !== 'Admin') {
        header('Location: dashboard.php'); exit;
    }
}
