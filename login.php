<?php
require_once __DIR__ . '/includes/init.php';

if (is_logged_in()) {
    redirect('index.php');
}

$error    = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $error = t('err_csrf');
    } elseif ($username === '' || $password === '') {
        $error = t('err_login_empty');
    } else {
        $stmt = db()->prepare('SELECT id, username, password, nama FROM users WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            $lang = $_SESSION['lang'];          // pertahankan pilihan bahasa
            session_regenerate_id(true);        // cegah session fixation
            $_SESSION['user_id']  = (int)$user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['lang']     = $lang;
            redirect('index.php');
        }
        $error = t('err_login_failed');
    }
}

$pageTitle = t('login_title');
$showNav   = false;
require __DIR__ . '/partials/header.php';
?>
<div class="card card-narrow">
    <h1><?= e(t('login_title')) ?></h1>
    <p class="muted"><?= e(t('login_subtitle')) ?></p>

    <?php if ($error): ?>
        <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php" novalidate>
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="username"><?= e(t('username')) ?></label>
            <input type="text" id="username" name="username" value="<?= e($username) ?>" autofocus>
        </div>
        <div class="form-group">
            <label for="password"><?= e(t('password')) ?></label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?= e(t('btn_login')) ?></button>
    </form>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
