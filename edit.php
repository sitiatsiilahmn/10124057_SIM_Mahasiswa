<?php
require_once __DIR__ . '/includes/init.php';
require_login();

// Ambil id unik dari GET (tampil form) atau POST (simpan perubahan)
$id = filter_var($_POST['id'] ?? $_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    flash_set('error', t('msg_not_found'));
    redirect('index.php');
}

// Ambil data lama
$stmt = db()->prepare('SELECT id, nim, nama, email, jurusan, angkatan, alamat FROM mahasiswa WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$data) {
    flash_set('error', t('msg_not_found'));
    redirect('index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $errors['general'] = t('err_csrf');
    } else {
        [$data, $errors] = validate_mahasiswa($_POST, db(), $id);

        if (!$errors) {
            try {
                // UPDATE
                $stmt = db()->prepare('UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, jurusan = ?, angkatan = ?, alamat = ? WHERE id = ?');
                $stmt->bind_param('ssssisi', $data['nim'], $data['nama'], $data['email'], $data['jurusan'], $data['angkatan'], $data['alamat'], $id);
                $stmt->execute();
                $stmt->close();
                flash_set('success', t('msg_updated'));
                redirect('index.php');
            } catch (mysqli_sql_exception $ex) {
                $errors['general'] = ($ex->getCode() === 1062) ? t('err_nim_duplicate') : t('err_db');
            }
        }
    }
}

$pageTitle   = t('edit_title');
$action      = 'edit.php?id=' . $id;
$submitLabel = t('btn_update');
$idHidden    = $id;
require __DIR__ . '/partials/header.php';
?>
<div class="card card-narrow">
    <h1><?= e(t('edit_title')) ?></h1>
    <?php require __DIR__ . '/partials/form_mahasiswa.php'; ?>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
