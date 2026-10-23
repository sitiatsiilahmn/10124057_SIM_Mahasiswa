<?php
require_once __DIR__ . '/includes/init.php';
require_login();

// READ: ambil data (dengan pencarian opsional)
$q = trim((string)($_GET['q'] ?? ''));
if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = db()->prepare('SELECT * FROM mahasiswa WHERE nim LIKE ? OR nama LIKE ? OR jurusan LIKE ? ORDER BY id DESC');
    $stmt->bind_param('sss', $like, $like, $like);
} else {
    $stmt = db()->prepare('SELECT * FROM mahasiswa ORDER BY id DESC');
}
$stmt->execute();
$rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$pageTitle = t('list_title');
require __DIR__ . '/partials/header.php';
?>
<div class="card">
    <div class="card-head">
        <h1><?= e(t('list_title')) ?></h1>
        <a href="create.php" class="btn btn-primary">+ <?= e(t('nav_add')) ?></a>
    </div>

    <form method="GET" action="index.php" class="search">
        <input type="text" name="q" value="<?= e($q) ?>" placeholder="<?= e(t('search_placeholder')) ?>">
        <button type="submit" class="btn"><?= e(t('btn_search')) ?></button>
        <?php if ($q !== ''): ?><a href="index.php" class="btn"><?= e(t('btn_reset')) ?></a><?php endif; ?>
    </form>

    <p class="muted"><?= e(t('total_data', count($rows))) ?></p>

    <div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th><?= e(t('no')) ?></th>
                <th><?= e(t('f_nim')) ?></th>
                <th><?= e(t('f_nama')) ?></th>
                <th><?= e(t('f_email')) ?></th>
                <th><?= e(t('f_jurusan')) ?></th>
                <th><?= e(t('f_angkatan')) ?></th>
                <th><?= e(t('f_alamat')) ?></th>
                <th><?= e(t('actions')) ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$rows): ?>
            <tr><td colspan="8" class="center muted"><?= e(t('no_data')) ?></td></tr>
        <?php else: ?>
            <?php foreach ($rows as $i => $r): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($r['nim']) ?></td>
                <td><?= e($r['nama']) ?></td>
                <td><?= e($r['email']) ?></td>
                <td><?= e($r['jurusan']) ?></td>
                <td><?= e($r['angkatan']) ?></td>
                <td><?= e($r['alamat']) ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= (int)$r['id'] ?>" class="btn btn-small"><?= e(t('btn_edit')) ?></a>
                    <form method="POST" action="delete.php" class="inline"
                          onsubmit="return confirm('<?= e(addslashes(t('confirm_delete'))) ?>');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                        <button type="submit" class="btn btn-small btn-danger"><?= e(t('btn_delete')) ?></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
