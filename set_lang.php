<?php
require_once __DIR__ . '/includes/init.php';

// Simpan pilihan bahasa ke SESSION (hanya nilai yang ada di whitelist)
$lang = $_GET['lang'] ?? '';
if (in_array($lang, AVAILABLE_LANGS, true)) {
    $_SESSION['lang'] = $lang;
}

// Kembali ke halaman sebelumnya (hanya jika masih satu host)
$target = 'index.php';
$ref = $_SERVER['HTTP_REFERER'] ?? '';
if ($ref !== '') {
    $p = parse_url($ref);
    if (($p['host'] ?? '') === ($_SERVER['SERVER_NAME'] ?? '') || ($p['host'] ?? '') === explode(':', $_SERVER['HTTP_HOST'] ?? '')[0]) {
        $page = basename($p['path'] ?? '');
        if (in_array($page, ['index.php', 'create.php', 'edit.php', 'login.php'], true)) {
            $target = $page . (isset($p['query']) ? '?' . $p['query'] : '');
        }
    }
}
redirect($target);
