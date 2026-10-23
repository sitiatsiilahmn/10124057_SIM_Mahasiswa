<?php
require_once __DIR__ . '/includes/init.php';

$lang = $_SESSION['lang'] ?? 'id';   // bahasa tetap dipertahankan setelah logout

$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $c = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $c['path'], $c['domain'], $c['secure'], $c['httponly']);
}
session_destroy();

session_start();
session_regenerate_id(true);
$_SESSION['lang'] = $lang;
$GLOBALS['TRANSLATIONS'] = require __DIR__ . '/lang/' . $lang . '.php';
flash_set('success', t('logout_success'));
redirect('login.php');
