<?php
/** Variabel: $pageTitle (string), $showNav (bool, default true) */
$showNav = $showNav ?? true;
$self    = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION['lang']) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? t('app_title')) ?> - <?= e(t('app_title')) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
        <a class="brand" href="<?= is_logged_in() ? 'index.php' : 'login.php' ?>"><?= e(t('app_title')) ?></a>
        <nav class="nav">
            <?php if ($showNav && is_logged_in()): ?>
                <a href="index.php" class="<?= $self === 'index.php' ? 'active' : '' ?>"><?= e(t('nav_data')) ?></a>
                <a href="create.php" class="<?= $self === 'create.php' ? 'active' : '' ?>"><?= e(t('nav_add')) ?></a>
            <?php endif; ?>
            <span class="lang">
                <a href="set_lang.php?lang=id" class="<?= $_SESSION['lang'] === 'id' ? 'active' : '' ?>">ID</a> |
                <a href="set_lang.php?lang=en" class="<?= $_SESSION['lang'] === 'en' ? 'active' : '' ?>">EN</a>
            </span>
            <?php if ($showNav && is_logged_in()): ?>
                <span class="user"><?= e(t('hello')) ?>, <strong><?= e($_SESSION['nama'] ?? '') ?></strong></span>
                <a href="logout.php" class="btn btn-small btn-danger"><?= e(t('nav_logout')) ?></a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
<?php if ($flash = flash_get()): ?>
    <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
<?php endif; ?>
