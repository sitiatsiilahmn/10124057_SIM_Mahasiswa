<?php
/* ---------- Sanitasi output ---------- */
function e($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/* ---------- Otentikasi ---------- */
function is_logged_in(): bool
{
    return !empty($_SESSION['user_id']);
}

/** Proteksi halaman: wajib login, jika tidak diarahkan ke login.php */
function require_login(): void
{
    if (!is_logged_in()) {
        redirect('login.php');
    }
}

/* ---------- CSRF ---------- */
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify($token): bool
{
    return is_string($token) && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

/* ---------- Flash message ---------- */
function flash_set(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array
{
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

/* ---------- Data master ---------- */
function jurusan_list(): array
{
    return ['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen', 'Akuntansi'];
}

/* ---------- Validasi & sanitasi form mahasiswa ---------- */
/**
 * @return array [$data, $errors]
 *  - $data   : data yang sudah dibersihkan (trim, spasi dirapikan)
 *  - $errors : pesan error per field (kosong = valid)
 */
function validate_mahasiswa(array $input, mysqli $conn, int $ignoreId = 0): array
{
    // 1) Sanitasi: trim & rapikan spasi
    $data = [
        'nim'      => trim((string)($input['nim'] ?? '')),
        'nama'     => preg_replace('/\s+/', ' ', trim((string)($input['nama'] ?? ''))),
        'email'    => trim((string)($input['email'] ?? '')),
        'jurusan'  => trim((string)($input['jurusan'] ?? '')),
        'angkatan' => trim((string)($input['angkatan'] ?? '')),
        'alamat'   => trim((string)($input['alamat'] ?? '')),
    ];
    $errors = [];

    // 2) Validasi NIM (if - elseif - else)
    if ($data['nim'] === '') {
        $errors['nim'] = t('err_nim_required');
    } elseif (!preg_match('/^[0-9]{8,15}$/', $data['nim'])) {
        $errors['nim'] = t('err_nim_format');
    } else {
        $stmt = $conn->prepare('SELECT id FROM mahasiswa WHERE nim = ? AND id <> ? LIMIT 1');
        $stmt->bind_param('si', $data['nim'], $ignoreId);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors['nim'] = t('err_nim_duplicate');
        }
        $stmt->close();
    }

    // 3) Validasi nama
    if ($data['nama'] === '') {
        $errors['nama'] = t('err_nama_required');
    } elseif (mb_strlen($data['nama']) < 3 || mb_strlen($data['nama']) > 100) {
        $errors['nama'] = t('err_nama_length');
    } elseif (!preg_match("/^[\p{L}\s.'-]+$/u", $data['nama'])) {
        $errors['nama'] = t('err_nama_format');
    }

    // 4) Validasi email dengan filter_var()
    if ($data['email'] === '') {
        $errors['email'] = t('err_email_required');
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = t('err_email_format');
    }

    // 5) Validasi jurusan (switch)
    switch (true) {
        case $data['jurusan'] === '':
            $errors['jurusan'] = t('err_jurusan_required');
            break;
        case !in_array($data['jurusan'], jurusan_list(), true):
            $errors['jurusan'] = t('err_jurusan_invalid');
            break;
        default:
            break; // valid
    }

    // 6) Validasi angkatan dengan filter_var() (integer + rentang)
    if ($data['angkatan'] === '') {
        $errors['angkatan'] = t('err_angkatan_required');
    } else {
        $thn = filter_var($data['angkatan'], FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 2000, 'max_range' => (int)date('Y')],
        ]);
        if ($thn === false) {
            $errors['angkatan'] = t('err_angkatan_range', (int)date('Y'));
        } else {
            $data['angkatan'] = $thn;
        }
    }

    // 7) Alamat (opsional)
    if (mb_strlen($data['alamat']) > 255) {
        $errors['alamat'] = t('err_alamat_length');
    }

    return [$data, $errors];
}
