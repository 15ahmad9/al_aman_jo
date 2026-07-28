<?php
function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function uploadImage($file, $targetDir) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowed)) {
        return null;
    }

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = uniqid('img_', true) . '.' . $extension;
    $fullPath = rtrim($targetDir, '/') . '/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $fullPath)) {
        return $fileName;
    }

    return null;
}


function uploadAttachment($file, $targetDir) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return null;
    $allowed = ['jpg','jpeg','png','gif','webp','pdf'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return null;
    if (!is_dir($targetDir)) mkdir($targetDir,0777,true);
    // Keep the original uploaded file name
    $name = basename($file['name']);

    // Remove unsafe characters from the file name while preserving the original name as much as possible
    $name = preg_replace('/[^A-Za-z0-9._\-\x{0600}-\x{06FF}]+/u', '_', $name);

    // If a file with the same name already exists, replace it
    $fullPath = rtrim($targetDir,'/').'/'.$name;

    if (move_uploaded_file($file['tmp_name'], $fullPath)) return $name;
    return null;
}

function normalizeUrl($url) {
    $url = trim($url ?? '');
    if ($url === '') {
        return null;
    }

    if (!preg_match('/^https?:\/\//i', $url)) {
        $url = 'https://' . $url;
    }

    return filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
}

function clickableText($text) {
    $escaped = e($text);

    return preg_replace_callback(
        '/(https?:\/\/[^\s<]+)/i',
        function ($matches) {
            $url = $matches[1];
            return '<a href="' . e($url) . '" target="_blank" rel="noopener noreferrer">' . e($url) . '</a>';
        },
        nl2br($escaped)
    );
}
