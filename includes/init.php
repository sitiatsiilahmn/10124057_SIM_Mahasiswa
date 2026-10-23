<?php
// Dimuat di awal setiap halaman: session, koneksi, bahasa, fungsi bantu.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/lang.php';
require_once __DIR__ . '/functions.php';
