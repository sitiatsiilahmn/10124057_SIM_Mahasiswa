<?php
require_once __DIR__ . '/includes/init.php';
require_login();

$data   = ['nim' => '', 'nama' => '', 'email' => '', 'jurusan' => '', 'angkatan' => '', 'alamat' => ''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $errors['general'] = t('err_csrf');
    } else {
        [$data, $errors] = validate_mahasiswa($_POST, db());

        if (!$errors) {
            try {
                // CREATE
                $stmt = db()->prepare('INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan, alamat) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('ssssis', $data['nim'], $data['nama'], $data['email'], $data['jurusan'], $data['angkatan'], $data['alamat']);
                $stmt->execute();
                $stmt->close();
                flash_set('success', t('msg_created'));
                redirect('index.php');
            } catch (mysqli_sql_exception $ex) {
                $errors['general'] = ($ex->getCode() === 1062) ? t('err_nim_duplicate') : t('err_db');
            }
        }
    }
}

$pageTitle   = t('add_title');
$action      = 'create.php';
$submitLabel = t('btn_save');
require __DIR__ . '/partials/header.php';
?>
<div class="card card-narrow">
    <h1><?= e(t('add_title')) ?></h1>
    <?php require __DIR__ . '/partials/form_mahasiswa.php'; ?>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
