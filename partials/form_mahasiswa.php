<?php
/** Variabel: $data, $errors, $action, $submitLabel, $idHidden (opsional) */
$err = function (string $f) use ($errors) {
    return isset($errors[$f]) ? '<span class="error">' . e($errors[$f]) . '</span>' : '';
};
?>
<?php if (!empty($errors['general'])): ?>
    <div class="alert alert-error"><?= e($errors['general']) ?></div>
<?php elseif ($errors): ?>
    <div class="alert alert-error"><?= e(t('err_form_summary')) ?></div>
<?php endif; ?>

<form method="POST" action="<?= e($action) ?>" novalidate>
    <?= csrf_field() ?>
    <?php if (!empty($idHidden)): ?>
        <input type="hidden" name="id" value="<?= (int)$idHidden ?>">
    <?php endif; ?>

    <div class="form-group">
        <label for="nim"><?= e(t('f_nim')) ?> *</label>
        <input type="text" id="nim" name="nim" maxlength="15" value="<?= e($data['nim']) ?>" class="<?= isset($errors['nim']) ? 'invalid' : '' ?>">
        <?= $err('nim') ?>
    </div>

    <div class="form-group">
        <label for="nama"><?= e(t('f_nama')) ?> *</label>
        <input type="text" id="nama" name="nama" maxlength="100" value="<?= e($data['nama']) ?>" class="<?= isset($errors['nama']) ? 'invalid' : '' ?>">
        <?= $err('nama') ?>
    </div>

    <div class="form-group">
        <label for="email"><?= e(t('f_email')) ?> *</label>
        <input type="text" id="email" name="email" maxlength="100" value="<?= e($data['email']) ?>" class="<?= isset($errors['email']) ? 'invalid' : '' ?>">
        <?= $err('email') ?>
    </div>

    <div class="form-group">
        <label for="jurusan"><?= e(t('f_jurusan')) ?> *</label>
        <select id="jurusan" name="jurusan" class="<?= isset($errors['jurusan']) ? 'invalid' : '' ?>">
            <option value=""><?= e(t('choose_jurusan')) ?></option>
            <?php foreach (jurusan_list() as $j): ?>
                <option value="<?= e($j) ?>" <?= $data['jurusan'] === $j ? 'selected' : '' ?>><?= e($j) ?></option>
            <?php endforeach; ?>
        </select>
        <?= $err('jurusan') ?>
    </div>

    <div class="form-group">
        <label for="angkatan"><?= e(t('f_angkatan')) ?> *</label>
        <input type="text" id="angkatan" name="angkatan" maxlength="4" value="<?= e($data['angkatan']) ?>" class="<?= isset($errors['angkatan']) ? 'invalid' : '' ?>">
        <?= $err('angkatan') ?>
    </div>

    <div class="form-group">
        <label for="alamat"><?= e(t('f_alamat')) ?></label>
        <textarea id="alamat" name="alamat" rows="3" maxlength="255" class="<?= isset($errors['alamat']) ? 'invalid' : '' ?>"><?= e($data['alamat']) ?></textarea>
        <?= $err('alamat') ?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?= e($submitLabel) ?></button>
        <a href="index.php" class="btn"><?= e(t('btn_cancel')) ?></a>
    </div>
</form>
