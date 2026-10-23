<?php
require_once __DIR__ . '/includes/init.php';
require_login();

// Hapus hanya lewat POST + token CSRF (tidak lewat link GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

if (!csrf_verify($_POST['csrf_token'] ?? '')) {
    flash_set('error', t('err_csrf'));
    redirect('index.php');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    flash_set('error', t('msg_not_found'));
    redirect('index.php');
}

try {
    // DELETE
    $stmt = db()->prepare('DELETE FROM mahasiswa WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $deleted = $stmt->affected_rows > 0;
    $stmt->close();
    flash_set($deleted ? 'success' : 'error', $deleted ? t('msg_deleted') : t('msg_not_found'));
} catch (mysqli_sql_exception $ex) {
    flash_set('error', t('err_db'));
}
redirect('index.php');
