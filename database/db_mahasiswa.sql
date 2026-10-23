-- =====================================================
-- Skrip Ekspor Database : db_mahasiswa
-- SIM Data Mahasiswa (PHP Murni + MySQL/MariaDB)
-- Cara import (Laragon): phpMyAdmin / HeidiSQL -> Import file ini
-- Login awal  : username = admin | password = admin123
-- =====================================================

CREATE DATABASE IF NOT EXISTS db_mahasiswa
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_mahasiswa;

DROP TABLE IF EXISTS mahasiswa;
DROP TABLE IF EXISTS users;

-- Tabel pengguna (untuk otentikasi login)
CREATE TABLE users (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username   VARCHAR(50)  NOT NULL,
  password   VARCHAR(255) NOT NULL,           -- hash bcrypt (password_hash)
  nama       VARCHAR(100) NOT NULL,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_users_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel data mahasiswa
CREATE TABLE mahasiswa (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nim        VARCHAR(15)  NOT NULL,
  nama       VARCHAR(100) NOT NULL,
  email      VARCHAR(100) NOT NULL,
  jurusan    VARCHAR(50)  NOT NULL,
  angkatan   SMALLINT UNSIGNED NOT NULL,
  alamat     VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_mahasiswa_nim (nim)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data awal: akun admin (password: admin123)
INSERT INTO users (username, password, nama) VALUES
('admin', '$2y$10$ZbaTH7YeylxL8xxZehQ/0.ITv/MUqaBJqQOtCKDQrNgHuwxeiTU4W', 'Administrator');

-- Data contoh mahasiswa
INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan, alamat) VALUES
('2023010001', 'Andi Pratama',  'andi.pratama@example.com',  'Teknik Informatika', 2023, 'Jl. Dago No. 12, Bandung'),
('2023010002', 'Siti Nurhaliza','siti.nurhaliza@example.com','Sistem Informasi',   2023, 'Jl. Setiabudi No. 45, Bandung'),
('2022020003', 'Budi Santoso',  'budi.santoso@example.com',  'Teknik Elektro',     2022, 'Jl. Cihampelas No. 8, Bandung'),
('2022030004', 'Dewi Lestari',  'dewi.lestari@example.com',  'Manajemen',          2022, 'Jl. Buah Batu No. 21, Bandung'),
('2021040005', 'Rizky Maulana', 'rizky.maulana@example.com', 'Akuntansi',          2021, NULL);
