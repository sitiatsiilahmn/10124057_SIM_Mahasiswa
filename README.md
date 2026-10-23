# SIM Data Mahasiswa (PHP Murni + MySQL) - Laragon

## Cara menjalankan
1. Jalankan **Laragon** -> klik **Start All** (Apache + MySQL).
2. Salin folder `10124057_SIM_Mahasiswa` ke `C:\laragon\www\`.
3. Buka **HeidiSQL / phpMyAdmin** -> import `database/db_mahasiswa.sql` (database `db_mahasiswa` dibuat otomatis).
4. Buka browser: `http://localhost/10124057_SIM_Mahasiswa/` (atau `http://10124057_SIM_Mahasiswa.test` jika auto virtual host aktif).
5. Login: **admin / admin123**.

Koneksi DB ada di `config/database.php` (default Laragon: root, tanpa password).

## Struktur
```
sim_mahasiswa/
├─ config/database.php        koneksi MySQL
├─ includes/                  init, bahasa, fungsi (validasi, CSRF, auth)
├─ lang/id.php, en.php        kamus Bahasa Indonesia & Inggris
├─ partials/                  header, footer, form bersama
├─ assets/style.css
├─ login.php  logout.php  set_lang.php
├─ index.php (Read)  create.php  edit.php (Update)  delete.php
└─ database/db_mahasiswa.sql  skrip ekspor database
```
