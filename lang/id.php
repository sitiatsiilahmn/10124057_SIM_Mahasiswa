<?php
return [
    'app_title' => 'SIM Data Mahasiswa',
    'hello' => 'Halo',
    'nav_data' => 'Data Mahasiswa',
    'nav_add' => 'Tambah Data',
    'nav_logout' => 'Keluar',

    // Login
    'login_title' => 'Masuk ke Sistem',
    'login_subtitle' => 'Silakan login untuk mengelola data mahasiswa.',
    'username' => 'Username',
    'password' => 'Password',
    'btn_login' => 'Masuk',
    'err_login_empty' => 'Username dan password wajib diisi.',
    'err_login_failed' => 'Username atau password salah.',
    'logout_success' => 'Anda berhasil keluar.',
    'login_required' => 'Silakan login terlebih dahulu.',

    // Umum
    'btn_save' => 'Simpan',
    'btn_update' => 'Perbarui',
    'btn_cancel' => 'Batal',
    'btn_edit' => 'Edit',
    'btn_delete' => 'Hapus',
    'btn_search' => 'Cari',
    'btn_reset' => 'Reset',
    'actions' => 'Aksi',
    'no' => 'No',
    'err_csrf' => 'Token keamanan tidak valid. Muat ulang halaman lalu coba lagi.',
    'err_db' => 'Terjadi kesalahan pada database. Silakan coba lagi.',

    // Daftar
    'list_title' => 'Daftar Mahasiswa',
    'search_placeholder' => 'Cari NIM / nama / jurusan...',
    'total_data' => 'Total data: %d',
    'no_data' => 'Belum ada data.',
    'confirm_delete' => 'Yakin ingin menghapus data ini?',

    // Form
    'add_title' => 'Tambah Data Mahasiswa',
    'edit_title' => 'Ubah Data Mahasiswa',
    'f_nim' => 'NIM',
    'f_nama' => 'Nama Lengkap',
    'f_email' => 'Email',
    'f_jurusan' => 'Jurusan',
    'f_angkatan' => 'Angkatan',
    'f_alamat' => 'Alamat',
    'choose_jurusan' => '-- Pilih Jurusan --',

    // Pesan
    'msg_created' => 'Data mahasiswa berhasil ditambahkan.',
    'msg_updated' => 'Data mahasiswa berhasil diperbarui.',
    'msg_deleted' => 'Data mahasiswa berhasil dihapus.',
    'msg_not_found' => 'Data tidak ditemukan.',

    // Validasi
    'err_form_summary' => 'Data belum lengkap/valid. Periksa kembali isian di bawah.',
    'err_nim_required' => 'NIM wajib diisi.',
    'err_nim_format' => 'NIM harus berupa angka 8-15 digit.',
    'err_nim_duplicate' => 'NIM sudah terdaftar.',
    'err_nama_required' => 'Nama wajib diisi.',
    'err_nama_length' => 'Nama harus 3-100 karakter.',
    'err_nama_format' => 'Nama hanya boleh berisi huruf, spasi, titik, apostrof, dan tanda hubung.',
    'err_email_required' => 'Email wajib diisi.',
    'err_email_format' => 'Format email tidak valid.',
    'err_jurusan_required' => 'Jurusan wajib dipilih.',
    'err_jurusan_invalid' => 'Jurusan tidak valid.',
    'err_angkatan_required' => 'Angkatan wajib diisi.',
    'err_angkatan_range' => 'Angkatan harus berupa tahun antara 2000 dan %d.',
    'err_alamat_length' => 'Alamat maksimal 255 karakter.',
];
