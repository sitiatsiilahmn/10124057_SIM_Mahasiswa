<?php
/**
 * Konfigurasi & koneksi database (MySQL/MariaDB bawaan Laragon).
 * Default Laragon: user = root, password kosong, port 3306.
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_mahasiswa');

// Error SQL dilempar sebagai exception agar mudah ditangani
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function db(): mysqli
{
    static $conn = null;
    if ($conn === null) {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conn->set_charset('utf8mb4');
        } catch (mysqli_sql_exception $e) {
            http_response_code(500);
            die('Koneksi database gagal / Database connection failed. '
              . 'Pastikan MySQL Laragon berjalan & database "' . DB_NAME . '" sudah di-import.');
        }
    }
    return $conn;
}
